@extends('user.layouts.app')

@section('title', 'Beranda - INDETA')

@section('body-class', 'bg-[#fdfbf7] text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col')

@section('content')
    <!-- Main Hero -->
    <section class="relative w-full h-[70vh] flex items-center justify-center overflow-hidden shadow-lg">
        <div id="hero-slider" class="absolute inset-0 w-full h-full">
            <img id="hero-initial-img" src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover transition-opacity duration-1000">
        </div>
        <!-- Gradient Overlay over the background images -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/60 mix-blend-multiply"></div>
        
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto flex flex-col items-center mt-10">
            <h1 class="text-4xl md:text-6xl lg:text-[5rem] font-serif-custom text-white mb-6 leading-tight text-shadow drop-shadow-2xl" style="letter-spacing: -1px;">
                Jelajahi Pesona Nusantara<br>Bersama "INDETA"
            </h1>
            <p class="text-base md:text-xl lg:text-2xl text-white mb-10 font-medium italic max-w-4xl drop-shadow-lg mx-auto leading-relaxed">
                "Jelajahi keindahan Destinasi Wisata Hidden Gem di Seluruh Nusantara dan<br>Temukan tempat inspiratif yang cocok untuk petualangan Anda"
            </p>
            <a href="/destinasi" class="inline-flex flex-col items-center justify-center px-8 py-3 md:px-10 md:py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-[#819E4A] transition-all duration-300 shadow-xl backdrop-blur-sm bg-black/20 hover:scale-105">
                <span class="text-lg md:text-xl tracking-wide uppercase">Mulai Ekspedisi</span>
            </a>
        </div>
    </section>

    <!-- Tailwind Safelist (To prevent classes used in JS from being purged) -->
    <div class="hidden bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10 z-20 z-50 pointer-events-none line-clamp-2 aspect-square md:aspect-[4/5] object-cover group-hover:scale-105 transition-transform duration-[600ms] bottom-4 left-0 w-full text-center px-2 w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.75rem)] md:w-[calc(25%-1.125rem)] lg:w-[calc(20%-1.2rem)] aspect-[4/3] bg-gray-100 object-contain md:object-cover text-xs md:text-sm text-base text-lg pt-4 flex-none p-5 md:p-6 mb-2 rounded-2xl relative bg-gray-200 overflow-hidden shadow-xl group cursor-pointer hover:-translate-y-2 block bg-white h-full hover:shadow-2xl flex flex-col border border-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-bold drop-shadow-md leading-tight text-[#819E4A] group-hover:text-[#6c853d] transition-colors mt-auto border-t"></div>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Highlight Destinasi -->
        <section class="mt-8 mb-16">
            <div class="flex justify-between items-end mb-12 border-b-2 border-[#819E4A] pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-[#3e2723] mb-2">Destinasi Populer</h2>
                    <p class="text-gray-600 font-medium">Buka pintu menuju keajaiban baru.</p>
                </div>
                <a href="/destinasi" class="hidden sm:flex items-center text-[#819E4A] font-bold hover:text-[#6c853d] transition-colors">
                    Lihat Semua 
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div id="loading-destinasi" class="text-center py-10">
                <div class="inline-block animate-spin rounded-full h-10 w-10 border-b-2 border-[#819E4A] border-t-2"></div>
            </div>
            
            <div id="destinasi-grid" class="flex flex-wrap justify-center sm:justify-start gap-4 md:gap-6">
                <!-- Rendered via JS -->
            </div>
            
            <div class="mt-12 text-center sm:hidden">
                <a href="/destinasi" class="inline-block text-[#819E4A] border-2 border-[#819E4A] px-6 py-2 rounded-full font-bold hover:bg-[#819E4A] hover:text-white transition-colors">Lihat Semua Destinasi</a>
            </div>
        </section>

        <!-- Highlight Artikel -->
        <section class="mt-16 mb-8">
            <div class="flex justify-between items-end mb-12 border-b-2 border-[#819E4A] pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-[#3e2723] mb-2">Bahan Bacaan</h2>
                    <p class="text-gray-600 font-medium">Cerita singkat dan tips menarik dari berbagai daerah.</p>
                </div>
                <a href="/artikel" class="hidden sm:flex items-center text-[#819E4A] font-bold hover:text-[#6c853d] transition-colors">
                    Lihat Semua
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div id="loading-artikel" class="text-center py-10">
                <div class="inline-block animate-spin rounded-full h-10 w-10 border-b-2 border-[#819E4A] border-t-2"></div>
            </div>

            <div id="artikel-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 items-stretch">
                <!-- Rendered via JS -->
            </div>
            
            <div class="mt-12 text-center sm:hidden">
                <a href="/artikel" class="inline-block text-[#819E4A] border-2 border-[#819E4A] px-6 py-2 rounded-full font-bold hover:bg-[#819E4A] hover:text-white transition-colors">Lihat Semua Artikel</a>
            </div>
        </section>

    </main>
@endsection

@section('scripts')
<script>
    const heroSlider = document.getElementById('hero-slider');
    let images = [
        'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1505993597083-3bd19fb75e57?q=80&w=1600&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=1600&auto=format&fit=crop'
    ];
    let currentIndex = 0;

    async function fetchSliderImages() {
        if (window.supabaseClient) {
            const { data, error } = await window.supabaseClient
                .from('destinations')
                .select('thumbnail')
                .limit(10);
            
            if (!error && data && data.length > 0) {
                let supabaseImages = data.map(d => {
                    if (d.thumbnail && !d.thumbnail.startsWith('http')) {
                        return `${window.SUPABASE_URL}/storage/v1/object/public/destinations/${d.thumbnail}`;
                    }
                    return d.thumbnail;
                }).filter(img => img);

                if (supabaseImages.length > 0) {
                    // Shuffle the array
                    images = supabaseImages.sort(() => Math.random() - 0.5);
                    // Set initial image
                    document.getElementById('hero-initial-img').src = images[0];
                }
            }
        }
        startSlider();
    }

    function startSlider() {
        if (images.length <= 1) return;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            const nextImg = document.createElement('img');
            nextImg.src = images[currentIndex];
            nextImg.className = 'absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000';
            
            heroSlider.appendChild(nextImg);
            
            // Fade in next image
            setTimeout(() => {
                nextImg.classList.remove('opacity-0');
                nextImg.classList.add('opacity-100');
            }, 50);

            // Remove old images after transition
            setTimeout(() => {
                while (heroSlider.children.length > 1) {
                    heroSlider.removeChild(heroSlider.firstChild);
                }
            }, 1050);
        }, 5000);
    }

    async function loadDestinasiHome() {
        if (!window.supabaseClient) return;
        const grid = document.getElementById('destinasi-grid');
        const loading = document.getElementById('loading-destinasi');
        
        // Ambil 5 destinasi teratas
        const { data, error } = await window.supabaseClient
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
               imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
            } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
            }
            
            return `
            <a href="/destinasi/${dest.slug}" class="z-0 w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.75rem)] md:w-[calc(25%-1.125rem)] lg:w-[calc(20%-1.2rem)] rounded-2xl relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-xl group cursor-pointer hover:-translate-y-2 transition-transform duration-300 block flex-none">
                <img src="${imageUrl}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, transparent 100%); z-index: 10;"></div>
                <div class="absolute bottom-4 left-0 w-full text-center px-3 pointer-events-none" style="z-index: 20;">
                    <h3 class="font-bold leading-tight" style="color: #ffffff; font-size: 1.125rem; margin: 0; text-shadow: 1px 1px 5px rgba(0,0,0,1); line-clamp: 2; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">${dest.name}</h3>
                </div>
            </a>
            `;
        }).join('');
    }

    async function loadArtikelHome() {
        if (!window.supabaseClient) return;
        const grid = document.getElementById('artikel-grid');
        const loading = document.getElementById('loading-artikel');
        
        // Ambil 3 artikel teratas
        const { data, error } = await window.supabaseClient
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
               imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/articles/${imageUrl}`;
            } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
            }

            return `
            <a href="/artikel/${art.slug}" class="bg-white h-full rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col cursor-pointer border border-gray-100 hover:shadow-2xl">
                <div class="w-full aspect-[4/3] bg-gray-100 overflow-hidden relative flex-none">
                    <img src="${imageUrl}" alt="${art.title}" class="w-full h-full object-contain md:object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-5 md:p-6 flex flex-col flex-1 bg-white">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 line-clamp-2 leading-tight group-hover:text-[#819E4A] transition-colors">${art.title}</h3>
                    <p class="text-gray-600 text-xs md:text-sm line-clamp-3 mb-4 leading-relaxed flex-1">${art.prolog || ''}</p>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <span class="inline-flex items-center font-bold text-xs md:text-sm text-[#819E4A] group-hover:text-[#6c853d] transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </div>
            </a>
            `;
        }).join('');
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchSliderImages();
        loadDestinasiHome();
        loadArtikelHome();
    });
</script>
@endsection
