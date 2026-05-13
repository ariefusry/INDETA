<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 font-sans antialiased overflow-x-hidden">
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
                    <a href="/categories" class="px-5 py-2 bg-black/20 rounded-[30px] text-white font-bold transition-colors">Categories</a>
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

    <!-- Main Section -->
    <main class="relative min-h-[90vh] py-12 bg-white">
        <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search -->
            <div class="flex flex-col items-center justify-between mb-12 relative w-full pt-4">
                <div class="w-full flex justify-center items-center mb-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 tracking-wide drop-shadow-sm">Kategori Destinasi</h1>
                </div>
                <div class="w-full relative z-20 flex justify-center md:justify-end">
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari kategori..." id="searchInput" class="w-full bg-gray-100 text-gray-800 rounded-full px-6 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#819E4A] font-medium shadow-sm transition-shadow">
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div id="categories-grid" class="flex flex-wrap justify-center gap-6 lg:gap-8">
                <!-- Loading State -->
                <div class="w-full text-center text-gray-600 text-xl py-10">
                    Memuat kategori...
                </div>
            </div>
        </div>
    </main>
    </div>

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

        checkSession();

        const categoriesGrid = document.getElementById('categories-grid');
        const searchInput = document.getElementById('searchInput');
        let allCategories = [];

        async function fetchCategories() {
            if (!supabaseClient) {
                categoriesGrid.innerHTML = '<div class="col-span-full text-center text-red-500 py-10">Koneksi database gagal.</div>';
                return;
            }
            
            const { data, error } = await supabaseClient
                .from('categories')
                .select('id, name, slug, description, image_url')
                .order('name', { ascending: true });

            if (error) {
                console.error(error);
                categoriesGrid.innerHTML = '<div class="w-full text-center text-red-500 bg-white/10 py-4 rounded-lg">Gagal memuat data kategori.</div>';
                return;
            }

            allCategories = data || [];
            renderCategories(allCategories);
        }

        function renderCategories(categoriesToRender) {
            if (categoriesToRender.length === 0) {
                categoriesGrid.innerHTML = '<div class="w-full text-center text-gray-600 py-10 text-xl">Tidak ada kategori yang cocok.</div>';
                return;
            }

            categoriesGrid.innerHTML = categoriesToRender.map(cat => {
                let imageUrl = cat.image_url;
                if (imageUrl && !imageUrl.startsWith('http')) {
                   imageUrl = `${SUPABASE_URL}/storage/v1/object/public/indeta_assets/categories/${imageUrl}`;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=800&auto=format&fit=crop';
                }

                return `
                    <a href="/categories/${cat.slug}" class="rounded-2xl w-[calc(50%-0.5rem)] md:w-[calc(33.333%-0.67rem)] lg:w-[calc(20%-1.2rem)] relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
                        <img src="${imageUrl}" alt="${cat.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-5 left-0 w-full text-center px-4 flex flex-col items-center justify-end">
                            <h3 class="text-white font-bold text-lg md:text-xl drop-shadow-md leading-tight line-clamp-2" title="${cat.name}">${cat.name}</h3>
                            <p class="text-xs text-white/80 line-clamp-2 mt-1">${cat.description || ''}</p>
                        </div>
                    </a>
                `;
            }).join('');
        }

        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filtered = allCategories.filter(c => 
                c.name.toLowerCase().includes(searchTerm)
            );
            renderCategories(filtered);
        });

        fetchCategories();
    </script>
</body>
</html>