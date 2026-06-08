@extends('user.layouts.app')

@section('title', 'Destinasi - INDETA')

@section('body-class', 'bg-white text-gray-800 font-sans antialiased overflow-x-hidden')

@section('content')
    <!-- Main Section -->
    <main class="relative min-h-[90vh] py-12 bg-white">
        <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search -->
            <div class="flex flex-col items-center justify-between mb-12 relative w-full pt-4">
                <div class="w-full flex justify-center items-center mb-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 tracking-wide drop-shadow-sm text-center">Welcome To Indonesia</h1>
                </div>
                <div class="w-full relative z-20 flex justify-center md:justify-end">
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari destinasi..." id="searchInput" class="w-full bg-gray-100 text-gray-800 rounded-full px-6 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#819E4A] font-medium shadow-sm transition-shadow">
                    </div>
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
      const destinationsGrid = document.getElementById('destinations-grid');
      const searchInput = document.getElementById('searchInput');
      let allDestinations = [];

      async function fetchDestinations() {
        if (!supabaseClient) {
          destinationsGrid.innerHTML = '<div class="col-span-full text-center text-red-500 py-10">Koneksi database gagal.</div>';
          return;
        }
        
        const { data, error } = await supabaseClient
          .from('destinations')
          .select('*')
          .order('id', { ascending: true });

        if (error) {
          console.error(error);
          destinationsGrid.innerHTML = '<div class="w-full text-center text-red-500 bg-white/10 py-4 rounded-lg">Gagal memuat data destinasi.</div>';
          return;
        }

        allDestinations = data || [];
        renderDestinations(allDestinations);
      }

      function renderDestinations(destinationsToRender) {
        if (destinationsToRender.length === 0) {
            destinationsGrid.innerHTML = '<div class="w-full text-center text-gray-600 py-10 text-xl">Tidak ada destinasi yang cocok.</div>';
            return;
        }

          destinationsGrid.innerHTML = destinationsToRender.map(dest => {
            let imageUrl = dest.thumbnail;
            if (imageUrl && !imageUrl.startsWith('http')) {
               imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
            } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop'; // fallback
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

      searchInput?.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filtered = allDestinations.filter(d => 
          d.name.toLowerCase().includes(searchTerm)
        );
        renderDestinations(filtered);
      });

      fetchDestinations();
    </script>
@endsection
