const fs = require("fs");

const html = `<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Detail Artikel - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col">
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
                    <a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Destinasi</a>
                    <a href="/artikel" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Artikel</a>
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

    <main class="flex-1 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative">
        <!-- Back Button -->
        <a href="/artikel" class="inline-flex items-center text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors mb-8">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Artikel
        </a>

        <!-- Loading State -->
        <div id="loading-state" class="text-center py-20">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#3e2723] border-t-2"></div>
            <p class="mt-4 text-gray-600 font-medium">Memuat artikel...</p>
        </div>

        <!-- Content Area -->
        <article id="content-area" class="hidden">
            <!-- Title & Prolog -->
            <header class="mb-8 text-center md:text-left">
                <h1 id="art-title" class="text-3xl md:text-5xl font-extrabold text-[#3e2723] mb-4 leading-tight"></h1>
                <p id="art-prolog" class="text-gray-600 text-lg md:text-xl leading-relaxed italic"></p>
            </header>

            <!-- Hero Image -->
            <div class="w-full aspect-video md:aspect-[21/9] rounded-2xl overflow-hidden shadow-lg mb-10 bg-gray-200">
                <img id="art-image" src="" alt="Cover Artikel" class="w-full h-full object-cover hidden transition-opacity duration-500">
            </div>

            <!-- Main Text -->
            <div class="prose prose-lg max-w-none text-gray-800">
                <div id="art-content" class="text-base md:text-lg leading-loose whitespace-pre-line text-justify space-y-6"></div>
            </div>
        </article>

        <!-- Not Found -->
        <div id="not-found" class="hidden text-center py-20 text-gray-600">
            <h2 class="text-2xl font-bold mb-2">Artikel Tidak Ditemukan</h2>
            <p>Maaf, artikel yang Anda cari tidak tersedia atau mungkin telah dihapus.</p>
            <a href="/artikel" class="inline-block mt-6 px-6 py-2 bg-[#d6d6a8] text-[#3e2723] font-bold rounded-lg hover:bg-[#c2c290] transition-colors">Kembali ke Artikel</a>
        </div>
    </main>

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

    <!-- Supabase Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
      const SUPABASE_URL = @json(env('SUPABASE_URL', ''));
      const SUPABASE_ANON_KEY = @json(env('SUPABASE_ANON_KEY', ''));

      let supabaseClient = null;
      if (window.supabase) {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
      }

      const slug = "{{ $slug }}";
      const contentArea = document.getElementById('content-area');
      const notFoundArea = document.getElementById('not-found');
      const loadingState = document.getElementById('loading-state');
      
      const logoutButton = document.getElementById('btn-logout');
      const loginButton = document.getElementById('btn-login');

      // Auth logic
      async function checkSession() {
          if (!supabaseClient) return;
          const { data, error } = await supabaseClient.auth.getSession();
          if (data && data.session && data.session.user) {
              logoutButton.classList.remove('hidden');
              loginButton.classList.add('hidden');
          }
      }

      // Logout modal logic
      const logoutModal = document.getElementById('logout-confirm-modal');
      const btnConfirmLogout = document.getElementById('btn-confirm-logout');
      const btnCancelLogout = document.getElementById('btn-cancel-logout');
      if (logoutButton) {
          logoutButton.addEventListener('click', () => { logoutModal.classList.remove('hidden'); });
      }
      if (btnCancelLogout) {
          btnCancelLogout.addEventListener('click', () => { logoutModal.classList.add('hidden'); });
      }
      if (btnConfirmLogout) {
          btnConfirmLogout.addEventListener('click', async () => {
              if (supabaseClient) {
                  btnConfirmLogout.textContent = 'Memproses...';
                  await supabaseClient.auth.signOut();
              }
              window.location.reload();
          });
      }

      async function loadArticle() {
          if (!supabaseClient) return;

          const { data, error } = await supabaseClient
              .from('articles')
              .select('*')
              .eq('slug', slug)
              .single();

          if (error || !data) {
              loadingState.classList.add('hidden');
              notFoundArea.classList.remove('hidden');
              return;
          }

          document.title = data.title + ' - Artikel INDETA';
          document.getElementById('art-title').textContent = data.title;
          document.getElementById('art-prolog').textContent = data.prolog;
          document.getElementById('art-content').textContent = data.content;

          // Image Handling
          let imageUrl = data.thumbnail;
          if (imageUrl && !imageUrl.startsWith('http')) {
              imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
          } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
          }
          
          const imgEl = document.getElementById('art-image');
          if (imageUrl) {
              imgEl.src = imageUrl;
              imgEl.onload = () => imgEl.classList.remove('hidden');
              imgEl.onerror = () => {
                 imgEl.src = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
                 imgEl.classList.remove('hidden');
              };
          }

          loadingState.classList.add('hidden');
          contentArea.classList.remove('hidden');
      }

      async function initPage() {
          checkSession();
          loadArticle();
      }

      initPage();
    </script>
</body>
</html>`;

fs.writeFileSync("resources/views/user/artikel_detail.blade.php", html);
console.log("artikel_detail layout rebuilt for standard article reading!");
