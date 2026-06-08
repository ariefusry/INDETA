@extends('user.layouts.app')

@section('title', 'Produk UMKM - INDETA')

@section('body-class', 'bg-white text-gray-800 font-sans antialiased overflow-x-hidden')

@section('content')
    <!-- Main Section -->
    <main class="relative min-h-[90vh] py-12 bg-white">
        <div class="relative z-10 max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search -->
            <div class="flex flex-col items-center justify-between mb-12 relative w-full pt-4">
                <div class="w-full flex justify-center items-center mb-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 tracking-wide drop-shadow-sm text-center">Produk UMKM Lokal</h1>
                </div>
                <div class="w-full relative z-20 flex justify-center md:justify-end">
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari produk..." id="searchInput" class="w-full bg-gray-100 text-gray-800 rounded-full px-6 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#819E4A] font-medium shadow-sm transition-shadow">
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div id="products-grid" class="flex flex-wrap justify-center gap-4 md:gap-6">
                <!-- Loading State -->
                <div class="w-full text-center text-gray-600 text-xl py-10">
                    Memuat produk umkm...
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
      const productsGrid = document.getElementById('products-grid');
      const searchInput = document.getElementById('searchInput');
      let allProducts = [];

      async function fetchProducts() {
        if (!supabaseClient) {
          productsGrid.innerHTML = '<div class="col-span-full text-center text-red-500 py-10">Koneksi database gagal.</div>';
          return;
        }
        
        const { data, error } = await supabaseClient
          .from('umkm_products')
          .select('*')
          .order('id', { ascending: true });

        if (error) {
          console.error(error);
          productsGrid.innerHTML = '<div class="w-full text-center text-red-500 bg-white/10 py-4 rounded-lg">Gagal memuat data produk.</div>';
          return;
        }

        allProducts = data || [];
        renderProducts(allProducts);
      }

      function renderProducts(productsToRender) {
        if (productsToRender.length === 0) {
            productsGrid.innerHTML = '<div class="w-full text-center text-gray-600 py-10 text-xl">Tidak ada produk yang cocok.</div>';
            return;
        }

          productsGrid.innerHTML = productsToRender.map(dest => {
            let imageUrl = dest.image_url;
            if (imageUrl && !imageUrl.startsWith('http')) {
               imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/umkm_products/${imageUrl}`;
            } else if (!imageUrl) {
               imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop'; // fallback
            }

            let priceLabel = 'Lihat Detail Harga';
            if (dest.price_min && dest.price_max) {
               priceLabel = 'Rp ' + Number(dest.price_min).toLocaleString('id-ID') + ' — Rp ' + Number(dest.price_max).toLocaleString('id-ID');
            } else if (dest.price_list && dest.price_list.length > 0) {
               priceLabel = 'Mulai Rp ' + Number(dest.price_list[0].price).toLocaleString('id-ID');
            }

            return `
              <a href="/product/${dest.slug}" class="w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.75rem)] md:w-[calc(25%-1.125rem)] lg:w-[calc(20%-1.2rem)] xl:w-[calc(16.666%-1.25rem)] rounded-2xl relative aspect-square md:aspect-[4/5] bg-gray-200 overflow-hidden shadow-lg group cursor-pointer hover:-translate-y-1 transition-transform duration-300 block">
                  <img src="${imageUrl}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[600ms]">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                  <div class="absolute bottom-5 left-0 w-full text-center px-4">
                        <h3 class="text-white font-bold text-lg md:text-xl drop-shadow-md leading-tight line-clamp-2" title="${dest.name}">${dest.name}</h3>
                        <p class="text-yellow-400 font-bold mt-1 text-sm md:text-base">${priceLabel}</p>
                  </div>
              </a>
            `;
        }).join('');
      }

      searchInput?.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filtered = allProducts.filter(d => 
          d.name.toLowerCase().includes(searchTerm)
        );
        renderProducts(filtered);
      });

      fetchProducts();
    </script>
@endsection
