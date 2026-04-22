const fs = require('fs');

const html = `<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Admin Dashboard - INDETA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0eadd] text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    <!-- Header Admin -->
    <header class="bg-[#3e2723] shadow-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo" class="h-8 mr-2 filter brightness-0 invert opacity-90">
                    <span class="text-[#d6d6a8] font-extrabold text-xl tracking-wider">AdminPanel</span>
                </div>

                <!-- Navigation -->
                <div class="flex items-center space-x-6">
                    <a href="/index.html" class="text-[#f0eadd] hover:text-[#d6d6a8] font-medium text-sm transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Lihat Web
                    </a>
                    <button type="button" id="btn-logout" class="px-5 py-1.5 border-2 border-[#d6d6a8] text-[#d6d6a8] hover:bg-[#d6d6a8] hover:text-[#3e2723] rounded-full font-bold transition-colors text-sm">Logout</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Tab Controls -->
    <main class="flex-1 max-w-5xl mx-auto px-4 pt-10 pb-16 w-full">
        <!-- Header Text -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#3e2723]">Kelola Konten Sistem</h1>
            <p class="text-[#5d4037] mt-1">Tambahkan destinasi wisata baru atau artikel inspiratif terbaru.</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex items-end border-b-2 border-[#d6d6a8]/50">
            <button id="tab-destinasi" class="px-6 py-3 bg-[#d6d6a8] text-[#3e2723] rounded-t-xl font-bold shadow-sm transition-all text-sm md:text-base focus:outline-none">Kelola Destinasi</button>       
            <button id="tab-artikel" class="px-6 py-3 bg-transparent text-[#5d4037] hover:bg-[#e0d9c8] hover:text-[#3e2723] rounded-t-xl font-bold shadow-sm transition-all text-sm md:text-base ml-2 focus:outline-none">Kelola Artikel</button>
        </div>

        <!-- Panel Form Destinasi -->
        <div id="view-destinasi" class="bg-[#fdfbf7] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 block border border-[#d6d6a8]/30">
            <h2 class="text-2xl font-bold text-[#3e2723] mb-8 border-b-2 border-[#d6d6a8]/30 pb-4">Tambah Destinasi Baru</h2>

            <form id="form-add-destinasi" class="space-y-6">
                <!-- Group Info Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Nama Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" id="name" required class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Slug (URL friendly) <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" required placeholder="misal: danau-toba" class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-[#5d4037] mb-2">Deskripsi Singkat / Prolog <span class="text-red-500">*</span></label>
                    <textarea id="description" rows="4" required class="w-full px-4 py-3 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all leading-relaxed"></textarea>
                </div>

                <!-- Media -->
                <div>
                    <label class="block text-sm font-bold text-[#5d4037] mb-2">Upload Thumbnail Utama (opsional, maks 2MB)</label>
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#d6d6a8] border-dashed rounded-xl cursor-pointer bg-white hover:bg-[#f0eadd]/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-[#8c8c62]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-[#5d4037]"><span class="font-semibold">Klik untuk upload file gambar</span></p>
                            </div>
                            <input type="file" id="thumbnail" accept="image/*" class="hidden" />
                        </label>
                    </div>
                    <p id="thumbnail-name" class="mt-2 text-sm text-[#8c8c62] italic hidden"></p>
                </div>

                <!-- Optional Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-[#f0eadd]/30 p-5 rounded-xl border border-[#d6d6a8]/50">
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Harga / Paket Tour (opsional, max 255 char)</label>
                        <input type="text" id="tour_packages" placeholder="Mulai dari Rp. 500,000" class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Google Maps Embed URL (opsional)</label>
                        <input type="url" id="gmaps_url" placeholder="https://www.google.com/maps/embed?..." class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">ID Sosmed Instgram/Tiktok (opsional)</label>
                        <input type="text" id="social_media_url" placeholder="@indeta_trip" class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <div class="flex items-center pt-2">
                    <input id="is_favorite" type="checkbox" class="w-5 h-5 text-[#3e2723] bg-white border-[#d6d6a8] rounded focus:ring-[#3e2723] focus:ring-2">
                    <label for="is_favorite" class="ml-3 text-sm font-bold text-[#5d4037]">Tandai sebagai Destinasi Pilihan (Populer)</label>
                </div>

                <!-- Alerts -->
                <div id="alert-box" class="hidden p-4 rounded-xl text-sm font-medium"></div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" id="btn-submit" class="px-8 py-3 bg-[#3e2723] hover:bg-[#5d4037] text-[#f0eadd] rounded-full font-bold shadow-lg transition-all hover:-translate-y-1 w-full md:w-auto">Simpan Destinasi</button>
                </div>
            </form>
        </div>

        <!-- Panel Form Artikel -->
        <div id="view-artikel" class="bg-[#fdfbf7] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 hidden border border-[#d6d6a8]/30">
            <h2 class="text-2xl font-bold text-[#3e2723] mb-8 border-b-2 border-[#d6d6a8]/30 pb-4">Tulis Artikel Baru</h2>

            <form id="form-add-artikel" class="space-y-6">
                <!-- Title & Slug -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" id="art_title" required class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#5d4037] mb-2">Slug Artikel (URL friendly) <span class="text-red-500">*</span></label>
                        <input type="text" id="art_slug" required placeholder="misal: keindahan-pantai" class="w-full px-4 py-2.5 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-bold text-[#5d4037] mb-2">Prolog (Paragraf Singkat) <span class="text-red-500">*</span></label>
                    <textarea id="art_prolog" rows="2" required class="w-full px-4 py-3 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all leading-relaxed"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-[#5d4037] mb-2">Isi Artikel Lengkap <span class="text-red-500">*</span></label>
                    <textarea id="art_content" rows="12" required class="w-full px-4 py-3 bg-white border border-[#d6d6a8] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#3e2723]/30 focus:border-[#3e2723] shadow-sm outline-none transition-all leading-relaxed" placeholder="Tuliskan cerita menarik di sini..."></textarea>
                </div>

                <!-- Media -->
                <div>
                    <label class="block text-sm font-bold text-[#5d4037] mb-2">Upload Sampul Artikel (opsional, maks 2MB)</label>
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#d6d6a8] border-dashed rounded-xl cursor-pointer bg-white hover:bg-[#f0eadd]/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-[#8c8c62]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-[#5d4037]"><span class="font-semibold">Klik untuk upload file gambar</span></p>
                            </div>
                            <input type="file" id="art_thumbnail" accept="image/*" class="hidden" />
                        </label>
                    </div>
                    <p id="art-thumbnail-name" class="mt-2 text-sm text-[#8c8c62] italic hidden"></p>
                </div>

                <!-- Alerts -->
                <div id="art-alert-box" class="hidden p-4 rounded-xl text-sm font-medium"></div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" id="art-btn-submit" class="px-8 py-3 bg-[#3e2723] hover:bg-[#5d4037] text-[#f0eadd] rounded-full font-bold shadow-lg transition-all hover:-translate-y-1 w-full md:w-auto">Simpan Artikel</button>
                </div>
            </form>
        </div>
    </main>

    `;

const scriptContent = fs.readFileSync('temp_script.txt', 'utf8');
const finalCode = html + scriptContent.replace(
    /tabDest.classList.replace\('bg-gray-200', 'bg-blue-600'\);[\s\S]*?tabArt.classList.add\('hover:bg-gray-300'\);/g,
    `// Setup style tab Destinasi aktif
                tabDest.classList.replace('bg-transparent', 'bg-[#d6d6a8]');
                tabDest.classList.replace('text-[#5d4037]', 'text-[#3e2723]');
                tabDest.classList.remove('hover:bg-[#e0d9c8]', 'hover:text-[#3e2723]');
                // Reset style tab Artikel pasif
                tabArt.classList.replace('bg-[#d6d6a8]', 'bg-transparent');
                tabArt.classList.replace('text-[#3e2723]', 'text-[#5d4037]');
                tabArt.classList.add('hover:bg-[#e0d9c8]', 'hover:text-[#3e2723]');`
).replace(
    /tabArt.classList.replace\('bg-gray-200', 'bg-blue-600'\);[\s\S]*?tabDest.classList.add\('hover:bg-gray-300'\);/g,
    `// Setup style tab Artikel aktif
                tabArt.classList.replace('bg-transparent', 'bg-[#d6d6a8]');
                tabArt.classList.replace('text-[#5d4037]', 'text-[#3e2723]');
                tabArt.classList.remove('hover:bg-[#e0d9c8]', 'hover:text-[#3e2723]');
                // Reset style tab Destinasi pasif
                tabDest.classList.replace('bg-[#d6d6a8]', 'bg-transparent');
                tabDest.classList.replace('text-[#3e2723]', 'text-[#5d4037]');
                tabDest.classList.add('hover:bg-[#e0d9c8]', 'hover:text-[#3e2723]');`
).replace(
    /btnSubmit.textContent = 'Menyimpan...';\n          btnSubmit.classList.replace\('bg-blue-600', 'bg-blue-400'\);/g,
    `btnSubmit.textContent = 'Menyimpan...';\n          btnSubmit.classList.replace('bg-[#3e2723]', 'bg-[#5d4037]');`
).replace(
    /btnSubmit.textContent = 'Simpan Destinasi';\n              btnSubmit.classList.replace\('bg-blue-400', 'bg-blue-600'\);/g,
    `btnSubmit.textContent = 'Simpan Destinasi';\n              btnSubmit.classList.replace('bg-[#5d4037]', 'bg-[#3e2723]');`
).replace(
    /artBtnSubmit.textContent = 'Menyimpan...';\n          artBtnSubmit.classList.replace\('bg-blue-600', 'bg-blue-400'\);/g,
    `artBtnSubmit.textContent = 'Menyimpan...';\n          artBtnSubmit.classList.replace('bg-[#3e2723]', 'bg-[#5d4037]');`
).replace(
    /artBtnSubmit.textContent = 'Simpan Artikel';\n              artBtnSubmit.classList.replace\('bg-blue-400', 'bg-blue-600'\);/g,
    `artBtnSubmit.textContent = 'Simpan Artikel';\n              artBtnSubmit.classList.replace('bg-[#5d4037]', 'bg-[#3e2723]');`
);

fs.writeFileSync('resources/views/admin/dashboard.blade.php', finalCode);
console.log('UI Admin done');
