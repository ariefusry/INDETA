@extends('user.layouts.app')

@section('title', 'Kategori Destinasi - INDETA')

@section('content')
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
            <div id="destinations-grid" class="flex flex-wrap justify-center gap-4 md:gap-6">
                <!-- Loading State -->
                <div class="w-full text-center text-gray-600 text-xl py-10">
                    Memuat destinasi...
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        const categorySlug = "{{ $slug }}";
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
                   imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
                } else if (!imageUrl) {
                   imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
                }

                return `
                    <a href="/destinasi/${dest.slug}" class="w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.75rem)] md:w-[calc(25%-1.125rem)] lg:w-[calc(20%-1.2rem)] xl:w-[calc(16.666%-1.25rem)] rounded-2xl relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
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
@endsection