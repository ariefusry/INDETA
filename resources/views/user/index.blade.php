<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Beranda - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0eadd] text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col">
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
                    <a href="/index.html" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Beranda</a>
                    <a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Destinasi</a>
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

    <!-- Hero Section -->
    <section class="relative w-full h-[70vh] flex items-center justify-center overflow-hidden shadow-lg">
        <div id="hero-slider" class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover transition-opacity duration-1000">
        </div>
        <div class="absolute inset-0 bg-[#3e2723]/60 mix-blend-multiply"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-[#f0eadd] mb-6 drop-shadow-lg leading-tight">Jelajahi Pesona Nusantara <br>Bersama INDETA</h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 drop-shadow-md">Temukan keindahan destinasi wisata tersembunyi dan baca berbagai artikel inspiratif untuk persiapan petualangan Anda.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/destinasi" class="px-8 py-3 border-2 border-[#d6d6a8] text-[#d6d6a8] font-bold rounded-full hover:bg-[#d6d6a8] hover:text-[#3e2723] transition-all duration-300 shadow-lg hover:-translate-y-1">Mulai Ekspedisi</a>
                <a href="/artikel" class="px-8 py-3 border-2 border-[#d6d6a8] text-[#d6d6a8] font-bold rounded-full hover:bg-[#d6d6a8] hover:text-[#3e2723] transition-all duration-300 shadow-lg hover:-translate-y-1">Baca Artikel</a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full space-y-24">
        
        <!-- Highlight Destinasi -->
        <section>
            <div class="flex justify-between items-end mb-8 border-b-2 border-[#d6d6a8] pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-[#3e2723] mb-2">Destinasi Populer</h2>
                    <p class="text-[#5d4037] font-medium">Buka pintu menuju keajaiban baru.</p>
                </div>
                <a href="/destinasi" class="hidden sm:flex items-center text-[#3e2723] font-bold hover:text-[#5d4037] transition-colors">
                    Lihat Semua 
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div id="loading-destinasi" class="text-center py-10">
                <div class="inline-block animate-spin rounded-full h-10 w-10 border-b-2 border-[#3e2723] border-t-2"></div>
            </div>
            
            <div id="destinasi-grid" class="flex flex-wrap gap-4 justify-center sm:justify-start">
                <!-- Rendered via JS -->
            </div>
            
            <div class="mt-8 text-center sm:hidden">
                <a href="/destinasi" class="inline-block text-[#3e2723] border-2 border-[#3e2723] px-6 py-2 rounded-full font-bold hover:bg-[#3e2723] hover:text-white transition-colors">Lihat Semua Destinasi</a>
            </div>
        </section>

        <!-- Highlight Artikel -->
        <section>
            <div class="flex justify-between items-end mb-8 border-b-2 border-[#d6d6a8] pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-[#3e2723] mb-2">Bahan Bacaan</h2>
                    <p class="text-[#5d4037] font-medium">Cerita singkat dan tips menarik dari berbagai daerah.</p>
                </div>
                <a href="/artikel" class="hidden sm:flex items-center text-[#3e2723] font-bold hover:text-[#5d4037] transition-colors">
                    Lihat Semua
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div id="loading-artikel" class="text-center py-10">
                <div class="inline-block animate-spin rounded-full h-10 w-10 border-b-2 border-[#3e2723] border-t-2"></div>
            </div>

            <div id="artikel-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Rendered via JS -->
            </div>
            
            <div class="mt-8 text-center sm:hidden">
                <a href="/artikel" class="inline-block text-[#3e2723] border-2 border-[#3e2723] px-6 py-2 rounded-full font-bold hover:bg-[#3e2723] hover:text-white transition-colors">Lihat Semua Artikel</a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-[#3e2723] text-[#f0eadd] py-12 mt-auto border-t-[6px] border-[#d6d6a8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-bold mb-1 text-[#d6d6a8] flex items-center justify-center md:justify-start">
                    <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo" class="h-8 mr-3 filter brightness-0 invert">
                    INDETA
                </h3>
                <p class="text-sm opacity-80 mt-2 max-w-sm">Melangkah lebih jauh, membaca lebih dalam. Temukan inspirasi perjalananmu bersama kami.</p>
            </div>
            <div class="text-sm opacity-70 border-t md:border-t-0 md:border-l border-white/20 pt-6 md:pt-0 md:pl-6 text-center md:text-right">
                <p>&copy; 2026 INDETA</p>
                <p class="mt-1">Dibuat dengan ❤️ untuk Nusantara</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        const SUPABASE_URL = @json(env('SUPABASE_URL', ''));
        const SUPABASE_ANON_KEY = @json(env('SUPABASE_ANON_KEY', ''));

        let supabaseClient = null;
        if (window.supabase) {
            supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
        }

        const btnLogout = document.getElementById('btn-logout');
        const btnLogin = document.getElementById('btn-login');
        
        async function checkSession() {
            if (!supabaseClient) return;
            const { data } = await supabaseClient.auth.getSession();
            if (data && data.session && data.session.user) {
                btnLogout.classList.remove('hidden');
                btnLogin.classList.add('hidden');
            }
        }

        if (btnLogout) {
            btnLogout.addEventListener('click', async () => {
                await supabaseClient.auth.signOut();
                window.location.reload();
            });
        }

        async function loadDestinasiHome() {
            if (!supabaseClient) return;
            const grid = document.getElementById('destinasi-grid');
            const loading = document.getElementById('loading-destinasi');
            
            // Ambil 4 destinasi teratas
            const { data, error } = await supabaseClient
                .from('destinations')
                .select('*')
                .limit(5);

            loading.classList.add('hidden');

            if (error || !data || data.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 italic w-full text-center">Belum ada data destinasi tersedia.</p>';
                return;
            }

            grid.innerHTML = data.map(dest => {
                let imageUrl = dest.thumbnail;
                if (imageUrl && !imageUrl.startsWith('http')) {
                   imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
                }
                
                return `
                <a href="/destinasi/${dest.slug}" class="rounded-2xl w-[calc(50%-0.5rem)] md:w-[calc(20%-1rem)] relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-xl group cursor-pointer hover:-translate-y-2 transition-transform duration-300 block flex-grow-0 shrink-0">
                    <img src="${imageUrl}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-0 w-full text-center px-2">
                        <h3 class="text-white font-bold text-sm md:text-base lg:text-lg drop-shadow-md leading-tight">${dest.name}</h3>
                    </div>
                </a>
                `;
            }).join('');
        }

        async function loadArtikelHome() {
            if (!supabaseClient) return;
            const grid = document.getElementById('artikel-grid');
            const loading = document.getElementById('loading-artikel');
            
            // Ambil 3 artikel teratas
            const { data, error } = await supabaseClient
                .from('articles')
                .select('*')
                .order('created_at', { ascending: false })
                .limit(3);

            loading.classList.add('hidden');

            if (error || !data || data.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 italic text-center w-full col-span-full">Belum ada artikel tersedia.</p>';
                return;
            }

            grid.innerHTML = data.map(art => {
                let imageUrl = art.thumbnail;
                if (imageUrl && !imageUrl.startsWith('http')) {
                   imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
                }

                return `
                <a href="/artikel/${art.slug}" class="bg-white rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col cursor-pointer border border-[#d6d6a8]/50 hover:shadow-2xl">
                    <div class="w-full aspect-[4/3] bg-gray-200 overflow-hidden relative">
                        <img src="${imageUrl}" alt="${art.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#3e2723] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-1 bg-[#fdfbf7]">
                        <h3 class="text-xl font-bold text-[#3e2723] mb-3 line-clamp-2 leading-tight group-hover:text-[#5d4037] transition-colors">${art.title}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">${art.prolog}</p>
                        <div class="mt-auto pt-4 border-t border-gray-200">
                            <span class="inline-flex items-center font-bold text-sm text-[#8c8c62] group-hover:text-[#a0a071] transition-colors">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </div>
                    </div>
                </a>
                `;
            }).join('');
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
                    newImg.className = 'w-full h-full object-cover absolute inset-0 transition-opacity duration-1000 opacity-0';
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
                    }, 1000);
                    
                }, 5000); // Ganti tiap 5 detik
            }
        }

        checkSession();
        loadDestinasiHome();
        loadArtikelHome();
        loadHeroSlideshow();
    </script>
</body>
</html>