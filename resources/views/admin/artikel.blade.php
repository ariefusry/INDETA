@extends('admin.layouts.app')
@section('content')
<div id="view-artikel" class="block">
            <div id="form-container" class="hidden bg-[white] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 border border-[gray-200]/30">
<input type="hidden" id="art_id">
            
            <div class="mb-4">
                <button type="button" id="art-btn-cancel" class="flex items-center text-[#6c853d] hover:text-[#819E4A] font-bold transition-all hover:-translate-x-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>
            <h2 id="art-form-title" class="text-2xl font-bold text-[#819E4A] mb-8 border-b-2 border-[gray-200]/30 pb-4">Tulis Artikel Baru</h2>

            <form id="form-add-artikel" class="space-y-6">
                <!-- Title & Slug -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" id="art_title" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Slug Artikel (URL friendly) <span class="text-red-500">*</span></label>
                        <input type="text" id="art_slug" required placeholder="misal: keindahan-pantai" class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Prolog (Paragraf Singkat) <span class="text-red-500">*</span></label>
                    <textarea id="art_prolog" rows="2" required class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Isi Artikel Lengkap <span class="text-red-500">*</span></label>
                    <textarea id="art_content" rows="12" required class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed" placeholder="Tuliskan cerita menarik di sini..."></textarea>
                </div>

                <!-- Media -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Upload Sampul Artikel (opsional, maks 2MB)</label>
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[gray-200] border-dashed rounded-xl cursor-pointer bg-white hover:bg-[gray-100]/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-[#8c8c62]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-[#6c853d]"><span class="font-semibold">Klik untuk upload file gambar</span></p>
                            </div>
                            <input type="file" id="art_thumbnail" accept="image/*" class="hidden" />
                        </label>
                    </div>
                    <p id="art-thumbnail-name" class="mt-2 text-sm text-[#8c8c62] italic hidden"></p>
                    
                    <!-- Preview Image -->
                    <div id="art_image_preview_container" class="mt-4 hidden p-2 bg-white border border-[gray-200] rounded-xl inline-block">
                        <p class="text-xs font-bold text-[#6c853d] mb-2">Gambar Saat Ini:</p>
                        <img id="art_image_preview" src="" alt="Preview" class="h-32 rounded-lg shadow-sm">
                    </div>
                </div>

                <!-- Alerts -->
                <div id="art-alert-box" class="hidden p-4 rounded-xl text-sm font-medium"></div>

                
                <!-- Submit Button -->
                <div class="flex justify-end pt-4 space-x-2">
                    <button type="submit" id="art-btn-submit" class="px-8 py-3 bg-[#819E4A] hover:bg-[#6c853d] text-[gray-100] rounded-full font-bold shadow-lg transition-all hover:-translate-y-1 w-full md:w-auto">Simpan Artikel</button>
                </div>
            </form>
</div>

        <div id="table-container">
        <div class="mt-12 bg-white rounded-2xl shadow-xl p-6 border border-[gray-200]/30">
            <div class="flex justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
            <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Artikel</h2>
            <button type="button" id="art-btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d] transition-all">+ Tulis Artikel</button>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3 w-1/4">Judul</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3 w-1/4">Prolog</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="artikel-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="4" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    
        
</div>
@endsection
@section('scripts')
<script>
        // Elements
        const formArt = document.getElementById('form-add-artikel');
        const btnSubmitArt = document.getElementById('art-btn-submit');
        const artAlertBox = document.getElementById('art-alert-box');
        const formContainer = document.getElementById('form-container');
        const tableContainer = document.getElementById('table-container');
        const btnAddNew = document.getElementById('art-btn-add-new');
        const btnCancelArt = document.getElementById('art-btn-cancel');
        const formTitleArt = document.getElementById('art-form-title');

        btnAddNew.addEventListener('click', () => {
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            btnCancelArt.classList.remove('hidden');
            formArt.reset();
            document.getElementById('art_id').value = '';
            document.getElementById('art_image_preview_container').classList.add('hidden');
            formTitleArt.textContent = 'Tulis Artikel Baru';
            btnSubmitArt.textContent = 'Simpan Artikel';
        });

        // Auto Slug for Artikel
        const artTitleInput = document.getElementById('art_title');
        if(artTitleInput) {
            artTitleInput.addEventListener('input', function(e) {
                document.getElementById('art_slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            });
        }
        
        btnCancelArt.addEventListener('click', () => {
            formArt.reset();
            document.getElementById('art_id').value = '';
            document.getElementById('art_image_preview_container').classList.add('hidden');
            formContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
        });

        async function loadArtikel() {
            const tbody = document.getElementById('artikel-table-body');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('articles').select('*').order('created_at', { ascending: false });
                if (error) throw error;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-500">Belum ada data artikel</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                data.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 text-gray-400 text-xs font-mono">${d.id}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">${d.title}</td>
                        <td class="px-4 py-3 text-gray-500">${d.slug}</td>
                        <td class="px-4 py-3 text-gray-500 truncate max-w-xs">${d.prolog || '-'}</td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <button onclick='editArtikel(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deleteArtikel('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Artikel Error:", err);
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
            }
        }

        window.editArtikel = function(d) {
            if (d.thumbnail) {
                const { data } = window.supabaseClient.storage.from('articles').getPublicUrl(d.thumbnail);
                document.getElementById('art_image_preview').src = data.publicUrl;
                document.getElementById('art_image_preview_container').classList.remove('hidden');
            } else {
                document.getElementById('art_image_preview_container').classList.add('hidden');
            }
            document.getElementById('art_id').value = d.id;
            document.getElementById('art_title').value = d.title;
            document.getElementById('art_slug').value = d.slug;
            document.getElementById('art_prolog').value = d.prolog || '';
            document.getElementById('art_content').value = d.content || '';
            
            formTitleArt.textContent = 'Edit Artikel: ' + d.title;
            btnSubmitArt.textContent = 'Update Artikel';
            btnCancelArt.classList.remove('hidden');
            document.getElementById('art_thumbnail').required = false; 
            artAlertBox.className = 'hidden';
            
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });

        };

        window.deleteArtikel = function(id) {
            console.log("Menghapus artikel ID:", id);
            window.confirmDelete('Yakin ingin menghapus artikel ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('articles').delete().eq('id', id);
                    if(error) throw error;
                    window.showToast('Artikel berhasil dihapus!');
                    loadArtikel();
                } catch (err) {
                    console.error("Gagal menghapus artikel:", err);
                    window.showToast('Gagal menghapus: ' + err.message, true);
                }
            });
        };

        // Load initially
        loadArtikel();

        if(formArt) {
            formArt.addEventListener('submit', async (e) => {
                e.preventDefault();
                btnSubmitArt.disabled = true;
                btnSubmitArt.textContent = "Menyimpan & Mengunggah...";
                artAlertBox.className = "hidden";

                try {
                    const title = document.getElementById('art_title').value;
                    const slug = document.getElementById('art_slug').value;
                    const prolog = document.getElementById('art_prolog').value;
                    const content = document.getElementById('art_content').value;
                    
                    const fileInput = document.getElementById('art_thumbnail');
                    const file = fileInput.files[0];
                    
                    let filePath = null;
                    const isUpdate = document.getElementById('art_id').value !== '';
                    if (!file && !isUpdate) throw new Error("File gambar wajib diunggah.");
                    
                    if (file) {
                        const fileExt = file.name.split('.').pop();
                        const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + fileExt;
                        filePath = fileName;
                        
                        const { data: uploadData, error: upError } = await window.supabaseClient.storage
                            .from('articles')
                            .upload(fileName, file);
                        if (upError) throw new Error("Gagal mengunggah gambar: " + upError.message);
                    }

                    const insertData = { title, slug, prolog, content, ...(filePath ? { thumbnail: filePath } : {}) };

                    
                    let dbError;
                    if (isUpdate) {
                        const { error } = await window.supabaseClient.from('articles').update(insertData).eq('id', document.getElementById('art_id').value);
                        dbError = error;
                    } else {
                        const { error } = await window.supabaseClient.from('articles').insert([insertData]);
                        dbError = error;
                    }


                    if (dbError) throw new Error("Database error: " + dbError.message);

                    
                    artAlertBox.textContent = isUpdate ? "Artikel berhasil diupdate!" : "Artikel berhasil ditambahkan!";
                    window.showToast(isUpdate ? 'Artikel berhasil diupdate!' : 'Artikel baru berhasil ditambahkan!');
                    loadArtikel();
                    if(isUpdate) btnCancelArt.click();

                    artAlertBox.className = "block p-4 rounded-lg text-sm font-medium bg-green-100 text-green-700";
                    formArt.reset();

                } catch (err) {
                    artAlertBox.textContent = err.message;
                    artAlertBox.className = "block p-4 rounded-lg text-sm font-medium bg-red-100 text-red-700";
                } finally {
                    btnSubmitArt.disabled = false;
                    btnSubmitArt.textContent = "Simpan Artikel";
                }
            });
        }

        
        async function loadDestinationsOptions() {
            const selectId = document.getElementById('ekstra_destination_id');
            const { data, error } = await supabaseClient.from('destinations').select('id, name').order('name');
            if(data) {
                selectId.innerHTML = '<option value="" disabled selected>Pilih salah satu destinasi...</option>';
                data.forEach(d => {
                    const opt = document.createElement('option');
                    opt.value = d.id;
                    opt.textContent = d.name;
                    selectId.appendChild(opt);
                });
            }
        }
        document.getElementById('btn-refresh-dest').addEventListener('click', loadDestinationsOptions);

        // Submit UMKM
        document.getElementById('form-add-umkm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btn-submit-umkm');
            const destId = document.getElementById('ekstra_destination_id').value;
            const alertBox = document.getElementById('umkm-alert-box');
            
            if(!destId) { window.showToast('Pilih destinasi dulu!', true); return; }
            
            btn.disabled = true; btn.textContent = "Upload...";
            try {
                let imageUrl = null;
                const fileInput = document.getElementById('umkm_image');
                if(fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + file.name.split('.').pop();
                    const { error: upErr } = await supabaseClient.storage.from('umkm_products').upload(fileName, file);
                    if(upErr) throw upErr;
                    imageUrl = fileName;
                }

                // Process prices
                const nameVal = document.getElementById('umkm_name').value;
                const productSlug = nameVal.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
                
                const variantNames = Array.from(document.querySelectorAll('.price-variant-name')).map(i => i.value.trim());
                const variantPrices = Array.from(document.querySelectorAll('.price-variant-price')).map(i => parseInt(i.value) || 0);
                
                const priceList = [];
                for(let i = 0; i < variantNames.length; i++) {
                    if (variantNames[i]) {
                        priceList.push({ name: variantNames[i], price: variantPrices[i] });
                    }
                }

                const payload = {
                    destination_id: destId,
                    name: nameVal,
                    slug: productSlug,
                    price_list: priceList,
                    gmaps_url: document.getElementById('umkm_gmaps').value,
                    description: document.getElementById('umkm_desc').value,
                    image_url: imageUrl
                };

                const { error } = await supabaseClient.from('umkm_products').insert([payload]);
                if(error) throw error;
                
                alertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                alertBox.textContent = "UMKM Berhasil ditambahkan!";
                window.showToast('UMKM berhasil ditambahkan!');
                document.getElementById('form-add-umkm').reset();
            } catch(e) {
                alertBox.className = "block mt-2 p-3 rounded text-sm text-red-700 bg-red-100 font-bold";
                alertBox.textContent = "Error: " + e.message;
            } finally {
                btn.disabled = false; btn.textContent = "Simpan Produk UMKM";
            }
        });

        // Add new price variant
        document.getElementById('btn-add-price').addEventListener('click', () => {
            const container = document.getElementById('price-list-inputs');
            const row = document.createElement('div');
            row.className = "flex space-x-2";
            row.innerHTML = `
                <input type="text" placeholder="Nama Varian" class="price-variant-name w-1/2 px-3 py-2 bg-white border rounded-lg focus:ring-2 text-sm" required>
                <input type="number" placeholder="Harga" class="price-variant-price w-1/2 px-3 py-2 bg-white border rounded-lg focus:ring-2 text-sm" required>
                <button type="button" class="btn-remove-price px-3 py-2 bg-red-500 text-white rounded-lg text-sm">X</button>
            `;
            container.appendChild(row);
        });

        // Delegate remove price variant
        document.getElementById('price-list-inputs').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-remove-price')) {
                e.target.parentElement.remove();
            }
        });

        // Add new paket price variant
        document.getElementById('btn-add-paket-price').addEventListener('click', () => {
            const container = document.getElementById('paket-price-list-inputs');
            const row = document.createElement('div');
            row.className = "flex space-x-2";
            row.innerHTML = `
                <input type="text" placeholder="Nama Paket (cth: Dewasa)" class="paket-price-variant-name w-1/2 px-3 py-2 bg-white border rounded-lg focus:ring-2 text-sm" required>
                <input type="number" placeholder="Harga" class="paket-price-variant-price w-1/2 px-3 py-2 bg-white border rounded-lg focus:ring-2 text-sm" required>
                <button type="button" class="btn-remove-paket-price px-3 py-2 bg-red-500 text-white rounded-lg text-sm">X</button>
            `;
            container.appendChild(row);
        });

        // Delegate remove paket price variant
        document.getElementById('paket-price-list-inputs').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-remove-paket-price')) {
                e.target.parentElement.remove();
            }
        });

        // Submit Paket Tour
        document.getElementById('form-add-paket').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btn-submit-paket');
            const destId = document.getElementById('ekstra_destination_id').value;
            const alertBox = document.getElementById('paket-alert-box');
            
            if(!destId) { window.showToast('Pilih destinasi dulu!', true); return; }
            
            btn.disabled = true; btn.textContent = "Upload...";
            try {
                let imageUrl = null;
                const fileInput = document.getElementById('paket_image');
                if(fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + file.name.split('.').pop();
                    const { error: upErr } = await supabaseClient.storage.from('tour_packages').upload(fileName, file);
                    if(upErr) throw upErr;
                    imageUrl = fileName;
                }

                // Construct price_list array
                const paketPriceNames = document.querySelectorAll('.paket-price-variant-name');
                const paketPricePrices = document.querySelectorAll('.paket-price-variant-price');
                const priceList = [];
                for(let i = 0; i < paketPriceNames.length; i++) {
                    priceList.push({
                        name: paketPriceNames[i].value,
                        price: Number(paketPricePrices[i].value)
                    });
                }
                
                // Fallback to first price for the NOT NULL price column
                const firstPrice = priceList.length > 0 ? priceList[0].price : 0;

                const payload = {
                    destination_id: destId,
                    title: document.getElementById('paket_title').value,
                    price: firstPrice, // Fill the NOT NULL column
                    price_list: priceList,
                    description: document.getElementById('paket_desc').value,
                    image_url: imageUrl
                };

                const { error } = await supabaseClient.from('tour_packages').insert([payload]);
                if(error) throw error;
                
                alertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                alertBox.textContent = "Paket berhasil ditambahkan!";
                window.showToast('Paket berhasil ditambahkan!');
                document.getElementById('form-add-paket').reset();
            } catch(e) {
                alertBox.className = "block mt-2 p-3 rounded text-sm text-red-700 bg-red-100 font-bold";
                alertBox.textContent = "Error: " + e.message;
            } finally {
                btn.disabled = false; btn.textContent = "Simpan Paket Wisata";
            }
        });


        // Form Submit Destinasi
        const form = document.getElementById('form-add-destinasi');
        const btnSubmit = document.getElementById('btn-submit');
        const alertBox = document.getElementById('alert-box');

        console.log("Form elements loaded:", { form, btnSubmit, alertBox });

        // Auto Slug
        document.getElementById('name').addEventListener('input', function(e) {
            document.getElementById('slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        });

        form.addEventListener('submit', async (e) => {
            console.log("Form submit triggered!");
            e.preventDefault();

            btnSubmit.disabled = true;
            btnSubmit.textContent = "Menyimpan & Mengunggah...";
            alertBox.className = "hidden";

            try {
                // 1. Get values
                const name = document.getElementById('name').value;
                const slug = document.getElementById('slug').value;
                const description = document.getElementById('description').value;
                const contact_details = document.getElementById('contact_details').value;
                const gmaps_url = document.getElementById('gmaps_url').value;
                const social_media_url = document.getElementById('social_media_url').value;
                  const is_favorite = document.getElementById('is_favorite').checked;

                  // 2. Upload file to Supabase Storage ('destinations' bucket)
                  const fileInput = document.getElementById('thumbnail');
                  const file = fileInput.files[0];
                  if (!file) throw new Error("File gambar wajib diunggah.");
                  const fileExt = file.name.split('.').pop();
                const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + fileExt;
                const filePath = fileName;

                const { data: uploadData, error: uploadError } = await supabaseClient.storage
                    .from('destinations')
                    .upload(filePath, file);

                if (uploadError) throw new Error("Gagal mengunggah gambar: " + uploadError.message);

                // 3. Insert to database
                const insertData = {
                    name: name,
                    slug: slug,
                    description: description,
                    contact_details: contact_details,
                    gmaps_url: gmaps_url,
                    social_media: social_media_url ? { url: social_media_url } : null,
                    is_favorite: is_favorite,
                    thumbnail: filePath // Save just the filename/path
                };

                const { error: dbError } = await supabaseClient
                    .from('destinations')
                    .insert([insertData]);

                if (dbError) throw new Error("Gagal menyimpan data database: " + dbError.message);

                // Success
                console.log("Berhasil insert data:", insertData);
                alertBox.textContent = "Berhasil! Destinasi baru telah ditambahkan.";
                alertBox.className = "block p-4 rounded-lg text-sm font-medium bg-green-100 text-green-700 mb-4";
                form.reset();

            } catch (err) {
                console.error("Error detail:", err);
                alert("Gagal: " + err.message); // Menambahkan popup peringatan agar lebih terihat
                alertBox.textContent = err.message;
                alertBox.className = "block p-4 rounded-lg text-sm font-medium bg-red-100 text-red-700 mb-4";
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.textContent = "Simpan Destinasi";
            }
        });

        // Auto Slug for Categories
        const catNameInput = document.getElementById('cat_name');
        if(catNameInput) {
            catNameInput.addEventListener('input', function(e) {
                document.getElementById('cat_slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            });
        }

        
</script>
@endsection