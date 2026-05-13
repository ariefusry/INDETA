<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Destinasi - INDETA</title>
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
            <!-- Header -->
            <div class="flex flex-col items-center justify-between mb-8 relative w-full pt-4">
                <div class="w-full flex flex-col justify-center items-center mb-4">
                    <h1 id="category-title" class="text-3xl md:text-5xl font-bold text-gray-800 tracking-wide drop-shadow-sm text-center">Loading...</h1>
                    <p id="category-desc" class="text-gray-600 mt-2 text-center max-w-2xl"></p>
                </div>
            </div>

            <!-- Destinations Grid -->
            <div id="destinations-grid" class="flex flex-wrap justify-center gap-6 lg:gap-8">
                <!-- Loading State -->
                <div class="w-full text-center text-gray-600 text-xl py-10">
                    Memuat destinasi...
                </div>
            </div>
        </div>
    </main>

    <!-- Supabase Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        const SUPABASE_URL = @json(config('services.supabase.url'));
        const SUPABASE_ANON_KEY = @json(config('services.supabase.key'));
        const categorySlug = "{{ $slug }}";

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

        const destinationsGrid = document.getElementById('destinations-grid');
        const categoryTitle = document.getElementById('category-title');
        const categoryDesc = document.getElementById('category-desc');

        async function fetchCategoryDestinations() {
            if (!supabaseClient) {
                destinationsGrid.innerHTML = '<div class="col-span-full text-center text-red-500 py-10">Koneksi database gagal.</div>';
                return;
            }
            
            // Fetch category details
            const { data: catData, error: catError } = await supabaseClient
                .from('categories')
                .select('*')
                .eq('slug', categorySlug)
                .single();

            if (catError || !catData) {
                categoryTitle.textContent = "Kategori Tidak Ditemukan";
                destinationsGrid.innerHTML = '<div class="w-full text-center text-red-500 bg-white/10 py-4 rounded-lg">Gagal memuat kategori.</div>';
                return;
            }

            categoryTitle.textContent = `Destinasi ${catData.name}`;
            categoryDesc.textContent = catData.description || '';

            // Fetch destinations linked to this category
            const { data: destData, error: destError } = await supabaseClient
                .from('destinations')
                .select('*, category_destinations!inner(category_id)')
                .eq('category_destinations.category_id', catData.id);

            renderDestinations(destData || []);
        }

        function renderDestinations(destinationsToRender) {
            if (destinationsToRender.length === 0) {
                destinationsGrid.innerHTML = '<div class="w-full text-center text-gray-600 py-10 text-xl">Belum ada destinasi dalam kategori ini.</div>';
                return;
            }

            destinationsGrid.innerHTML = destinationsToRender.map(dest => {
                let imageUrl = dest.thumbnail;
                if (imageUrl && !imageUrl.startsWith('http')) {
                   imageUrl = `${SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
                }

                return `
                    <a href="/destinasi/${dest.slug}" class="rounded-2xl w-[calc(50%-0.5rem)] md:w-[calc(33.333%-0.67rem)] lg:w-[calc(20%-1.2rem)] relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
                        <img src="${imageUrl}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-5 left-0 w-full text-center px-4">
                            <h3 class="text-white font-bold text-lg md:text-xl drop-shadow-md leading-tight line-clamp-2" title="${dest.name}">${dest.name}</h3>
                        </div>
                    </a>
                `;
            }).join('');
        }

        fetchCategoryDestinations();
    </script>
</body>
</html>