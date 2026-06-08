@extends('user.layouts.app')

@section('title', 'Categories - INDETA')

@section('body-class', 'bg-white text-gray-800 font-sans antialiased overflow-x-hidden')

@section('content')
    <!-- Main Section -->
    <main class="relative min-h-[90vh] py-12 bg-white">
        <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search -->
            <div class="flex flex-col items-center justify-between mb-12 relative w-full pt-4">
                <div class="w-full flex justify-center items-center mb-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 tracking-wide drop-shadow-sm text-center">Kategori Destinasi</h1>
                </div>
                <div class="w-full relative z-20 flex justify-center md:justify-end">
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari kategori..." id="searchInput" class="w-full bg-gray-100 text-gray-800 rounded-full px-6 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#819E4A] font-medium shadow-sm transition-shadow">
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div id="categories-grid" class="flex flex-wrap justify-center gap-4 md:gap-6">
                <!-- Loading State -->
                <div class="w-full text-center text-gray-600 text-xl py-10">
                    Memuat kategori...
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
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
                   imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/indeta_assets/categories/${imageUrl}`;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=800&auto=format&fit=crop';
                }

                return `
                    <a href="/categories/${cat.slug}" class="w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.75rem)] md:w-[calc(25%-1.125rem)] lg:w-[calc(20%-1.2rem)] xl:w-[calc(16.666%-1.25rem)] rounded-2xl relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
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

        searchInput?.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filtered = allCategories.filter(c => 
                c.name.toLowerCase().includes(searchTerm)
            );
            renderCategories(filtered);
        });

        fetchCategories();
    </script>
@endsection