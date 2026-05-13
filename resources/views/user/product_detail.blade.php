<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-[#819E4A] shadow-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/index.html" class="flex-shrink-0 flex items-center cursor-pointer z-50">
                    <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo INdeta" class="h-10 md:h-12 w-auto">
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/index.html" class="nav-home text-white hover:text-gray-200 font-semibold transition-colors">Home</a>
                    <a href="/destinasi" class="nav-destinasi text-white hover:text-gray-200 font-semibold transition-colors">Destination</a>
                    <a href="/categories" class="nav-categories text-white hover:text-gray-200 font-semibold transition-colors">Categories</a>
                    <!-- active indicator on product -->
                    <a href="/product" class="px-5 py-2 bg-black/20 rounded-[30px] text-white font-bold transition-colors">Product</a>
                    <a href="/artikel" class="nav-artikel text-white hover:text-gray-200 font-semibold transition-colors">Article</a>
                    <a href="#" class="nav-about text-white hover:text-gray-200 font-semibold transition-colors">About Us</a>
                </nav>

                <!-- Auth/Profile -->
                <div class="flex items-center space-x-4">
                    <div id="auth-buttons">
                        <a href="/login" id="btn-login" class="px-5 py-2 border-2 border-white text-white hover:bg-white hover:text-[#819E4A] rounded-full font-semibold transition-colors text-sm">Login</a>
                    </div>
                    
                    <div id="user-profile" class="hidden flex flex-col items-center justify-center relative group cursor-pointer z-[100]">
                        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white mb-1 shadow-sm">
                            <img src="https://ui-avatars.com/api/?name=User&background=random" id="user-avatar" class="w-full h-full object-cover">
                        </div>
                        <span id="welcome-text" class="text-[10px] text-white/90">Welcome "name"</span>
                        
                        <!-- Logout Dropdown -->
                        <div class="absolute top-12 right-0 bg-white text-gray-800 rounded-lg shadow-xl py-2 w-40 hidden group-hover:block transition-all border border-gray-100">
                              <a href="/admin-dashboard" id="btn-admin-dashboard" class="hidden block w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600 font-bold text-sm transition-colors border-b border-gray-100">Dashboard Admin</a>
                              <button type="button" id="btn-logout-dropdown" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 font-bold text-sm transition-colors">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Section -->
    <main class="flex-1 bg-white text-gray-800">
        <!-- Sub-header (Breadcrumb, Title, Search) -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Breadcrumb -->
                <div class="flex-1 flex justify-start items-center space-x-3 mb-4 md:mb-0">
                    <!-- updated back button to /product -->
                    <a href="/product" class="text-gray-700 hover:text-gray-900 flex items-center font-bold text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1.5 rounded-lg mr-2 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <span id="breadcrumb-text" class="text-sm md:text-base font-semibold tracking-wide text-gray-500">Produk UMKM / ...</span>
                </div>
                
                <!-- Center Title -->
                <div class="flex-2 flex justify-center w-full md:w-auto text-center hidden">       
                    <h1 id="page-title" class="text-2xl md:text-4xl font-bold tracking-wider text-gray-900">Memuat...</h1>
                </div>
                
                <!-- Right Spacer -->
                <div class="hidden md:block flex-1"></div>
            </div>

            <!-- Content Box -->
            <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pb-12 relative mt-4">
                <div class="bg-white text-gray-800 flex flex-col md:flex-row items-stretch gap-8 min-h-[500px]">
                    <!-- Image Left Side Wrapper -->
                    <div class="w-full md:w-5/12 bg-white rounded-xl">
                        <div class="md:sticky md:top-28 h-[400px] md:h-[calc(100vh-10rem)] max-h-[600px] w-full overflow-hidden rounded-2xl ring-1 ring-black/5 shadow-md">
                            <img id="dest-image" src="" alt="Cover" class="w-full h-full object-cover object-center hidden hover:scale-105 transition-transform duration-500">
                            <div id="img-loading" class="w-full h-full flex items-center justify-center text-gray-500 bg-gray-100 font-medium">
                                Memuat gambar...
                            </div>
                        </div>
                    </div>

                    <!-- Content Right Side -->
                    <div class="w-full md:w-7/12 flex flex-col justify-start pt-4 md:pt-2">
                        <!-- Title (No text stroke outline) -->
                        <h2 id="right-page-title" class="text-3xl md:text-5xl font-black mb-6 uppercase text-gray-800">MEMUAT...</h2>
                        
                        <!-- Deskripsi Produk -->
                        <div id="desc-text" class="text-gray-900 text-sm md:text-base text-justify leading-relaxed mb-8 whitespace-pre-line font-medium">
                            Memuat...
                        </div>

                        <!-- Harga -->
                        <h3 id="price-title" class="text-red-500 font-bold text-lg md:text-xl mb-3">Range Harga</h3>
                        <ul id="price-list-container" class="list-disc pl-5 text-red-500 font-semibold mb-8 space-y-2">
                            <li class="italic text-gray-500">Informasi harga belum tersedia.</li>
                        </ul>

                        <!-- Link Sosial Media & Maps -->
                        <div id="maps-header" class="hidden">
                            <h3 class="text-red-500 font-bold text-lg md:text-xl mb-2">Location:</h3>
                            <div id="maps-container" class="mt-1 break-all space-y-2"></div>
                            <div id="social-container" class="mt-2 break-all space-y-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
      const SUPABASE_URL = @json(config('services.supabase.url'));
      const SUPABASE_ANON_KEY = @json(config('services.supabase.key'));
      const CURRENT_SLUG = "{{ $slug }}";

      let supabaseClient = null;
      let currentUser = null;

      if (window.supabase) {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
      }

      document.addEventListener('DOMContentLoaded', () => {
          checkSession();
          loadProductDetail();
      });

      async function checkSession() {
          if (!supabaseClient) return;
          const { data, error } = await supabaseClient.auth.getSession();
          if(!error && data && data.session && data.session.user) {
              const authButtons = document.getElementById('auth-buttons');
              const userProfile = document.getElementById('user-profile');
              if(authButtons) authButtons.classList.add('hidden');
              if(userProfile) userProfile.classList.remove('hidden');
              
              const meta = data.session.user.user_metadata || {};
              const name = meta.full_name || data.session.user.email.split('@')[0];
              const shortName = name.split(' ')[0];
              
              
                const welcomeText = document.getElementById('welcome-text');
                const userAvatar = document.getElementById('user-avatar');
                if(welcomeText) welcomeText.textContent = `Welcome "${shortName}"`;
                if(userAvatar) userAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random`;

                // Admin check
                const { data: roleData } = await supabaseClient
                    .from('users')
                    .select('role')
                    .eq('email', data.session.user.email)
                    .maybeSingle();
                
                if(roleData && roleData.role === 'admin') {
                    const btnAdmin = document.getElementById('btn-admin-dashboard');
                    if(btnAdmin) btnAdmin.classList.remove('hidden');
                }

          }
      }

      async function loadProductDetail() {
          if (!supabaseClient) return;

          const { data: dests, error } = await supabaseClient
            .from('umkm_products')
            .select('*')
            .eq('slug', CURRENT_SLUG)
            .limit(1);

          if (error || !dests || dests.length === 0) {
              document.getElementById('right-page-title').textContent = "Produk Tidak Ditemukan";
              document.getElementById('desc-text').textContent = "Kami tidak bisa menemukan produk ini.";
              document.getElementById('img-loading').textContent = "Gambar tidak tersedia";
              return;
          }

          const dest = dests[0];

          // UI Update
          document.getElementById('right-page-title').textContent = dest.name;
          document.getElementById('breadcrumb-text').textContent = `Produk UMKM / ${dest.name}`;
          document.getElementById('desc-text').textContent = (dest.description || "Tidak ada deskripsi tersedia.");

          // Image Logic
          const imgEl = document.getElementById('dest-image');
          const loadingEl = document.getElementById('img-loading');
          if (dest.image_url) {
              let finalImg = dest.image_url.startsWith('http') 
                  ? dest.image_url 
                  : `${SUPABASE_URL}/storage/v1/object/public/umkm_products/${dest.image_url}`;
              
              imgEl.src = finalImg;
              imgEl.onload = () => {
                  loadingEl.classList.add('hidden');
                  imgEl.classList.remove('hidden');
              };
          } else {
              loadingEl.textContent = "Tidak ada gambar";
          }

          // Price Logic
          const priceListContainer = document.getElementById('price-list-container');
          if (dest.price_list && Array.isArray(dest.price_list) && dest.price_list.length > 0) {
              priceListContainer.innerHTML = dest.price_list.map(p => {
                  let formatPrice = p.price;
                  if (!isNaN(p.price) && p.price !== '') {
                      formatPrice = 'Rp ' + Number(p.price).toLocaleString('id-ID');
                  } else if(p.price && !p.price.toString().toLowerCase().includes('rp')) {
                      formatPrice = 'Rp ' + p.price;
                  }
                  return `<li class="text-red-500"><span class="font-bold text-gray-800">${p.name}</span>: ${formatPrice}</li>`;
              }).join('');
          } else {
              priceListContainer.innerHTML = '<li class="italic text-gray-400">Belum ada varian harga</li>';
          }

          // Maps & Social Logic
          const mapsContainer = document.getElementById('maps-container');
          const socialContainer = document.getElementById('social-container');
          let hasLink = false;
          
          if (dest.gmaps_url) {
              mapsContainer.innerHTML = `<a href="${dest.gmaps_url}" target="_blank" rel="noopener noreferrer" class="text-blue-500 font-bold hover:underline text-sm md:text-base leading-relaxed break-all">${dest.gmaps_url}</a>`;
              hasLink = true;
          }

          if (dest.social_media && dest.social_media.url) {
              socialContainer.innerHTML = `<a href="${dest.social_media.url}" target="_blank" rel="noopener noreferrer" class="text-blue-500 font-bold hover:underline text-sm md:text-base leading-relaxed break-all">${dest.social_media.url}</a>`;
              hasLink = true;
          }

          if (hasLink) {
              document.getElementById('maps-header').classList.remove('hidden');
          }
      }

      const btnLogoutDropdown = document.getElementById('btn-logout-dropdown');
      if (btnLogoutDropdown) {
          btnLogoutDropdown.addEventListener('click', async () => {
              if(!supabaseClient) return;
              btnLogoutDropdown.textContent = 'Logout...';
              await supabaseClient.auth.signOut();
              window.location.reload();
          });
      }
    </script>
</body>
</html>