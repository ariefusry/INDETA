@extends('user.layouts.app')

@section('title', 'Destinasi Detail - INDETA')

@section('content')

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
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-[#819E4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Jadwal Operasional
                                        </h4>
                                        <div id="schedule-text" class="whitespace-pre-line text-gray-600" style="white-space: pre-line;">
                                            <p class="italic text-gray-500">Informasi jadwal belum tersedia.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-[#819E4A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            Fasilitas
                                        </h4>
                                        <div id="facilities-text" class="whitespace-pre-line text-gray-600" style="white-space: pre-line;">
                                            <p class="italic text-gray-500">Informasi fasilitas belum tersedia.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link Sosial Media & Maps -->
                        <div class="accordion-item" id="maps-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-maps', this)">
                                <span>&#8226; Link Sosial Media & Maps</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-maps" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base space-y-2">
                                <div id="maps-container"><p class="text-gray-500 italic">Belum ada link sosial media atau lokasi.</p></div>
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
                                        <h4 id="review-cta-title" class="font-bold text-gray-800 text-base">Punya Pengalaman Menarik?</h4>
                                        <p id="review-cta-subtitle" class="text-xs text-gray-600 mt-1">Beritahu pengunjung lain tentang pengalaman serumu di sini!</p>
                                    </div>
                                    <button type="button" id="btn-open-review" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-sm flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        <span id="btn-open-review-text">Tulis Ulasan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Prize & Paket Wisata -->
                        <div class="accordion-item" id="tour-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-tour', this)">
                                <span>&#8226; Prize & Paket Wisata</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-tour" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <div id="tour-container" class="flex flex-wrap justify-center gap-4 md:gap-6">
                                    <p class="col-span-full text-center text-gray-500 italic">Belum ada paket wisata.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Produk UMKM Lokal -->
                        <div class="accordion-item" id="umkm-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-umkm', this)">
                                <span>&#8226; Produk UMKM Lokal</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-umkm" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <div id="umkm-container" class="flex flex-wrap justify-center gap-4 md:gap-6">
                                    <p class="col-span-full text-center text-gray-500 italic">Belum ada produk UMKM.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kontak Reservasi -->
                        <div class="accordion-item" id="contact-header">
                            <button class="accordion-header w-full flex justify-between items-center bg-[#819E4A] hover:bg-[#6c853d] text-white px-6 py-3 rounded-full font-bold transition-colors shadow-sm outline-none cursor-pointer" onclick="toggleAccordion('content-contact', this)">
                                <span>&#8226; Detail Kontak Reservasi</span>
                                <span class="text-xl leading-none font-bold toggle-icon">+</span>
                            </button>
                            <div id="content-contact" class="accordion-content hidden px-6 py-4 text-gray-700 text-sm md:text-base">
                                <p id="contact-text" class="leading-relaxed text-gray-500 italic">Informasi kontak belum tersedia.</p>
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
                    <input type="hidden" id="existing-review-id" value="">
                    <!-- Info banner for editing -->
                    <div id="review-edit-banner" class="hidden bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg text-sm">
                        <span class="font-bold">📝 Kamu sudah pernah memberikan ulasan.</span> Perbarui rating dan komentar kamu di bawah ini.
                    </div>
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
            <p id="detail-modal-price" class="text-lg font-semibold text-emerald-600 mb-3"></p>
            <div id="detail-modal-pricelist" class="hidden mb-4">
                <h4 class="text-sm font-bold text-gray-600 mb-2">Daftar Harga:</h4>
                <ul id="detail-modal-pricelist-items" class="space-y-1 text-sm"></ul>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p id="detail-modal-desc" class="text-gray-700 text-sm whitespace-pre-wrap leading-relaxed"></p>
            </div>
        </div>
    </div>
</div>

<!-- User Toast Notification -->
<div id="user-toast" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm transition-all duration-300">
    <div id="user-toast-box" class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all scale-95 opacity-0 duration-300 border border-gray-100 text-center">
        <div id="user-toast-icon-container" class="flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5">
            <svg id="user-toast-icon-success" class="w-10 h-10 text-green-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
            <svg id="user-toast-icon-error" class="w-10 h-10 text-red-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <h3 id="user-toast-title" class="text-xl font-bold text-gray-900 mb-2">Berhasil!</h3>
        <p id="user-toast-message" class="text-gray-500 text-sm leading-relaxed"></p>
    </div>
</div>
<script>
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
@endsection

@section('scripts')
<script>
    const supabaseClient = window.supabaseClient;
    // Read currentUser dynamically since checkSession() is async and may not have finished yet
    function getCurrentUser() { return window.currentUser; }
    const CURRENT_SLUG = "{{ $slug }}";
    let currentDestinationId = null;
    let existingReviewId = null; // Track if user already reviewed this destination

    async function loadPage() {
        if (!supabaseClient) return;

        // 1. Welcome Text
        if (getCurrentUser()) {
            const meta = getCurrentUser().user_metadata || {};
            const name = meta.full_name || getCurrentUser().email.split('@')[0];
            const welcomeText = document.getElementById('welcome-text');
            const userAvatar = document.getElementById('user-avatar');
            if (welcomeText) welcomeText.textContent = 'Welcome "' + name.split(' ')[0] + '"';
            if (userAvatar) userAvatar.src = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&background=random';
        }

        // 2. Fetch Destination
        const { data: dests, error } = await supabaseClient
            .from('destinations')
            .select('*')
            .eq('slug', CURRENT_SLUG)
            .limit(1);

        if (error || !dests || dests.length === 0) {
            document.getElementById('page-title').textContent = "Destinasi Tidak Ditemukan";
            return;
        }

        const dest = dests[0];
        currentDestinationId = dest.id;
        document.getElementById('dest-id').value = dest.id;

        // Update UI
        document.getElementById('page-title').textContent = dest.name;
        document.getElementById('breadcrumb-text').textContent = `Destinasi / ${dest.name}`;
        document.getElementById('desc-text').textContent = dest.description || "Tidak ada deskripsi.";

        // Schedule & Facilities
        if (dest.schedule) {
            document.getElementById('schedule-text').textContent = dest.schedule;
        }
        if (dest.facilities) {
            document.getElementById('facilities-text').textContent = dest.facilities;
        }

        // Map & Social
        const mapsContainer = document.getElementById('maps-container');
        let linksHtml = '';
        if (dest.gmaps_url) {
            linksHtml += `<div class="flex items-start mt-2"><svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-[2px] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg><a href="${dest.gmaps_url}" target="_blank" class="text-blue-600 font-bold hover:underline text-sm md:text-base">Google Maps</a></div>`;
        }
        if (dest.social_media?.url) {
            linksHtml += `<div class="flex items-start mt-2"><svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-[2px] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg><a href="${dest.social_media.url}" target="_blank" class="text-blue-600 font-bold hover:underline text-sm md:text-base">Sosial Media</a></div>`;
        }
        if (linksHtml) {
            document.getElementById('maps-header').classList.remove('hidden');
            mapsContainer.innerHTML = linksHtml;
        }

        // Contact
        if (dest.contact_details) {
            const contactP = document.getElementById('contact-text');
            contactP.textContent = dest.contact_details;
            contactP.classList.remove('text-gray-500', 'italic');
        }

        // Image
        let imageUrl = dest.thumbnail;
        if (imageUrl && !imageUrl.startsWith('http')) {
            imageUrl = `${window.SUPABASE_URL}/storage/v1/object/public/destinations/${imageUrl}`;
        }
        const imgEl = document.getElementById('dest-image');
        imgEl.src = imageUrl || 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=800';
        imgEl.onload = () => {
            imgEl.classList.remove('hidden');
            document.getElementById('img-loading').classList.add('hidden');
        };

        fetchPackages(dest.id);
        fetchUMKM(dest.id);
        fetchReviews(dest.id);
    }

    async function fetchPackages(destId) {
        const { data } = await supabaseClient.from('tour_packages').select('*').eq('destination_id', destId);
        const container = document.getElementById('tour-container');
        if (data?.length) {
            container.innerHTML = data.map(pkg => {
                let img = pkg.image_url;
                if (img && !img.startsWith('http')) img = `${window.SUPABASE_URL}/storage/v1/object/public/tour_packages/${img}`;
                
                // Build price label
                let priceLabel = '';
                if (pkg.price_min && pkg.price_max) {
                    priceLabel = 'Rp ' + Number(pkg.price_min).toLocaleString('id-ID') + ' - Rp ' + Number(pkg.price_max).toLocaleString('id-ID');
                } else if (pkg.price_list && Array.isArray(pkg.price_list) && pkg.price_list.length > 0) {
                    const minP = Math.min(...pkg.price_list.map(p => Number(p.price)).filter(p => !isNaN(p)));
                    priceLabel = 'Mulai Rp ' + minP.toLocaleString('id-ID');
                } else if (pkg.price) {
                    priceLabel = 'Rp ' + Number(pkg.price).toLocaleString('id-ID');
                }
                
                const serialized = encodeURIComponent(JSON.stringify({...pkg, resolvedImage: img}));
                return `<div class="w-[calc(50%-0.5rem)] sm:w-48 md:w-52 lg:w-56 cursor-pointer hover:shadow-lg transition-transform transform hover:-translate-y-1 bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col" onclick="showItemDetail('${serialized}')">
                    <div class="w-full aspect-[4/3] relative"><img src="${img || ''}" class="absolute inset-0 w-full h-full object-cover"></div>
                    <div class="p-3 text-center bg-gray-50 flex-1 flex flex-col items-center justify-center">
                        <span class="font-bold text-sm text-gray-800 line-clamp-2">${pkg.title || 'Paket'}</span>
                        ${priceLabel ? `<span class="text-xs text-emerald-600 font-semibold mt-1">${priceLabel}</span>` : ''}
                    </div>
                </div>`;
            }).join('');
        }
    }

    async function fetchUMKM(destId) {
        // UMKM are linked via umkm_destinations junction table
        const { data: links } = await supabaseClient.from('umkm_destinations').select('umkm_id').eq('destination_id', destId);
        if (!links || links.length === 0) return;
        
        const umkmIds = links.map(l => l.umkm_id);
        const { data } = await supabaseClient.from('umkm_products').select('*').in('id', umkmIds);
        const container = document.getElementById('umkm-container');
        if (data?.length) {
            container.innerHTML = data.map(prod => {
                let img = prod.image_url;
                if (img && !img.startsWith('http')) img = `${window.SUPABASE_URL}/storage/v1/object/public/umkm_products/${img}`;
                
                // Build price label
                let priceLabel = '';
                if (prod.price_min && prod.price_max) {
                    priceLabel = 'Rp ' + Number(prod.price_min).toLocaleString('id-ID') + ' - Rp ' + Number(prod.price_max).toLocaleString('id-ID');
                } else if (prod.price_list && Array.isArray(prod.price_list) && prod.price_list.length > 0) {
                    const minP = Math.min(...prod.price_list.map(p => Number(p.price)).filter(p => !isNaN(p)));
                    priceLabel = 'Mulai Rp ' + minP.toLocaleString('id-ID');
                }
                
                const serialized = encodeURIComponent(JSON.stringify({...prod, title: prod.name, resolvedImage: img}));
                return `<div class="w-[calc(50%-0.5rem)] sm:w-48 md:w-52 lg:w-56 cursor-pointer hover:shadow-lg transition-transform transform hover:-translate-y-1 bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col" onclick="showItemDetail('${serialized}')">
                    <div class="w-full aspect-[4/3] relative"><img src="${img || ''}" class="absolute inset-0 w-full h-full object-cover"></div>
                    <div class="p-3 text-center bg-gray-50 flex-1 flex flex-col items-center justify-center">
                        <span class="font-bold text-sm text-gray-800 line-clamp-2">${prod.name || 'Produk'}</span>
                        ${priceLabel ? `<span class="text-xs text-emerald-600 font-semibold mt-1">${priceLabel}</span>` : ''}
                    </div>
                </div>`;
            }).join('');
        }
    }

    async function fetchReviews(destId) {
        const { data: reviews } = await supabaseClient.from('reviews').select('*').eq('destination_id', destId).order('created_at', { ascending: false });
        if (!reviews?.length) return;

        const total = reviews.reduce((sum, r) => sum + r.rating, 0);
        const avg = (total / reviews.length).toFixed(1);
        document.getElementById('avg-rating').textContent = avg;
        document.getElementById('rating-count').textContent = `(${reviews.length} ulasan pengunjung)`;
        
        const starSvg = (active) => `<svg class="w-4 h-4 ${active ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>`;
        
        let starsHtml = '';
        for(let i=0; i<5; i++) starsHtml += starSvg(i < Math.round(avg));
        document.getElementById('avg-stars').innerHTML = starsHtml;

        const genReview = (r) => `
            <li class="bg-white/90 border border-gray-100 p-4 rounded-xl shadow-sm mb-3 list-none">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">${(r.user_name || 'A').charAt(0).toUpperCase()}</div>
                        <span class="font-bold text-sm text-gray-800">${r.user_name || 'Anonim'}</span>
                    </div>
                    <div class="flex">${[...Array(5)].map((_, i) => starSvg(i < r.rating)).join('')}</div>
                </div>
                <p class="text-gray-700 text-sm">${r.comment || ''}</p>
            </li>`;
        
        document.getElementById('reviews-list').innerHTML = reviews.slice(0, 2).map(genReview).join('');
        document.getElementById('all-reviews-list').innerHTML = reviews.map(genReview).join('');
        if (reviews.length > 2) document.getElementById('btn-show-all-reviews').classList.remove('hidden');

        // Update CTA if user already has a review
        const user = getCurrentUser();
        if (user) {
            const userReview = reviews.find(r => r.user_id === user.id);
            const ctaTitle = document.getElementById('review-cta-title');
            const ctaSubtitle = document.getElementById('review-cta-subtitle');
            const ctaBtnText = document.getElementById('btn-open-review-text');
            if (userReview) {
                if (ctaTitle) ctaTitle.textContent = 'Kamu Sudah Memberi Ulasan';
                if (ctaSubtitle) ctaSubtitle.textContent = 'Ingin memperbarui rating atau komentar? Klik tombol di samping.';
                if (ctaBtnText) ctaBtnText.textContent = 'Edit Ulasan';
            } else {
                if (ctaTitle) ctaTitle.textContent = 'Punya Pengalaman Menarik?';
                if (ctaSubtitle) ctaSubtitle.textContent = 'Beritahu pengunjung lain tentang pengalaman serumu di sini!';
                if (ctaBtnText) ctaBtnText.textContent = 'Tulis Ulasan';
            }
        }
    }

    // Modal Events
    window.showItemDetail = function(data) {
        const item = JSON.parse(decodeURIComponent(data));
        document.getElementById('detail-modal-image').src = item.resolvedImage || '';
        document.getElementById('detail-modal-title').textContent = item.title || item.name;
        document.getElementById('detail-modal-desc').textContent = item.description || '';
        
        // Price list rendering
        const priceListContainer = document.getElementById('detail-modal-pricelist');
        const priceListItems = document.getElementById('detail-modal-pricelist-items');
        const priceEl = document.getElementById('detail-modal-price');
        
        if (item.price_list && Array.isArray(item.price_list) && item.price_list.length > 0) {
            priceListItems.innerHTML = item.price_list.map(p => {
                const formatted = !isNaN(p.price) ? 'Rp ' + Number(p.price).toLocaleString('id-ID') : p.price;
                return `<li class="flex justify-between items-center bg-white px-3 py-2 rounded-lg border border-gray-100">
                    <span class="text-gray-800 font-medium">${p.name || '-'}</span>
                    <span class="text-emerald-600 font-bold">${formatted}</span>
                </li>`;
            }).join('');
            priceListContainer.classList.remove('hidden');
            
            // Show range if available
            if (item.price_min && item.price_max) {
                priceEl.textContent = 'Rp ' + Number(item.price_min).toLocaleString('id-ID') + ' — Rp ' + Number(item.price_max).toLocaleString('id-ID');
            } else {
                const prices = item.price_list.map(p => Number(p.price)).filter(p => !isNaN(p));
                if (prices.length > 0) {
                    const min = Math.min(...prices);
                    priceEl.textContent = 'Mulai Rp ' + min.toLocaleString('id-ID');
                } else {
                    priceEl.textContent = '';
                }
            }
        } else {
            priceListContainer.classList.add('hidden');
            if (item.price) {
                priceEl.textContent = 'Rp ' + Number(item.price).toLocaleString('id-ID');
            } else {
                priceEl.textContent = '';
            }
        }
        
        document.getElementById('item-detail-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    document.getElementById('close-item-detail-modal')?.addEventListener('click', () => {
        document.getElementById('item-detail-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    document.getElementById('btn-open-review')?.addEventListener('click', async () => {
        if (!getCurrentUser()) return document.getElementById('login-required-modal').classList.remove('hidden');
        
        // Check if user already has a review for this destination
        const btn = document.getElementById('btn-submit-review');
        const modalTitle = document.querySelector('#review-modal h3');
        const editBanner = document.getElementById('review-edit-banner');
        
        try {
            const { data: existingReview } = await supabaseClient
                .from('reviews')
                .select('*')
                .eq('destination_id', currentDestinationId)
                .eq('user_id', getCurrentUser().id)
                .maybeSingle();
            
            if (existingReview) {
                // Pre-fill form with existing review
                existingReviewId = existingReview.id;
                document.getElementById('existing-review-id').value = existingReview.id;
                document.getElementById('input-rating').value = existingReview.rating;
                document.getElementById('input-comment').value = existingReview.comment || '';
                
                // Update stars visual
                const stars = document.querySelectorAll('.star-svg');
                stars.forEach(st => {
                    st.classList.toggle('text-yellow-400', st.getAttribute('data-val') <= existingReview.rating);
                    st.classList.toggle('text-gray-300', st.getAttribute('data-val') > existingReview.rating);
                });
                
                // Update UI texts
                btn.textContent = 'Perbarui Ulasan';
                if (modalTitle) modalTitle.textContent = 'Perbarui Ulasanmu';
                if (editBanner) editBanner.classList.remove('hidden');
            } else {
                // Fresh review
                existingReviewId = null;
                document.getElementById('existing-review-id').value = '';
                document.getElementById('form-review').reset();
                document.getElementById('input-rating').value = 0;
                document.querySelectorAll('.star-svg').forEach(st => {
                    st.classList.remove('text-yellow-400');
                    st.classList.add('text-gray-300');
                });
                btn.textContent = 'Kirim Ulasan';
                if (modalTitle) modalTitle.textContent = 'Bagaimana Pengalamanmu?';
                if (editBanner) editBanner.classList.add('hidden');
            }
        } catch (err) {
            console.error('Error checking existing review:', err);
            existingReviewId = null;
        }
        
        document.getElementById('review-modal').classList.remove('hidden');
    });

    // Login-required modal close buttons
    const closeLoginModal = () => document.getElementById('login-required-modal').classList.add('hidden');
    document.getElementById('btn-close-login-required')?.addEventListener('click', closeLoginModal);
    document.getElementById('btn-cancel-login-required')?.addEventListener('click', closeLoginModal);

    document.getElementById('btn-close-review')?.addEventListener('click', () => {
        document.getElementById('review-modal').classList.add('hidden');
    });

    // Star Logic
    const stars = document.querySelectorAll('.star-svg');
    stars.forEach(s => {
        s.addEventListener('click', () => {
            const val = s.getAttribute('data-val');
            document.getElementById('input-rating').value = val;
            stars.forEach(st => st.classList.toggle('text-yellow-400', st.getAttribute('data-val') <= val));
            stars.forEach(st => st.classList.toggle('text-gray-300', st.getAttribute('data-val') > val));
            document.getElementById('star-error').classList.add('hidden');
        });
    });

    document.getElementById('form-review')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const rating = document.getElementById('input-rating').value;
        if (rating == 0) return document.getElementById('star-error').classList.remove('hidden');
        
        const btn = document.getElementById('btn-submit-review');
        const isUpdate = !!existingReviewId;
        btn.disabled = true;
        btn.textContent = isUpdate ? 'Memperbarui...' : 'Mengirim...';
        
        let error;
        const reviewData = {
            destination_id: currentDestinationId,
            user_id: getCurrentUser().id,
            user_name: getCurrentUser().user_metadata?.full_name || getCurrentUser().email.split('@')[0],
            rating: parseInt(rating),
            comment: document.getElementById('input-comment').value
        };

        if (isUpdate) {
            // Update existing review
            const result = await supabaseClient.from('reviews')
                .update({ rating: reviewData.rating, comment: reviewData.comment, user_name: reviewData.user_name })
                .eq('id', existingReviewId);
            error = result.error;
        } else {
            // Insert new review
            const result = await supabaseClient.from('reviews').insert([reviewData]);
            error = result.error;
        }

        btn.disabled = false;
        btn.textContent = isUpdate ? 'Perbarui Ulasan' : 'Kirim Ulasan';

        if (error) {
            showUserToast('Gagal mengirim ulasan: ' + error.message, true);
        } else {
            // Close review modal
            document.getElementById('review-modal').classList.add('hidden');
            // Reset state
            existingReviewId = null;
            document.getElementById('existing-review-id').value = '';
            document.getElementById('form-review').reset();
            document.getElementById('input-rating').value = 0;
            document.querySelectorAll('.star-svg').forEach(st => {
                st.classList.remove('text-yellow-400');
                st.classList.add('text-gray-300');
            });
            // Show success toast
            showUserToast(isUpdate ? 'Ulasan kamu berhasil diperbarui! ✏️' : 'Terima kasih! Ulasan kamu berhasil dikirim 🎉');
            // Reload reviews without full page reload
            fetchReviews(currentDestinationId);
        }
    });

    // Toast notification for user page
    function showUserToast(message, isError = false, duration = 2500) {
        const toast = document.getElementById('user-toast');
        const box = document.getElementById('user-toast-box');
        const iconContainer = document.getElementById('user-toast-icon-container');
        const successIcon = document.getElementById('user-toast-icon-success');
        const errorIcon = document.getElementById('user-toast-icon-error');
        const title = document.getElementById('user-toast-title');
        const msg = document.getElementById('user-toast-message');

        if (isError) {
            iconContainer.className = 'flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5 bg-red-50';
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
            title.textContent = 'Gagal!';
            title.className = 'text-xl font-bold text-red-700 mb-2';
        } else {
            iconContainer.className = 'flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5 bg-green-50';
            errorIcon.classList.add('hidden');
            successIcon.classList.remove('hidden');
            title.textContent = 'Berhasil!';
            title.className = 'text-xl font-bold text-green-700 mb-2';
        }
        msg.textContent = message;

        toast.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
        }, 10);

        setTimeout(() => {
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 300);
        }, duration);
    }

    window.toggleAccordion = function(contentId, btn) {
        const content = document.getElementById(contentId);
        const icon = btn.querySelector('.toggle-icon');
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '-';
        } else {
            content.classList.add('hidden');
            icon.textContent = '+';
        }
    };

    document.addEventListener('DOMContentLoaded', loadPage);
</script>
@endsection
