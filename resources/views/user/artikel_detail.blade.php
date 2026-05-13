<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Detail Artikel - INDETA</title>
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
                    <a href="/product" class="nav-product text-white hover:text-gray-200 font-semibold transition-colors">Product</a>
                    <a href="/artikel" class="px-5 py-2 bg-black/20 rounded-[30px] text-white font-bold transition-colors">Article</a>
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

    <main class="flex-1 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative">
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
            <div class="flex flex-col md:flex-row md:items-start gap-8 lg:gap-12">
                <!-- Left: Sticky Hero Image -->
                <div class="w-full md:w-5/12 lg:w-4/12 md:sticky md:top-28">
                    <div class="w-full aspect-square md:aspect-[3/4] rounded-2xl overflow-hidden shadow-lg bg-[#e0d9c8]">
                        <img id="art-image" src="" alt="Cover Artikel" class="w-full h-full object-cover hidden transition-opacity duration-500">
                    </div>
                </div>

                <!-- Right: Text Content -->
                <div class="w-full md:w-7/12 lg:w-8/12 flex flex-col">
                    <!-- Title & Prolog -->
                    <header class="mb-8 text-center md:text-left">
                        <h1 id="art-title" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#3e2723] mb-4 leading-tight"></h1>
                        <p id="art-prolog" class="text-gray-600 text-lg md:text-xl leading-relaxed italic"></p>
                    </header>

                    <!-- Main Text -->
                    <div class="prose prose-lg max-w-none text-gray-800">
                        <div id="art-content" class="text-base md:text-lg leading-loose whitespace-pre-line text-justify space-y-6"></div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Not Found -->
        <div id="not-found" class="hidden text-center py-20 text-gray-600">
            <h2 class="text-2xl font-bold mb-2">Artikel Tidak Ditemukan</h2>
            <p>Maaf, artikel yang Anda cari tidak tersedia atau mungkin telah dihapus.</p>
            <a href="/artikel" class="inline-block mt-6 px-6 py-2 bg-[#d6d6a8] text-[#3e2723] font-bold rounded-lg hover:bg-[#c2c290] transition-colors">Kembali ke Artikel</a>
        </div>
    </main>

    

    <!-- Supabase Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
      const SUPABASE_URL = @json(config('services.supabase.url'));
      const SUPABASE_ANON_KEY = @json(config('services.supabase.key'));

      let supabaseClient = null;
      if (window.supabase) {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
        }

        const btnLogoutDropdown = document.getElementById('btn-logout-dropdown');
        const authButtons = document.getElementById('auth-buttons');
        const userProfile = document.getElementById('user-profile');
        
        async function checkSession() {
            if (!supabaseClient) return;
            const { data, error } = await supabaseClient.auth.getSession();
            if(!error && data && data.session && data.session.user) {
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

        if (btnLogoutDropdown) {
            btnLogoutDropdown.addEventListener('click', async () => {
                if(!supabaseClient) return;
                btnLogoutDropdown.textContent = 'Logout...';
                await supabaseClient.auth.signOut();
                window.location.reload();
            });
        }

        const slug = "{{ $slug }}";
        const contentArea = document.getElementById('content-area');
        const notFoundArea = document.getElementById('not-found');
        const loadingState = document.getElementById('loading-state');
        


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
              imageUrl = SUPABASE_URL + '/storage/v1/object/public/articles/' + imageUrl;
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
</html>

