<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Detail - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col">
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
                    <a href="/destinasi" class="px-5 py-2 bg-black/20 rounded-[30px] text-white font-bold transition-colors">Destination</a>
                    <a href="/categories" class="nav-categories text-white hover:text-gray-200 font-semibold transition-colors">Categories</a>
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
    <main class="flex-1 bg-white text-gray-800">
        <!-- Sub-header (Breadcrumb, Title, Search) -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Breadcrumb -->
                <div class="flex-1 flex justify-start items-center space-x-3 mb-4 md:mb-0">
                    <a href="/destinasi" class="text-gray-700 hover:text-gray-900 flex items-center font-bold text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1.5 rounded-lg mr-2 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <span id="breadcrumb-text" class="text-sm md:text-base font-semibold tracking-wide text-gray-500">Destinasi / ...</span>
                </div>
                
                                <!-- Center Title -->
                <div class="flex-2 flex justify-center w-full md:w-auto text-center">       
                    <h1 id="page-title" class="text-2xl md:text-4xl font-bold tracking-wider text-gray-900">Memuat...</h1>
                </div>
                
                <!-- Right Spacer -->
                <div class="hidden md:block flex-1"></div>

                
        </div>

        <!-- Content Box -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pb-12 relative">
            <div class="bg-white text-gray-800 rounded-sm shadow-xl flex flex-col md:flex-row min-h-[600px] items-stretch">
                <!-- Image Left Side Wrapper -->
                <div class="w-full md:w-5/12 p-4 md:p-6 lg:p-8 bg-white rounded-t-sm md:rounded-l-sm border-r border-gray-100">
                    <div class="md:sticky md:top-28 h-[350px] md:h-[calc(100vh-10rem)] max-h-[700px] w-full overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                        <img id="dest-image" src="" alt="Cover" class="w-full h-full object-cover object-center hidden transition-transform duration-500 hover:scale-105">
                        <div id="img-loading" class="w-full h-full flex items-center justify-center text-gray-500 bg-gray-100">
                            Memuat gambar...
                        </div>
                    </div>
                </div>

                <!-- Content Right Side -->
                <div class="w-full md:w-7/12 p-6 md:p-10 flex flex-col justify-start">
                    <div id="accordion-container" class="space-y-3 w-full">
                        
                        <!-- Deskripsi Destinasi -->
                        <div class="accordion-item">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-desc', this)">
                                <span>&#8226; Deskripsi Destinasi</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-desc" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base text-justify" style="white-space: pre-line;">
                                <p id="desc-text" class="whitespace-pre-line">Memuat...</p>
                            </div>
                        </div>

                        <!-- Jadwal & Fasilitas -->
                        <div class="accordion-item">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-jadwal', this)">
                                <span>&#8226; Jadwal & Fasilitas</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-jadwal" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <p class="italic text-gray-500">Informasi jadwal & fasilitas belum tersedia.</p>
                            </div>
                        </div>

                        <!-- Link Sosial Media & Maps -->
                        <div class="accordion-item flex-col hidden" id="maps-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-maps', this)">
                                <span>&#8226; Link Sosial Media & Maps</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-maps" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base space-y-2">
                                <div id="maps-container"></div>
                            </div>
                        </div>

                        <!-- Ulasan & Rating -->
                        <div class="accordion-item">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-rating', this)">
                                <span>&#8226; Ulasan & Rating</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-rating" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <div class="flex items-center space-x-2 border-b pb-3 mb-4" id="rating-container">
                                    <span class="font-bold text-2xl" id="avg-rating">0.0</span>
                                    <div id="avg-stars" class="flex space-x-1 text-yellow-400"></div>
                                    <span class="text-gray-500 text-sm" id="rating-count">(0 ulasan pengunjung)</span>
                                </div>
                                <div id="reviews-list" class="space-y-3">
                                    <p class="text-gray-500 italic">Belum ada ulasan.</p>
                                </div>
                                <button type="button" id="btn-show-all-reviews" class="mt-3 text-[#819E4A] font-bold hover:underline text-sm hidden">
                                    Lihat Semua Ulasan &rarr;
                                </button>
                                
                                <!-- Add Review Section Button -->
                                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-base">Punya Pengalaman Menarik?</h4>
                                        <p class="text-xs text-gray-600 mt-1">Beritahu pengunjung lain tentang pengalaman serumu di sini!</p>
                                    </div>
                                    <button type="button" id="btn-open-review" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-sm flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        <span>Tulis Ulasan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prize & Paket Wisata -->
                        <div class="accordion-item flex-col hidden" id="tour-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-tour', this)">
                                <span>&#8226; Prize & Paket Wisata</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-tour" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <div id="tour-container" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                            </div>
                        </div>

                        <!-- Produk UMKM Lokal -->
                        <div class="accordion-item flex-col hidden" id="umkm-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-umkm', this)">
                                <span>&#8226; Produk UMKM Lokal</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-umkm" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <div id="umkm-container" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                            </div>
                        </div>

                        <!-- Detail Kontak Reservasi -->
                        <div class="accordion-item flex-col hidden" id="contact-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-contact', this)">
                                <span>&#8226; Detail Kontak Reservasi</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-contact" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <p id="contact-text" class="leading-relaxed"></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- All Reviews Modal -->
<div id="all-reviews-modal" class="fixed inset-0 z-50 hidden bg-[rgba(0,0,0,0.5)] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative flex flex-col max-h-[80vh]">
        <button type="button" id="close-all-reviews-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Semua Ulasan</h3>
        <div class="overflow-y-auto pr-2 pb-4 flex-1">
            <ul id="all-reviews-list" class="space-y-4">
                <!-- Diisi JS -->
            </ul>
        </div>
    </div>
</div>

<!-- Login Required Modal -->
<div id="login-required-modal" class="fixed inset-0 z-[110] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden text-center relative p-6">
        <button type="button" id="btn-close-login-required" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 font-bold text-2xl leading-none">&times;</button>
        <div class="mb-4 text-orange-500 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Login Diperlukan</h3>
        <p class="text-sm text-gray-600 mb-6">Kamu harus login terlebih dahulu untuk dapat memberikan rating dan ulasan.</p>
        <div class="flex flex-col space-y-3">
            <a href="/login" class="w-full py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-md block">Login Sekarang</a>
            <button type="button" id="btn-cancel-login-required" class="w-full py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition-colors">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Review -->
    <div id="review-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-4">
                    <h3 class="text-xl font-bold text-gray-800">Bagaimana Pengalamanmu?</h3>
                    <button type="button" id="btn-close-review" class="text-gray-400 hover:text-red-500 font-bold text-2xl leading-none">&times;</button>
                </div>
                <form id="form-review" class="space-y-5">
                    <input type="hidden" id="dest-id" value="">
                    <!-- Star Rating -->
                    <div class="text-center">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Rating Bintang</label>
                        <div id="star-rating-container" class="flex justify-center space-x-2 cursor-pointer">
                            <svg data-val="1" class="w-10 h-10 text-gray-300 star-svg transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg data-val="2" class="w-10 h-10 text-gray-300 star-svg transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg data-val="3" class="w-10 h-10 text-gray-300 star-svg transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg data-val="4" class="w-10 h-10 text-gray-300 star-svg transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg data-val="5" class="w-10 h-10 text-gray-300 star-svg transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <input type="hidden" id="input-rating" value="0">
                        <p id="star-error" class="text-red-500 text-xs font-bold mt-2 hidden">Silakan pilih rating bintang terlebih dahulu!</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tuliskan pengalaman kamu</label>
                        <textarea id="input-comment" rows="4" class="w-full border border-gray-300 text-gray-800 rounded-lg px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white resize-none" placeholder="Ceritakan pengalaman terbaikmu di sini..." required></textarea>
                    </div>
                    <button type="submit" id="btn-submit-review" class="w-full py-3 bg-gray-800 text-white rounded-lg font-bold hover:bg-black transition-colors shadow-lg cursor-pointer disabled:opacity-50 mt-4">Kirim Ulasan</button> 
                    <div id="review-msg-container" class="mt-4 hidden p-3 rounded-lg text-center font-bold text-sm"></div>
                </form>
            </div>
        </div>
    </div>

    

<!-- Item Detail Modal (Tour/UMKM) -->
<div id="item-detail-modal" class="fixed inset-0 z-[120] flex items-center justify-center p-4 hidden bg-black/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="relative bg-white flex justify-center border-b border-gray-100">
            <img id="detail-modal-image" src="" alt="Detail Image" class="w-full h-auto max-h-[65vh] object-contain">
            <button type="button" id="close-item-detail-modal" class="absolute top-3 right-3 bg-black/50 text-white rounded-full p-2 hover:bg-black transition-colors focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <h3 id="detail-modal-title" class="text-2xl font-bold text-gray-800 mb-2"></h3>
            <p id="detail-modal-price" class="text-lg font-semibold text-emerald-600 mb-4"></p>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p id="detail-modal-desc" class="text-gray-700 text-sm whitespace-pre-wrap leading-relaxed"></p>
            </div>
        </div>
    </div>
</div>

    <!-- Passing PHP slug to JS -->
    <script>
      const CURRENT_SLUG = "{{ $slug }}";

      function toggleAccordion(contentId, button) {
          const content = document.getElementById(contentId);
          const icon = button.querySelector('.toggle-icon');
          
          if (content.classList.contains('hidden')) {
              content.classList.remove('hidden');
              icon.textContent = '-';
          } else {
              content.classList.add('hidden');
              icon.textContent = '+';
          }
      }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
      const SUPABASE_URL = @json(config('services.supabase.url'));
      const SUPABASE_ANON_KEY = @json(config('services.supabase.key'));

      let supabaseClient = null;
      let currentDestinationId = null;
      let currentUser = null;

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

                // Admin check
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

      
      
      
      

      async function initPage() {
        if (!supabaseClient) return;

        // Check authentication
        const { data: authData } = await supabaseClient.auth.getSession();
        if (authData && authData.session) {
            currentUser = authData.session.user;
            if (authButtons) authButtons.classList.add('hidden');
            if (userProfile) userProfile.classList.remove('hidden');
            
            const meta = currentUser.user_metadata || {};
            const name = meta.full_name || currentUser.email.split('@')[0];
            const shortName = name.split(' ')[0];
            
            const welcomeText = document.getElementById('welcome-text');
            const userAvatar = document.getElementById('user-avatar');
            if(welcomeText) welcomeText.textContent = 'Welcome "' + shortName + '"';
            if(userAvatar) userAvatar.src = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&background=random';
        }

        // 2. Fetch Destination Data by Slug
        const { data: dests, error } = await supabaseClient
          .from('destinations')
          .select('*')
          .eq('slug', CURRENT_SLUG)
          .limit(1);

        if (error || !dests || dests.length === 0) {
            document.getElementById('page-title').textContent = "Destinasi Tidak Ditemukan";
            document.getElementById('img-loading').textContent = "Gambar tidak tersedia";
            return;
        }

        const dest = dests[0];
        currentDestinationId = dest.id;

        // Update UI
        document.getElementById('page-title').textContent = dest.name;
        document.getElementById('breadcrumb-text').textContent = `Destinasi / ${dest.name}`;
        document.getElementById('desc-text').textContent = "" + (dest.description || "Tidak ada deskripsi tersedia.");
        document.getElementById('dest-id').value = dest.id;

        // Map & Social Media Link Logic
        const mapsContainer = document.getElementById('maps-container');
        let linksHtml = '';
        
        if (dest.gmaps_url) {
            linksHtml += '<div class="flex items-start mt-2"><svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-[2px] mr-2 shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg><a href="' + dest.gmaps_url + '" target="_blank" rel="noopener noreferrer" class="text-blue-600 font-bold hover:underline text-sm md:text-base leading-relaxed">Peta Lokasi ' + dest.name + ' di Google Maps</a></div>';
        }

        if (dest.social_media && dest.social_media.url) {
            linksHtml += '<div class="flex items-start mt-2"><svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-[2px] mr-2 shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg><a href="' + dest.social_media.url + '" target="_blank" rel="noopener noreferrer" class="text-blue-600 font-bold hover:underline text-sm md:text-base leading-relaxed">Kunjungi Sosial Media Resmi ' + dest.name + '</a></div>';
        }

        if (linksHtml !== '') {
            document.getElementById('maps-header').classList.remove('hidden');
            mapsContainer.innerHTML = linksHtml;
        }

        // Contact Detail
        if (dest.contact_details) {
            document.getElementById('contact-header').classList.remove('hidden');
            document.getElementById('contact-text').textContent = dest.contact_details;
        }

        // Tour Packages Logic
        const { data: packagesData, error: errPkg } = await supabaseClient
            .from('tour_packages')
            .select('*')
            .eq('destination_id', dest.id);

        const th = document.getElementById('tour-header');
        th.classList.remove('hidden');
        th.classList.add('flex');

        if (packagesData && packagesData.length > 0) {
            console.log('Fetched Tour Packages:', packagesData);
            let tourHtml = '';
            packagesData.forEach(pkg => {
                let pkgImage = pkg.image_url;
                if (pkgImage && !pkgImage.startsWith('http')) {
                    pkgImage = SUPABASE_URL + '/storage/v1/object/public/tour_packages/' + pkgImage;
                } else if (!pkgImage) {
                    pkgImage = 'https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=400&auto=format&fit=crop';
                }
                const serializedPkg = encodeURIComponent(JSON.stringify({...pkg, resolvedImage: pkgImage}));
                tourHtml += `
                <div class="cursor-pointer hover:shadow-lg transition-transform transform hover:-translate-y-1 bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col" onclick="showItemDetail('${serializedPkg}')">
                    <div class="w-full aspect-[3/4] relative">
                        <img src="${pkgImage}" class="absolute inset-0 w-full h-full object-cover object-center" alt="Poster">
                    </div>
                    <div class="p-3 text-center bg-gray-50 flex-1 flex items-center justify-center border-t border-gray-100">
                        <span class="font-bold text-gray-800 text-sm md:text-md">${pkg.title || 'Paket'}</span>
                    </div>
                </div>
                `;
            });
            document.getElementById('tour-container').innerHTML = tourHtml;
        } else {
            document.getElementById('tour-container').innerHTML = '<p class="col-span-2 md:col-span-3 text-center text-gray-500 italic py-4">Belum ada data paket wisata untuk destinasi ini.</p>';
        }

        // UMKM Lokal
        const { data: umkmData, error: errUmkm } = await supabaseClient
            .from('umkm_products')
            .select('*')
            .eq('destination_id', dest.id);

        const uh = document.getElementById('umkm-header');
        uh.classList.remove('hidden');
        uh.classList.add('flex');

        if (umkmData && umkmData.length > 0) {
            let umkmHtml = '';
            umkmData.forEach(prod => {
                let pImage = prod.image_url;
                if (pImage && !pImage.startsWith('http')) {
                    pImage = SUPABASE_URL + '/storage/v1/object/public/umkm_products/' + pImage;
                } else if (!pImage) {
                    pImage = 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=400&auto=format&fit=crop';
                }
                const serializedProd = encodeURIComponent(JSON.stringify({...prod, title: prod.name, resolvedImage: pImage}));
                umkmHtml += `
                <div class="cursor-pointer hover:shadow-lg transition-transform transform hover:-translate-y-1 bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col" onclick="showItemDetail('${serializedProd}')">
                    <img src="${pImage}" class="w-full h-32 md:h-40 object-cover" alt="Image">
                    <div class="p-3 text-center bg-gray-50 flex-1 flex items-center justify-center">
                        <span class="font-bold text-gray-800 text-sm md:text-md">${prod.name || 'Produk'}</span>
                    </div>
                </div>
                `;
            });
            document.getElementById('umkm-container').innerHTML = umkmHtml;
        } else {
            document.getElementById('umkm-container').innerHTML = '<p class="col-span-2 md:col-span-3 text-center text-gray-500 italic py-4">Belum ada data produk UMKM untuk destinasi ini.</p>';
        }

        // Image Logic
        let imageUrl = dest.thumbnail;
        if (imageUrl && !imageUrl.startsWith('http')) {
            imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
        } else if (!imageUrl) {
            imageUrl = 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800&auto=format&fit=crop';
        }
        
        const imgEl = document.getElementById('dest-image');
        imgEl.src = imageUrl;
        imgEl.onload = () => {
            imgEl.classList.remove('hidden');
            document.getElementById('img-loading').classList.add('hidden');
        };

        // Fetch & Render Reviews
        fetchReviews(dest.id);
      }

      async function fetchReviews(destId) {
          const { data: reviews, error } = await supabaseClient
            .from('reviews')
            .select('*')
            .eq('destination_id', destId)
            .order('created_at', { ascending: false });

          if (error) {
              console.error("Gagal load review:", error);
              return;
          }

          const reviewsList = document.getElementById('reviews-list');
          const avgStarsContainer = document.getElementById('avg-stars');
          const avgRatingElem = document.getElementById('avg-rating');
          const ratingCountElem = document.getElementById('rating-count');
          const btnShowAll = document.getElementById('btn-show-all-reviews');

          const starSvg = '<svg class="w-4 h-4 text-yellow-400 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
          const grayStarSvg = '<svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';

          if (!reviews || reviews.length === 0) {
              if (avgRatingElem) avgRatingElem.textContent = "0.0";
              if (avgStarsContainer) {
                  let html = '';
                  for(let i=0; i<5; i++) html += grayStarSvg;
                  avgStarsContainer.innerHTML = html;
              }
              if (ratingCountElem) ratingCountElem.textContent = "(0 ulasan pengunjung)";

              reviewsList.innerHTML = '<p class="text-gray-500 italic ml-2">Belum ada pengunjung yang mengulas.</p>';
              if(btnShowAll) btnShowAll.classList.add('hidden');
              return;
          }

          // Calc average rating
          const totalRating = reviews.reduce((sum, r) => sum + r.rating, 0);    
          const avgRatingStr = (totalRating / reviews.length).toFixed(1);
          const avgRatingNum = Math.round(totalRating / reviews.length);
          
          if (avgRatingElem) avgRatingElem.textContent = avgRatingStr;
          
          if (avgStarsContainer) {
              let avgHtml = '';
              for(let i=0; i<5; i++) {
                  avgHtml += (i < avgRatingNum) ? starSvg : grayStarSvg;
              }
              avgStarsContainer.innerHTML = avgHtml;
          }

          if (ratingCountElem) ratingCountElem.textContent = `(${reviews.length} ulasan pengunjung)`;

          // Generate HTML helper
          const generateReviewHtml = (r) => {
             const safeComment = r.comment ? r.comment.replace(/</g, "&lt;").replace(/>/g, "&gt;") : '';
             let starsHtml = '<div class="flex space-x-0.5">';
             for(let i = 0; i < 5; i++) {
                 starsHtml += i < r.rating ? starSvg : grayStarSvg;
             }
             starsHtml += '</div>';

             return `<li class="bg-white/90 backdrop-blur border border-white/40 p-4 rounded-xl shadow-lg ring-1 ring-gray-900/5 mb-3 flex flex-col list-none w-full">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-600 to-emerald-400 text-white flex items-center justify-center font-bold text-sm ring-2 ring-white">${(r.user_name || 'A').charAt(0).toUpperCase()}</div>
                        <div class="text-gray-800 font-extrabold text-sm tracking-wide mt-0.5">${(r.user_name || 'Pengunjung Anonim').replace(/</g, '&lt;').replace(/>/g, '&gt;')}</div>
                    </div>
                    ${starsHtml}
                </div>
                <p class="text-gray-700 text-sm mt-3 ml-1 break-words">${safeComment}</p> 
             </li>`;
          };

          // Sort reviews by rating (highest first) for the main view
          const sortedReviews = [...reviews].sort((a,b) => b.rating - a.rating);
          
          // Display top 2 reviews in main view
          const top2 = sortedReviews.slice(0, 2);
          reviewsList.innerHTML = top2.map(generateReviewHtml).join("");

          // Display all in modal
          const allReviewsList = document.getElementById('all-reviews-list');
          if (allReviewsList) {
              allReviewsList.innerHTML = sortedReviews.map(generateReviewHtml).join("");
          }

          if (btnShowAll) {
              if (reviews.length > 2) {
                  btnShowAll.classList.remove('hidden');
              } else {
                  btnShowAll.classList.add('hidden');
              }
          }
      }

      // Item Detail Modal Logic (Tour & UMKM)
      const itemDetailModal = document.getElementById('item-detail-modal');
      const closeItemDetailModal = document.getElementById('close-item-detail-modal');
      
      if(closeItemDetailModal) {
          closeItemDetailModal.addEventListener('click', () => {
              itemDetailModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          });
      }

      window.showItemDetail = function(encodedData) {
          const item = JSON.parse(decodeURIComponent(encodedData));
          document.getElementById('detail-modal-image').src = item.resolvedImage;
          document.getElementById('detail-modal-title').textContent = item.title || item.name;
          
          const priceContainer = document.getElementById('detail-modal-price');
          if (item.price_list && Array.isArray(item.price_list) && item.price_list.length > 0) {
              priceContainer.innerHTML = '<ul class="list-disc pl-5 my-2 text-sm">' + item.price_list.map(p => `<li><span class="font-bold">${p.name}</span>: Rp ${Number(p.price).toLocaleString('id-ID')}</li>`).join('') + '</ul>';
          } else if (item.price) {
              const numPrice = Number(item.price);
              priceContainer.textContent = 'Rp ' + (!isNaN(numPrice) ? numPrice.toLocaleString('id-ID') : item.price);
          } else {
              priceContainer.textContent = '';
          }
          
          document.getElementById('detail-modal-desc').textContent = item.description || 'Tidak ada deskripsi.';
          
          itemDetailModal.classList.remove('hidden');
          document.body.classList.add('overflow-hidden');
      };

      // Review Modal & Star Logic
      const btnShowAllEvt = document.getElementById('btn-show-all-reviews');
      if(btnShowAllEvt) {
          btnShowAllEvt.addEventListener('click', () => {
              document.getElementById('all-reviews-modal').classList.remove('hidden');
          });
      }
      
      const btnCloseAllEvt = document.getElementById('close-all-reviews-modal');
      if(btnCloseAllEvt) {
          btnCloseAllEvt.addEventListener('click', () => {
              document.getElementById('all-reviews-modal').classList.add('hidden');
          });
      }

// Review Modal & Star Logic
      const reviewModal = document.getElementById('review-modal');
      const msgContainer = document.getElementById('review-msg-container');
      const btnOpenReview = document.getElementById('btn-open-review');
      const btnCloseReview = document.getElementById('btn-close-review');
      const ratingInput = document.getElementById('input-rating');
      const starError = document.getElementById('star-error');
      const svgs = document.querySelectorAll('.star-svg');

      const loginModal = document.getElementById('login-required-modal');
      const closeLoginEls = [document.getElementById('btn-close-login-required'), document.getElementById('btn-cancel-login-required')];
      
      if (closeLoginEls[0] && closeLoginEls[1]) {
          closeLoginEls.forEach(el => el.addEventListener('click', () => {
              loginModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }));
      }

      window.addEventListener('click', (e) => {
          if (e.target === loginModal) {
              loginModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }
      });

      if (btnOpenReview) {
          btnOpenReview.addEventListener('click', () => {
              if (!currentUser) {
                  loginModal.classList.remove('hidden');
                  document.body.classList.add('overflow-hidden');
                  return;
              }
              reviewModal.classList.remove('hidden');
              document.body.classList.add('overflow-hidden');
          });
      }

      if (btnCloseReview) {
          btnCloseReview.addEventListener('click', () => {
              reviewModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
              msgContainer.classList.add('hidden');
          });
      }
      
      // Close modal on outside click
      window.addEventListener('click', (e) => {
          if (e.target === reviewModal) {
              reviewModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }
      });

      function updateStars(val) {
          svgs.forEach(s => {
              const sVal = parseInt(s.getAttribute('data-val'));
              if(sVal <= val) {
                  s.classList.remove('text-gray-300');
                  s.classList.add('text-yellow-400');
              } else {
                  s.classList.remove('text-yellow-400');
                  s.classList.add('text-gray-300');
              }
          });
      }

      svgs.forEach(svg => {
          svg.addEventListener('click', function() {
              const val = parseInt(this.getAttribute('data-val'));
              ratingInput.value = val;
              updateStars(val);
              starError.classList.add('hidden');
          });
          
          svg.addEventListener('mouseenter', function() {
              const val = parseInt(this.getAttribute('data-val'));
              updateStars(val);
          });
      });

      document.getElementById('star-rating-container').addEventListener('mouseleave', function() {
          updateStars(parseInt(ratingInput.value));
      });

      // Review Submission
      document.getElementById('form-review').addEventListener('submit', async (e) => {
          e.preventDefault();

          if (!currentUser) return;
          if (!currentDestinationId) return;
          
          const rating = parseInt(ratingInput.value);
          if(rating === 0) {
              starError.classList.remove('hidden');
              return;
          }

          const btn = document.getElementById('btn-submit-review');
          btn.disabled = true;
          btn.textContent = "Mengirim...";

          const comment = document.getElementById('input-comment').value;       

          let userNameLog = currentUser?.user_metadata?.full_name || currentUser?.email?.split('@')[0] || 'Pengunjung';
          const { error } = await supabaseClient.from('reviews').insert([{
              destination_id: currentDestinationId,
              user_id: currentUser.id,
              user_name: userNameLog,
              rating: rating,
              comment: comment
          }]);

          btn.disabled = false;
          btn.textContent = "Kirim Ulasan";
          msgContainer.classList.remove('hidden');

          if (error) {
              msgContainer.textContent = "Gagal mengirim: " + error.message;
              msgContainer.className = "mt-4 p-3 rounded-lg text-center font-bold text-sm bg-red-100 text-red-700 block";
          } else {
              document.getElementById('input-comment').value = '';
              ratingInput.value = '0';
              updateStars(0);
              
              msgContainer.textContent = "Ulasan Berhasil Dikirim!";     
              msgContainer.className = "mt-4 p-3 rounded-lg text-center font-bold text-sm bg-green-100 text-green-700 block";

              // Refresh Review List
              fetchReviews(currentDestinationId);
              
              // auto close modal after 1.5s
              setTimeout(() => {
                  reviewModal.classList.add('hidden');
                  document.body.classList.remove('overflow-hidden');
                  msgContainer.classList.add('hidden');
              }, 1500);
          }
      });
initPage();
    </script>
</body>
</html>












