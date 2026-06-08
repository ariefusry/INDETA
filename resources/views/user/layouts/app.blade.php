<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#819E4A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="INDETA">
    <link rel="icon" type="image/png" href="/images/icon-192x192.png">
    <link rel="apple-touch-icon" href="/images/icon-192x192.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>@yield('title', 'INDETA')</title>
    @vite('resources/css/app.css')
    <style>
        .text-shadow { text-shadow: 2px 2px 8px rgba(0,0,0,0.7); }
        .text-shadow-sm { text-shadow: 1px 1px 4px rgba(0,0,0,0.8); }
        .font-serif-custom { font-family: ui-serif, Georgia, Cambria, 'Times New Roman', Times, serif; }
        header { padding-top: env(safe-area-inset-top); }
    </style>
    @yield('styles')
</head>
<body class="@yield('body-class', 'bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col')">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-[#819E4A] shadow-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex-shrink-0 flex items-center cursor-pointer z-50">
                    <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo INdeta" class="h-10 md:h-12 w-auto">
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="px-5 py-2 {{ request()->is('/') ? 'bg-black/20 rounded-[30px]' : '' }} text-white font-bold transition-colors">Home</a>
                    <a href="/destinasi" class="text-white hover:text-gray-200 font-semibold transition-colors {{ request()->is('destinasi*') ? 'underline underline-offset-8' : '' }}">Destination</a>
                    <a href="/categories" class="text-white hover:text-gray-200 font-semibold transition-colors {{ request()->is('categories*') ? 'underline underline-offset-8' : '' }}">Categories</a>
                    <a href="/product" class="text-white hover:text-gray-200 font-semibold transition-colors {{ request()->is('product*') ? 'underline underline-offset-8' : '' }}">Product</a>
                    <a href="/artikel" class="text-white hover:text-gray-200 font-semibold transition-colors {{ request()->is('artikel*') ? 'underline underline-offset-8' : '' }}">Article</a>
                    <a href="/about" class="text-white hover:text-gray-200 font-semibold transition-colors {{ request()->is('about*') ? 'underline underline-offset-8' : '' }}">About Us</a>
                </nav>

                <!-- Auth/Profile & Mobile Toggle -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <div id="auth-buttons" class="hidden sm:block">
                        <a href="/login" id="btn-login" class="px-4 py-1.5 md:px-5 md:py-2 border-2 border-white text-white hover:bg-white hover:text-[#819E4A] rounded-full font-semibold transition-colors text-xs md:text-sm">Login</a>
                    </div>
                    
                    <div id="user-profile" class="hidden flex flex-col items-center justify-center relative group cursor-pointer z-[100]">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full overflow-hidden border-2 border-white mb-0.5 md:mb-1 shadow-sm">
                            <img src="https://ui-avatars.com/api/?name=User&background=random" id="user-avatar" class="w-full h-full object-cover">
                        </div>
                        <span id="welcome-text" class="text-[8px] md:text-[10px] text-white/90">Welcome "name"</span>
                        
                        <!-- Logout Dropdown (Desktop) -->
                        <div class="absolute top-12 right-0 bg-white text-gray-800 rounded-lg shadow-xl py-2 w-48 hidden md:group-hover:block transition-all border border-gray-100">
                              <button type="button" id="btn-install-pwa-desktop" class="hidden w-full text-left px-4 py-2 hover:bg-gray-100 text-green-600 font-bold text-sm transition-colors border-b border-gray-100">Install Aplikasi</button>
                              <a href="/admin-dashboard" id="btn-admin-dashboard" class="hidden block w-full text-left px-4 py-2 hover:bg-gray-100 text-blue-600 font-bold text-sm transition-colors border-b border-gray-100">Dashboard Admin</a>
                              <button type="button" id="btn-logout-dropdown" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 font-bold text-sm transition-colors">Logout</button>
                        </div>
                    </div>

                    <!-- Hamburger Button -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="fixed inset-0 z-[60] bg-black/50 backdrop-blur-sm hidden md:hidden">
            <div class="absolute right-0 top-0 h-full w-64 bg-[#819E4A] shadow-2xl flex flex-col p-6 space-y-6 transform translate-x-full transition-transform duration-300" id="mobile-menu-content">
                <div class="flex flex-col space-y-4 pt-10">
                    <a href="/" class="text-white text-lg font-bold border-b border-white/20 pb-2">Home</a>
                    <a href="/destinasi" class="text-white text-lg font-semibold hover:text-gray-200">Destination</a>
                    <a href="/categories" class="text-white text-lg font-semibold hover:text-gray-200">Categories</a>
                    <a href="/product" class="text-white text-lg font-semibold hover:text-gray-200">Product</a>
                    <a href="/artikel" class="text-white text-lg font-semibold hover:text-gray-200">Article</a>
                    <a href="/about" class="text-white text-lg font-semibold hover:text-gray-200">About Us</a>
                </div>
                
                <div class="pt-6 mt-6 border-t border-white/20">
                    <div id="mobile-auth-section">
                        <a href="/login" class="block w-full text-center px-5 py-3 border-2 border-white text-white rounded-full font-bold">Login</a>
                    </div>
                    <div id="mobile-user-section" class="hidden space-y-4">
                         <div class="flex items-center space-x-3 bg-black/10 p-3 rounded-xl mb-4">
                            <img id="mobile-user-avatar" src="" class="w-10 h-10 rounded-full border border-white">
                            <span id="mobile-welcome-text" class="text-white font-bold text-sm">User</span>
                         </div>
                         <button id="mobile-btn-install-pwa" class="w-full px-5 py-2 bg-yellow-500 text-white rounded-lg font-bold text-sm shadow-md transition-colors hover:bg-yellow-400">Install Aplikasi INDETA</button>
                         <a href="/admin-dashboard" id="mobile-btn-admin" class="hidden block w-full text-center px-5 py-2 bg-blue-600 text-white rounded-lg font-bold text-sm">Admin Dashboard</a>
                         <button id="mobile-btn-logout" class="w-full px-5 py-2 bg-red-600 text-white rounded-lg font-bold text-sm">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- PWA Install Popup -->
    <div id="pwa-install-popup" class="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 bg-white rounded-2xl shadow-2xl z-[100] border-2 border-[#819E4A] p-5 hidden transition-all duration-500 transform translate-y-0">
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 rounded-xl bg-[#f0f4eb] flex items-center justify-center flex-shrink-0 border border-[#819E4A]/30">
                <img src="/images/icon-192x192.png" class="w-8 h-8 object-contain">
            </div>
            <div class="flex-1">
                <h4 class="font-bold text-gray-800">Install Aplikasi INDETA</h4>
                <p class="text-xs text-gray-600 mt-1">Tambahkan INDETA ke layar utama HP Anda untuk akses lebih cepat dan pengalaman layaknya aplikasi!</p>
                <div class="flex space-x-3 mt-4">
                    <button id="btn-popup-install" class="bg-[#819E4A] text-white px-4 py-1.5 rounded-lg text-sm font-bold hover:bg-[#6c853d] transition-colors shadow-md">Install Sekarang</button>
                    <button id="btn-popup-dismiss" class="text-gray-500 text-sm font-medium hover:text-gray-700 hover:underline">Lain kali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- PWA Manual Install Guide Modal -->
    <div id="pwa-guide-modal" class="fixed inset-0 z-[200] bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4" style="display:none;">
        <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full mx-auto overflow-hidden animate-[slideUp_0.3s_ease-out]">
            <!-- Header -->
            <div class="bg-[#819E4A] p-4 flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <img src="/images/icon-192x192.png" class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-white font-bold text-base">Install INDETA</h3>
                    <p class="text-white/80 text-xs">Panduan pemasangan manual</p>
                </div>
                <button id="btn-guide-close" class="ml-auto text-white/80 hover:text-white p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <!-- Body -->
            <div class="p-5">
                <p class="text-gray-600 text-sm mb-4">Ikuti langkah berikut untuk menambahkan INDETA ke layar utama:</p>
                
                <!-- Android Steps -->
                <div id="guide-android" class="hidden space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Ketuk ikon menu <span class="inline-flex items-center align-middle mx-0.5"><svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg></span> (titik tiga)</p>
                            <p class="text-xs text-gray-500">Di pojok kanan atas browser Chrome</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Pilih "Tambahkan ke Layar Utama"</p>
                            <p class="text-xs text-gray-500">Atau "Install App" / "Add to Home Screen"</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Ketuk "Tambahkan" / "Install"</p>
                            <p class="text-xs text-gray-500">Ikon INDETA akan muncul di layar utama Anda</p>
                        </div>
                    </div>
                </div>

                <!-- iOS Steps -->
                <div id="guide-ios" class="hidden space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Buka di Safari</p>
                            <p class="text-xs text-gray-500">Pastikan membuka website ini di browser Safari</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Ketuk tombol Share <span class="inline-flex items-center align-middle mx-0.5"><svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0-12L8 8m4-4l4 4"/><path stroke-linecap="round" d="M4 14v4a2 2 0 002 2h12a2 2 0 002-2v-4"/></svg></span></p>
                            <p class="text-xs text-gray-500">Ikon kotak dengan panah ke atas, di bagian bawah Safari</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Scroll ke bawah, pilih "Tambahkan ke Layar Utama"</p>
                            <p class="text-xs text-gray-500">Atau "Add to Home Screen"</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Ketuk "Tambahkan" di pojok kanan atas</p>
                            <p class="text-xs text-gray-500">Ikon INDETA akan muncul di layar utama Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Steps -->
                <div id="guide-desktop" class="hidden space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Klik ikon install <span class="inline-block mx-0.5">⊕</span> di address bar</p>
                            <p class="text-xs text-gray-500">Atau buka menu browser → "Install INDETA"</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-7 h-7 rounded-full bg-[#819E4A] text-white text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                        <div>
                            <p class="text-sm text-gray-800 font-semibold">Klik "Install" pada popup yang muncul</p>
                            <p class="text-xs text-gray-500">Aplikasi INDETA akan terpasang di komputer Anda</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="px-5 pb-5">
                <button id="btn-guide-ok" class="w-full bg-[#819E4A] text-white py-2.5 rounded-xl font-bold text-sm hover:bg-[#6c853d] transition-colors shadow-md">Mengerti</button>
            </div>
        </div>
    </div>

    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        window.SUPABASE_URL = @json(config('services.supabase.url'));
        window.SUPABASE_ANON_KEY = @json(config('services.supabase.key'));

        window.supabaseClient = null;
        window.currentUser = null;
        let deferredPrompt = null;

        // Detect platform
        const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
        const isAndroid = /Android/.test(navigator.userAgent);
        const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('btn-install-pwa-desktop')?.classList.remove('hidden');
        });

        const showInstallGuide = () => {
            const modal = document.getElementById('pwa-guide-modal');
            if (!modal) return;
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            // Show platform-specific steps
            document.getElementById('guide-android')?.classList.add('hidden');
            document.getElementById('guide-ios')?.classList.add('hidden');
            document.getElementById('guide-desktop')?.classList.add('hidden');
            if (isIOS) {
                document.getElementById('guide-ios')?.classList.remove('hidden');
            } else if (isAndroid) {
                document.getElementById('guide-android')?.classList.remove('hidden');
            } else {
                document.getElementById('guide-desktop')?.classList.remove('hidden');
            }
        };

        const closeInstallGuide = () => {
            const modal = document.getElementById('pwa-guide-modal');
            if (modal) { modal.style.display = 'none'; modal.classList.add('hidden'); }
        };

        const handleInstallClick = async () => {
            if (isStandalone) {
                showInstallGuide(); // App already installed, show info
                return;
            }
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    document.getElementById('btn-install-pwa-desktop')?.classList.add('hidden');
                    document.getElementById('mobile-btn-install-pwa')?.classList.add('hidden');
                }
                deferredPrompt = null;
            } else {
                showInstallGuide();
            }
        };

        document.getElementById('btn-install-pwa-desktop')?.addEventListener('click', handleInstallClick);
        document.getElementById('mobile-btn-install-pwa')?.addEventListener('click', handleInstallClick);
        
        document.getElementById('btn-popup-install')?.addEventListener('click', () => {
            document.getElementById('pwa-install-popup')?.classList.add('hidden');
            handleInstallClick();
        });

        document.getElementById('btn-popup-dismiss')?.addEventListener('click', () => {
            document.getElementById('pwa-install-popup')?.classList.add('hidden');
            localStorage.setItem('pwa_prompt_dismissed', 'true');
        });

        document.getElementById('btn-guide-close')?.addEventListener('click', closeInstallGuide);
        document.getElementById('btn-guide-ok')?.addEventListener('click', closeInstallGuide);
        document.getElementById('pwa-guide-modal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeInstallGuide();
        });

        // Register Service Worker for PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(reg => {
                    console.log('SW registered:', reg);
                }).catch(err => {
                    console.log('SW registration failed:', err);
                });
            });
        }

        if (window.supabase) {
            window.supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
        }

        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuContent = document.getElementById('mobile-menu-content');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if(mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = !mobileMenu.classList.contains('hidden');
                if (isOpen) {
                    mobileMenuContent.classList.add('translate-x-full');
                    setTimeout(() => mobileMenu.classList.add('hidden'), 300);
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                } else {
                    mobileMenu.classList.remove('hidden');
                    setTimeout(() => mobileMenuContent.classList.remove('translate-x-full'), 10);
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                }
            });
        }

        mobileMenu?.addEventListener('click', (e) => {
            if (e.target === mobileMenu) mobileMenuBtn.click();
        });

        async function checkSession() {
            if (!window.supabaseClient) return;
            const { data, error } = await window.supabaseClient.auth.getSession();
            if(!error && data && data.session && data.session.user) {
                window.currentUser = data.session.user;
                const authButtons = document.getElementById('auth-buttons');
                const userProfile = document.getElementById('user-profile');
                const mobileAuth = document.getElementById('mobile-auth-section');
                const mobileUser = document.getElementById('mobile-user-section');

                if(authButtons) {
                    authButtons.classList.remove('sm:block');
                    authButtons.classList.add('hidden');
                }
                if(userProfile) userProfile.classList.remove('hidden');
                if(mobileAuth) mobileAuth.classList.add('hidden');
                if(mobileUser) mobileUser.classList.remove('hidden');

                const meta = data.session.user.user_metadata || {};
                const name = meta.full_name || data.session.user.email.split('@')[0];
                
                const welcomeText = document.getElementById('welcome-text');
                const mobileWelcome = document.getElementById('mobile-welcome-text');
                const avatarImg = document.getElementById('user-avatar');
                const mobileAvatar = document.getElementById('mobile-user-avatar');

                if(welcomeText) welcomeText.textContent = `Welcome "${name}"`;
                if(mobileWelcome) mobileWelcome.textContent = name;
                
                const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random`;
                if(avatarImg) avatarImg.src = avatarUrl;
                if(mobileAvatar) mobileAvatar.src = avatarUrl;

                const { data: roleData } = await window.supabaseClient
                    .from('users')
                    .select('role')
                    .eq('email', data.session.user.email)
                    .maybeSingle();

                if (roleData && roleData.role === 'admin') {
                    const btnAdmin = document.getElementById('btn-admin-dashboard');
                    const mobileBtnAdmin = document.getElementById('mobile-btn-admin');
                    if(btnAdmin) btnAdmin.classList.remove('hidden');
                    if(mobileBtnAdmin) mobileBtnAdmin.classList.remove('hidden');
                }
                
                // Show PWA popup if not dismissed
                if (!localStorage.getItem('pwa_prompt_dismissed')) {
                    document.getElementById('pwa-install-popup')?.classList.remove('hidden');
                }
            }
        }
        checkSession();

        const handleLogout = async () => {
            if(window.supabaseClient) {
                await window.supabaseClient.auth.signOut();
                window.location.reload();
            }
        };

        document.getElementById('btn-logout-dropdown')?.addEventListener('click', handleLogout);
        document.getElementById('mobile-btn-logout')?.addEventListener('click', handleLogout);
    </script>
    @yield('scripts')
</body>
</html>
