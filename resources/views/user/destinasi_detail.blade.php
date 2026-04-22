<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Detail - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-400 text-gray-800 font-sans antialiased overflow-x-hidden min-h-screen flex flex-col">
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
                    <a href="/index.html" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Beranda</a>
                    <a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Destinasi</a>
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

    <!-- Main Section (Gray BG matches mockup) bg-[#888A89] -->
    <main class="flex-1 bg-[#888c89] text-white">
        <!-- Sub-header (Breadcrumb, Title, Search) -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Breadcrumb -->
                <div class="flex-1 flex justify-start items-center space-x-3 mb-4 md:mb-0">
                    <a href="/destinasi" class="text-white hover:text-gray-200 flex items-center font-bold text-sm bg-black/20 px-3 py-1.5 rounded-lg mr-2 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <span id="breadcrumb-text" class="text-sm md:text-base font-semibold tracking-wide">Destinasi / ...</span>
                </div>
                
                                <!-- Center Title -->
                <div class="flex-2 flex justify-center w-full md:w-auto text-center">       
                    <h1 id="page-title" class="text-2xl md:text-4xl font-bold tracking-wider">Memuat...</h1>
                </div>
                
                <!-- Right Spacer -->
                <div class="hidden md:block flex-1"></div>

                
        </div>

        <!-- Content Box -->
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-[#e4e5e4] text-gray-800 rounded-sm shadow-xl flex flex-col md:flex-row min-h-[600px] overflow-hidden items-stretch">
                <!-- Image Left Side -->
                <div class="w-full md:w-5/12 bg-gray-200">
                    <img id="dest-image" src="" alt="Cover" class="w-full h-full object-cover object-center hidden">
                    <div id="img-loading" class="w-full h-full min-h-[400px] flex items-center justify-center text-gray-500">
                        Memuat gambar...
                    </div>
                </div>

                <!-- Content Right Side -->
                <div class="w-full md:w-7/12 p-6 md:p-10 flex flex-col justify-between">
                    <div>
                        <ul class="space-y-6 text-sm md:text-base font-medium leading-relaxed" id="details-container">
                            <li class="flex flex-col">
                                <span class="font-bold flex items-center mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800 mr-2"></span> Rating
                                </span>
                                <div class="pl-4 space-y-1" id="rating-container">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-bold text-lg" id="avg-rating">0.0</span>
                                        <div id="avg-stars" class="flex space-x-0.5"></div>
                                        <span class="text-gray-500 text-sm" id="rating-count">(0 ulasan pengunjung)</span>
                                    </div>
                                </div>
                            </li>

                            <li class="flex flex-col">
                                <span class="font-bold flex items-center mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800 mr-2"></span> Testimoni (Ulasan Pengunjung)
                                </span>
                                <div class="pl-4 space-y-3" id="reviews-list">
                                    <p class="text-gray-500 italic">Belum ada ulasan.</p>
                                </div>
                                <button type="button" id="btn-show-all-reviews" class="ml-4 mt-3 text-emerald-600 font-semibold hover:text-emerald-700 text-sm hidden">
                                    Lihat Semua Ulasan &rarr;
                                </button>
                            </li>
                            
                            <li class="flex flex-col" id="desc-container">
                                <span class="font-bold flex items-center mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800 mr-2"></span> Deskripsi Singkat
                                </span>
                                <div class="pl-4 space-y-1">
                                    <p id="desc-text" class="whitespace-pre-line">&#8226; Memuat...</p>
                                </div>
                            </li>

                            <li class="flex flex-col mt-4">
                                <span class="font-bold flex items-center mb-1 hidden" id="tour-header">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800 mr-2"></span> Informasi / Tour Package
                                </span>
                                <div class="pl-4" id="tour-container">
                                    <!-- Tour Packages -->
                                </div>
                            </li>

                            <li class="flex flex-col mt-4">
                                <span class="font-bold flex items-center mb-1 hidden" id="maps-header">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800 mr-2"></span> Untuk navigasi & sosial media
                                </span>
                                <div class="pl-4 space-y-2" id="maps-container">
                                    <!-- Google Maps & Social Media Link -->
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Add Review Section Button -->
                    <div class="mt-12 pt-6 border-t border-gray-300 flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Punya Pengalaman Menarik?</h4>
                            <p class="text-sm text-gray-600 mt-1">Beritahu pengunjung lain tentang pengalaman serumu di sini!</p>
                        </div>
                        <button type="button" id="btn-open-review" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-md flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span>Tulis Ulasan</span>
                        </button>
                    </div>                </div>
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

    <!-- Logout Confirm Modal -->
<div id="logout-confirm-modal" class="fixed inset-0 z-[110] flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden text-center relative p-6">
        <div class="mb-4 text-red-500 flex justify-center">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin keluar dari akun ini?</p>
        <div class="flex flex-col space-y-3">
            <button type="button" id="btn-confirm-logout" class="w-full py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors shadow-md">Ya, Keluar</button>
            <button type="button" id="btn-cancel-logout" class="w-full py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition-colors">Batal</button>
        </div>
    </div>
</div>

    <!-- Passing PHP slug to JS -->
    <script>
      const CURRENT_SLUG = "{{ $slug }}";
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
      const SUPABASE_URL = @json(env('SUPABASE_URL', ''));
      const SUPABASE_ANON_KEY = @json(env('SUPABASE_ANON_KEY', ''));

      let supabaseClient = null;
      let currentDestinationId = null;
      let currentUser = null;

      if (window.supabase) {
        supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
      }

      const logoutButton = document.getElementById('btn-logout');
      const loginButton = document.getElementById('btn-login');

      async function initPage() {
        if (!supabaseClient) return;

        // 1. Check Auth (for review logic)
        const { data: authData } = await supabaseClient.auth.getSession();
        if (authData && authData.session) {
          currentUser = authData.session.user;
          logoutButton.classList.remove('hidden');
          loginButton.classList.add('hidden');
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

        // Tour Packages Logic
        if (dest.tour_packages) {
            document.getElementById('tour-header').classList.remove('hidden');
            let tourHtml = '';
            const lines = dest.tour_packages.split('\n');
            for (let line of lines) {
                if (line.trim() !== '') {
                    tourHtml += '<div class="flex items-start mt-2"><svg class="w-3.5 h-3.5 text-gray-800 flex-shrink-0 mt-[4px] mr-3 shadow-sm" fill="currentColor" viewBox="0 0 24 24"><polygon points="12,0 24,12 12,24 0,12"></polygon></svg><p class="text-sm md:text-base text-gray-800 leading-relaxed">' + line.replace(/</g, "&lt;").replace(/>/g, "&gt;") + '</p></div>';
                }
            }
            document.getElementById('tour-container').innerHTML = tourHtml;
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
            // Logout Modal Logic
      const logoutModal = document.getElementById('logout-confirm-modal');
      const btnConfirmLogout = document.getElementById('btn-confirm-logout');
      const btnCancelLogout = document.getElementById('btn-cancel-logout');

      if (logoutButton) {
          logoutButton.addEventListener('click', () => {
              if (logoutModal) {
                  logoutModal.classList.remove('hidden');
                  document.body.classList.add('overflow-hidden');
              }
          });
      }

      if (btnCancelLogout) {
          btnCancelLogout.addEventListener('click', () => {
              logoutModal.classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          });
      }

      if (btnConfirmLogout) {
          btnConfirmLogout.addEventListener('click', async () => {
              if (!supabaseClient) return;
              btnConfirmLogout.textContent = 'Memproses...';
              btnConfirmLogout.disabled = true;
              await supabaseClient.auth.signOut();
              window.location.reload();
          });
      }

      initPage();
    </script>
</body>
</html>











