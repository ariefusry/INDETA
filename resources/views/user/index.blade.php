<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Beranda - INDETA</title>
    @vite('resources/css/app.css')
    <style>
        .text-shadow { text-shadow: 2px 2px 8px rgba(0,0,0,0.7); }
        .text-shadow-sm { text-shadow: 1px 1px 4px rgba(0,0,0,0.8); }
        .font-serif-custom { font-family: ui-serif, Georgia, Cambria, 'Times New Roman', Times, serif; }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased overflow-hidden h-screen flex flex-col">
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
                    <a href="/index.html" class="px-5 py-2 bg-black/20 rounded-[30px] text-white font-bold transition-colors">Home</a>
                    <a href="/destinasi" class="nav-destinasi text-white hover:text-gray-200 font-semibold transition-colors">Destination</a>
                    <a href="/categories" class="nav-categories text-white hover:text-gray-200 font-semibold transition-colors">Categories</a>
                    <a href="/product" class="nav-product text-white hover:text-gray-200 font-semibold transition-colors">Product</a>
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

    <!-- Main Hero -->
    <main class="relative flex-1 w-full flex items-center justify-center overflow-hidden">
        <div id="hero-slider" class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover transition-opacity duration-1000">
        </div>
        <!-- Gradient Overlay over the background images -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/50 mix-blend-multiply"></div>
        
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto flex flex-col items-center">
            <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-serif-custom text-white mb-4 leading-tight text-shadow" style="letter-spacing: -1px;">
                Jelajahi Pesona Nusantara<br>Bersama "INDETA"
            </h1>
            <p class="text-base md:text-xl lg:text-2xl text-white outline-black mb-10 font-bold italic max-w-4xl text-shadow-sm font-sans drop-shadow-xl mx-auto leading-relaxed">
                "Jelajahi keindahan Destinasi Wisata Hidden Gem di Seluruh Nusantara dan<br>Temukan tempat inspiratif yang cocok untuk petulangan Anda"
            </p>
            <a href="/destinasi" class="inline-flex flex-col items-center justify-center px-10 py-3 border-[3px] border-white text-white font-bold rounded-[40px] hover:bg-white hover:text-[#819E4A] transition-all duration-300 shadow-2xl backdrop-blur-sm bg-black/10 hover:scale-105" style="box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);">
                <span class="text-xl md:text-2xl tracking-wide">Temukan destinasi</span>
                <span class="text-xl md:text-2xl tracking-wide">Yang cocok</span>
            </a>
        </div>
    </main>

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

        let currentSlide = 0;
        let slideImages = [];
        
        async function loadHeroSlideshow() {
            if (!supabaseClient) return;
            const { data, error } = await supabaseClient
                .from('destinations')
                .select('thumbnail')
                .not('thumbnail', 'is', null)
                .limit(10);
                
            if (!error && data && data.length > 0) {
                slideImages = data.map(dest => {
                    let imageUrl = dest.thumbnail;
                    if (imageUrl && !imageUrl.startsWith('http')) {
                       imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
                    }
                    return imageUrl;
                }).filter(Boolean);
                
                if (slideImages.length > 0) {
                    startSlideshow();
                }
            }
        }
        
        function startSlideshow() {
            const slider = document.getElementById('hero-slider');
            if(slideImages.length > 0) {
                slider.innerHTML = `<img src="${slideImages[0]}" class="w-full h-full object-cover absolute inset-0 transition-opacity duration-1000 opacity-100" id="slide-img-0">`;
            }
            
            if(slideImages.length > 1) {
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slideImages.length;
                    const oldImg = slider.querySelector('img');
                    
                    const newImg = document.createElement('img');
                    newImg.src = slideImages[currentSlide];
                    newImg.className = 'w-full h-full object-cover absolute inset-0 transition-opacity duration-[1500ms] opacity-0 ease-in-out';
                    slider.appendChild(newImg);
                    
                    // Trigger fade
                    setTimeout(() => {
                        newImg.classList.remove('opacity-0');
                        newImg.classList.add('opacity-100');
                    }, 50);
                    
                    setTimeout(() => {
                        if(oldImg && oldImg.parentNode) {
                            oldImg.parentNode.removeChild(oldImg);
                        }
                    }, 1500);
                    
                }, 6000); // Ganti tiap 6 detik
            }
        }

        checkSession();
        loadHeroSlideshow();
    </script>
</body>
</html>

