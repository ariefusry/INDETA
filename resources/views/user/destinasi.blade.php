<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0eadd] text-gray-800 font-sans antialiased overflow-x-hidden">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-[#d6d6a8] shadow-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/index.html" class="flex-shrink-0 flex items-center cursor-pointer z-50">
                    <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo INdeta" class="h-10 md:h-12 w-auto">
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="/index.html" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Beranda</a>
                    <a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Destinasi</a>
                    <a href="/artikel" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Artikel</a>
                    <a href="#" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">About Us</a>
                </nav>

                <!-- Auth/Profile -->
                <div class="flex items-center space-x-4">
                    <button type="button" id="btn-logout" class="hidden px-5 py-2 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-full font-semibold transition-colors">Logout</button>
                    <a href="/login" id="btn-login" class="px-5 py-2 border-2 border-[#3e2723] text-[#3e2723] hover:bg-[#3e2723] hover:text-white rounded-full font-semibold transition-colors">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Section -->
    <section class="relative min-h-[90vh] py-12 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1555848960-8c201726dd7d?q=80&w=2070&auto=format&fit=crop');">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>
        
        <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search -->
            <div class="flex flex-col md:flex-row items-center justify-between mb-12 relative w-full pt-4">
                <div class="w-full flex justify-center md:absolute md:inset-0 md:pointer-events-none items-center">
                    <h1 class="text-3xl md:text-5xl font-bold text-white tracking-wide shadow-black drop-shadow-md">Welcome To Indonesia</h1>
                </div>
                <div class="mt-6 md:mt-0 w-full md:w-auto relative z-20 ml-auto flex justify-end">
                    <div class="relative w-64 md:w-80">
                        <input type="text" placeholder="Search" id="searchInput" class="w-full bg-[#d6d6a8] text-[#3e2723] rounded-full px-6 py-2 focus:outline-none focus:ring-2 focus:ring-white/50 font-medium">
                    </div>
                </div>
            </div>

            <!-- Destinations Grid -->
            <div id="destinations-grid" class="flex flex-wrap justify-center gap-4 lg:gap-6">
                <!-- Loading State -->
                <div class="w-full text-center text-white text-xl py-10">
                    Memuat destinasi...
                </div>
            </div>
        </div>
    </section>
    </div>

    <!-- Supabase Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <!-- Logout Confirm Modal -->
<div id="logout-confirm-modal" class="fixed inset-0 z-[110] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden text-center relative p-6">
        <div class="mb-4 text-red-500 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin keluar dari akun ini?</p>
        <div class="flex flex-col space-y-3">
            <button type="button" id="btn-confirm-logout" class="w-full py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors shadow-md">Ya, Keluar</button>
            <button type="button" id="btn-cancel-logout" class="w-full py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition-colors">Batal</button>
        </div>
    </div>
</div>

    <script>
      const SUPABASE_URL = @json(env('SUPABASE_URL', ''));
      const SUPABASE_ANON_KEY = @json(env('SUPABASE_ANON_KEY', ''));

      let supabaseClient = null;

      if (window.supabase) {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
      }

      const logoutButton = document.getElementById('btn-logout');
      const loginButton = document.getElementById('btn-login');

      async function checkSession() {
        if (!supabaseClient) return;

        const { data, error } = await supabaseClient.auth.getSession();

        if (error || !data.session) return; 

        const user = data.session.user;
        logoutButton.classList.remove('hidden');
        loginButton.classList.add('hidden');
      }

            // Logout Modal Logic
      const logoutModal = document.getElementById('logout-confirm-modal');
      const btnConfirmLogout = document.getElementById('btn-confirm-logout');
      const btnCancelLogout = document.getElementById('btn-cancel-logout');

      if (logoutButton) {
          logoutButton.addEventListener('click', () => {
              if (logoutModal) {
                  logoutModal.classList.remove('hidden');
                  document.body.classList.add('overflow-hidden');
              }
          });
      }

      if (btnCancelLogout) {
          btnCancelLogout.addEventListener('click', () => {
              logoutModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          });
      }

      if (btnConfirmLogout) {
          btnConfirmLogout.addEventListener('click', async () => {
              if (!supabaseClient) return;
              btnConfirmLogout.textContent = 'Memproses...';
              btnConfirmLogout.disabled = true;
              await supabaseClient.auth.signOut();
              window.location.reload();
          });
      }

      checkSession();

      const destinationsGrid = document.getElementById('destinations-grid');
      const searchInput = document.getElementById('searchInput');
      let allDestinations = [];

      async function fetchDestinations() {
        if (!supabaseClient) {
          destinationsGrid.innerHTML = '<div class="col-span-full text-center text-red-500 py-10">Koneksi database gagal.</div>';
          return;
        }
        
        const { data, error } = await supabaseClient
          .from('destinations')
          .select('*')
          .order('id', { ascending: true });

        if (error) {
          console.error(error);
          destinationsGrid.innerHTML = '<div class="w-full text-center text-red-500 bg-white/10 py-4 rounded-lg">Gagal memuat data destinasi.</div>';
          return;
        }

        allDestinations = data || [];
        renderDestinations(allDestinations);
      }

      function renderDestinations(destinationsToRender) {
        if (destinationsToRender.length === 0) {
            destinationsGrid.innerHTML = '<div class="w-full text-center text-white py-10 text-xl drop-shadow-md">Tidak ada data destinasi ditemukan.</div>';
            return;
          }

          destinationsGrid.innerHTML = destinationsToRender.map(dest => {
            let imageUrl = dest.thumbnail;
            if (imageUrl && !imageUrl.startsWith('http')) {
               imageUrl = `${SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
            } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop'; // fallback
            }

            return `
              <a href="/destinasi/${dest.slug}" class="rounded-2xl w-[calc(50%-0.5rem)] md:w-[calc(33.333%-0.67rem)] lg:w-[calc(20%-1.2rem)] relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
                  <img src="${imageUrl}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                  <div class="absolute bottom-5 left-0 w-full text-center px-4">
                      <h3 class="text-white font-bold text-lg md:text-xl drop-shadow-md leading-tight">${dest.name}</h3>
                  </div>
              </a>
            `;
        }).join('');
      }

      searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filtered = allDestinations.filter(d => 
          d.name.toLowerCase().includes(searchTerm)
        );
        renderDestinations(filtered);
      });

      fetchDestinations();
    </script>
</body>
</html>






