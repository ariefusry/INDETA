@extends('user.layouts.app')

@section('title', 'Product Detail - INDETA')

@section('content')
    <!-- Main Section -->
    <main class="flex-1 bg-white text-gray-800">
        <!-- Sub-header (Breadcrumb, Title, Search) -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Breadcrumb -->
                <div class="flex-1 flex justify-start items-center space-x-3 mb-4 md:mb-0">
                    <a href="/product" class="text-gray-700 hover:text-gray-900 flex items-center font-bold text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1.5 rounded-lg mr-2 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <span id="breadcrumb-text" class="text-sm md:text-base font-semibold tracking-wide text-gray-500">Produk UMKM / ...</span>
                </div>
                
                <!-- Center Title -->
                <div class="flex-2 flex justify-center w-full md:w-auto text-center hidden">       
                    <h1 id="page-title" class="text-2xl md:text-4xl font-bold tracking-wider text-gray-900">Memuat...</h1>
                </div>
                
                <!-- Right Spacer -->
                <div class="hidden md:block flex-1"></div>
            </div>

            <!-- Content Box -->
            <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pb-12 relative mt-4">
                <div class="bg-white text-gray-800 flex flex-col md:flex-row items-stretch gap-8 min-h-[500px]">
                    <!-- Image Left Side Wrapper -->
                    <div class="w-full md:w-5/12 bg-white rounded-xl">
                        <div class="md:sticky md:top-28 h-[400px] md:h-[calc(100vh-10rem)] max-h-[600px] w-full overflow-hidden rounded-2xl ring-1 ring-black/5 shadow-md">
                            <img id="dest-image" src="" alt="Cover" class="w-full h-full object-cover object-center hidden hover:scale-105 transition-transform duration-500">
                            <div id="img-loading" class="w-full h-full flex items-center justify-center text-gray-500 bg-gray-100 font-medium">
                                Memuat gambar...
                            </div>
                        </div>
                    </div>

                    <!-- Content Right Side -->
                    <div class="w-full md:w-7/12 flex flex-col justify-start pt-4 md:pt-2">
                        <!-- Title -->
                        <h2 id="right-page-title" class="text-3xl md:text-5xl font-black mb-6 uppercase text-gray-800">MEMUAT...</h2>
                        
                        <!-- Deskripsi Produk -->
                        <div id="desc-text" class="text-gray-900 text-sm md:text-base text-justify leading-relaxed mb-8 whitespace-pre-line font-medium">
                            Memuat...
                        </div>

                        <!-- Harga -->
                        <h3 id="price-title" class="text-red-500 font-bold text-lg md:text-xl mb-3">Range Harga</h3>
                        <ul id="price-list-container" class="list-disc pl-5 text-red-500 font-semibold mb-8 space-y-2">
                            <li class="italic text-gray-500">Informasi harga belum tersedia.</li>
                        </ul>

                        <!-- Link Sosial Media & Maps -->
                        <div id="maps-header" class="hidden">
                            <h3 class="text-red-500 font-bold text-lg md:text-xl mb-2">Location:</h3>
                            <div id="maps-container" class="mt-1 break-all space-y-2"></div>
                            <div id="social-container" class="mt-2 break-all space-y-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
      const CURRENT_SLUG = "{{ $slug }}";

      document.addEventListener('DOMContentLoaded', () => {
          loadProductDetail();
      });

      async function loadProductDetail() {
          if (!supabaseClient) return;

          const { data: dests, error } = await supabaseClient
            .from('umkm_products')
            .select('*')
            .eq('slug', CURRENT_SLUG)
            .limit(1);

          if (error || !dests || dests.length === 0) {
              document.getElementById('right-page-title').textContent = "Produk Tidak Ditemukan";
              document.getElementById('desc-text').textContent = "Kami tidak bisa menemukan produk ini.";
              document.getElementById('img-loading').textContent = "Gambar tidak tersedia";
              return;
          }

          const dest = dests[0];

          // UI Update
          document.getElementById('right-page-title').textContent = dest.name;
          document.getElementById('breadcrumb-text').textContent = `Produk UMKM / ${dest.name}`;
          document.getElementById('desc-text').textContent = (dest.description || "Tidak ada deskripsi tersedia.");

          // Image Logic
          const imgEl = document.getElementById('dest-image');
          const loadingEl = document.getElementById('img-loading');
          if (dest.image_url) {
              let finalImg = dest.image_url.startsWith('http') 
                  ? dest.image_url 
                  : `${window.SUPABASE_URL}/storage/v1/object/public/umkm_products/${dest.image_url}`;
              
              imgEl.src = finalImg;
              imgEl.onload = () => {
                  loadingEl.classList.add('hidden');
                  imgEl.classList.remove('hidden');
              };
          } else {
              loadingEl.textContent = "Tidak ada gambar";
          }

          // Price Logic
          const priceListContainer = document.getElementById('price-list-container');
          const priceTitle = document.getElementById('price-title');
          
          // Show range harga if available
          if (dest.price_min && dest.price_max) {
              priceTitle.textContent = 'Rp ' + Number(dest.price_min).toLocaleString('id-ID') + ' — Rp ' + Number(dest.price_max).toLocaleString('id-ID');
          }
          
          if (dest.price_list && Array.isArray(dest.price_list) && dest.price_list.length > 0) {
              priceListContainer.innerHTML = dest.price_list.map(p => {
                  let formatPrice = p.price;
                  if (!isNaN(p.price) && p.price !== '') {
                      formatPrice = 'Rp ' + Number(p.price).toLocaleString('id-ID');
                  } else if(p.price && !p.price.toString().toLowerCase().includes('rp')) {
                      formatPrice = 'Rp ' + p.price;
                  }
                  return `<li class="text-red-500"><span class="font-bold text-gray-800">${p.name}</span>: ${formatPrice}</li>`;
              }).join('');
          } else {
              priceListContainer.innerHTML = '<li class="italic text-gray-400">Belum ada varian harga</li>';
          }

          // Maps & Social Logic
          const mapsContainer = document.getElementById('maps-container');
          const socialContainer = document.getElementById('social-container');
          let hasLink = false;
          
          if (dest.gmaps_url) {
              mapsContainer.innerHTML = `<a href="${dest.gmaps_url}" target="_blank" rel="noopener noreferrer" class="text-blue-500 font-bold hover:underline text-sm md:text-base leading-relaxed break-all">${dest.gmaps_url}</a>`;
              hasLink = true;
          }

          if (dest.social_media && dest.social_media.url) {
              socialContainer.innerHTML = `<a href="${dest.social_media.url}" target="_blank" rel="noopener noreferrer" class="text-blue-500 font-bold hover:underline text-sm md:text-base leading-relaxed break-all">${dest.social_media.url}</a>`;
              hasLink = true;
          }

          if (hasLink) {
              document.getElementById('maps-header').classList.remove('hidden');
          }
      }
    </script>
@endsection