@extends('admin.layouts.app')
@section('content')
<div id="view-destinasi" class="block">
            <div id="form-container" class="hidden bg-[white] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 border border-[gray-200]/30">
<input type="hidden" id="dest_id">
            
            <div class="mb-4">
                <button type="button" id="btn-cancel" class="flex items-center text-[#6c853d] hover:text-[#819E4A] font-bold transition-all hover:-translate-x-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>
            <h2 id="form-title" class="text-2xl font-bold text-[#819E4A] mb-8 border-b-2 border-[gray-200]/30 pb-4">Tambah Destinasi Baru</h2>

            <form id="form-add-destinasi" class="space-y-6">
                <!-- Group Info Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Nama Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" id="name" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Slug (URL friendly) <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" required placeholder="misal: danau-toba" class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Deskripsi Singkat / Prolog <span class="text-red-500">*</span></label>
                    <textarea id="description" rows="4" required class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed"></textarea>
                </div>

                <!-- Jadwal & Fasilitas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-[gray-100]/30 p-5 rounded-xl border border-[gray-200]/50">
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Jadwal Operasional (opsional)</label>
                        <textarea id="schedule" rows="4" placeholder="Contoh:\nSenin - Jumat: 08.00 - 17.00\nSabtu - Minggu: 07.00 - 18.00\nLibur Nasional: Tutup" class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed placeholder-gray-400"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Fasilitas (opsional)</label>
                        <textarea id="facilities" rows="4" placeholder="Contoh:\nArea Parkir Luas\nToilet Umum\nMusala\nWarung Makan\nSpot Foto" class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed placeholder-gray-400"></textarea>
                    </div>
                </div>

                <!-- Media -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Upload Thumbnail Utama (opsional, maks 2MB)</label>
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[gray-200] border-dashed rounded-xl cursor-pointer bg-white hover:bg-[gray-100]/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-[#8c8c62]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-[#6c853d]"><span class="font-semibold">Klik untuk upload file gambar</span></p>
                            </div>
                            <input type="file" id="thumbnail" accept="image/*" class="hidden" />
                        </label>
                    </div>
                    <p id="thumbnail-name" class="mt-2 text-sm text-[#8c8c62] italic hidden"></p>
                    
                    <!-- Unified Image Preview -->
                    <div id="image_preview_container" class="mt-4 hidden p-3 bg-white border border-[gray-200] rounded-xl inline-block">
                        <p id="image_preview_label" class="text-xs font-bold text-[#6c853d] mb-2">Preview:</p>
                        <img id="image_preview_img" src="" alt="Preview" class="h-36 rounded-lg shadow-sm object-cover">
                    </div>
                </div>

                <!-- Optional Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-[gray-100]/30 p-5 rounded-xl border border-[gray-200]/50">
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Detail Kontak Reservasi (opsional)</label>
                        <input type="text" id="contact_details" placeholder="WhatsApp: +62... / Email: info@..." class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Google Maps Embed URL (opsional)</label>
                        <input type="url" id="gmaps_url" placeholder="https://www.google.com/maps/embed?..." class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">ID Sosmed Instgram/Tiktok (opsional)</label>
                        <input type="text" id="social_media_url" placeholder="@indeta_trip" class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all placeholder-gray-400">
                    </div>
                </div>

                <div class="flex items-center pt-2">
                    <input id="is_favorite" type="checkbox" class="w-5 h-5 text-[#819E4A] bg-white border-[gray-200] rounded focus:ring-[#819E4A] focus:ring-2">
                    <label for="is_favorite" class="ml-3 text-sm font-bold text-[#6c853d]">Tandai sebagai Destinasi Pilihan (Populer)</label>
                </div>

                <!-- Alerts -->
                <div id="alert-box" class="hidden p-4 rounded-xl text-sm font-medium"></div>

                
                <!-- Submit Button -->
                <div class="flex justify-end pt-4 space-x-2">
                    <button type="submit" id="btn-submit" class="px-8 py-3 bg-[#819E4A] hover:bg-[#6c853d] text-[gray-100] rounded-full font-bold shadow-lg transition-all hover:-translate-y-1 w-full md:w-auto">Simpan Destinasi</button>
                </div>
            </form>
</div>

        <div id="table-container">
        <div class="mt-12 bg-white rounded-2xl shadow-xl p-6 border border-[gray-200]/30">
            <div class="flex justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
            <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Destinasi</h2>
            <button type="button" id="btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d]">+ Tambah Destinasi</button>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3">Favorit</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="destinasi-table-body" class="divide-y divide-gray-200">
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
// Form Submit Destinasi
        // Elements
        const form = document.getElementById('form-add-destinasi');
        const btnSubmit = document.getElementById('btn-submit');
        const alertBox = document.getElementById('alert-box');
        const formContainer = document.getElementById('form-container');
        const tableContainer = document.getElementById('table-container');
        const btnAddNew = document.getElementById('btn-add-new');
        const btnCancel = document.getElementById('btn-cancel');
        const formTitle = document.getElementById('form-title');

        console.log("Form elements loaded:", { form, btnSubmit, alertBox });
        
        // Auto Slug
        document.getElementById('name').addEventListener('input', function(e) {
            document.getElementById('slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        });

        // Live thumbnail preview on file select
        document.getElementById('thumbnail').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('image_preview_container');
            const previewImg = document.getElementById('image_preview_img');
            const previewLabel = document.getElementById('image_preview_label');
            const nameEl = document.getElementById('thumbnail-name');
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    previewImg.src = ev.target.result;
                    previewLabel.textContent = 'Preview Upload:';
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
                nameEl.textContent = file.name;
                nameEl.classList.remove('hidden');
            } else {
                previewContainer.classList.add('hidden');
                nameEl.classList.add('hidden');
            }
        });

        btnAddNew.addEventListener('click', () => {
            document.getElementById('image_preview_container').classList.add('hidden');
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            btnCancel.classList.remove('hidden'); 
            form.reset();
            document.getElementById('dest_id').value = '';
            formTitle.textContent = 'Tambah Destinasi Baru';
            btnSubmit.textContent = 'Simpan Destinasi';
        });

        btnCancel.addEventListener('click', () => {
            document.getElementById('image_preview_container').classList.add('hidden');
            form.reset();
            document.getElementById('dest_id').value = '';
            formContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
        });

        async function loadDestinasi() {
            const tbody = document.getElementById('destinasi-table-body');
            try {
                if (!window.supabaseClient) {
                    throw new Error("Supabase client belum siap.");
                }
                const { data, error } = await window.supabaseClient.from('destinations').select('*').order('created_at', { ascending: false });
                if (error) throw error;

                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-500">Belum ada data destinasi</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                data.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 text-gray-400 text-xs font-mono">${d.id}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">${d.name}</td>
                        <td class="px-4 py-3 text-gray-500">${d.slug}</td>
                        <td class="px-4 py-3">${d.is_favorite ? '⭐ Ya' : '-'}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick='editDestinasi(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deleteDestinasi('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Destinasi Error:", err);
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
            }
        }

        window.editDestinasi = function(d) {
            if (d.thumbnail) {
                const { data } = window.supabaseClient.storage.from('destinations').getPublicUrl(d.thumbnail);
                document.getElementById('image_preview_img').src = data.publicUrl;
                document.getElementById('image_preview_label').textContent = 'Gambar Saat Ini:';
                document.getElementById('image_preview_container').classList.remove('hidden');
            } else {
                document.getElementById('image_preview_container').classList.add('hidden');
            }
            document.getElementById('dest_id').value = d.id;
            document.getElementById('name').value = d.name;
            document.getElementById('slug').value = d.slug;
            document.getElementById('description').value = d.description || '';
            document.getElementById('schedule').value = d.schedule || '';
            document.getElementById('facilities').value = d.facilities || '';
            document.getElementById('contact_details').value = d.contact_details || '';
            document.getElementById('gmaps_url').value = d.gmaps_url || '';
            document.getElementById('social_media_url').value = d.social_media ? d.social_media.url : '';
            document.getElementById('is_favorite').checked = d.is_favorite;
            
            formTitle.textContent = 'Edit Destinasi: ' + d.name;
            btnSubmit.textContent = 'Update Destinasi';
            btnCancel.classList.remove('hidden');
            document.getElementById('thumbnail').required = false; 
            alertBox.className = 'hidden';
            
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });

        };

        window.deleteDestinasi = function(id) {
            console.log("Menghapus destinasi ID:", id);
            window.confirmDelete('Yakin ingin menghapus destinasi ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('destinations').delete().eq('id', id);
                    if(error) throw error;
                    window.showToast('Destinasi berhasil dihapus!');
                    loadDestinasi();
                } catch (err) {
                    console.error("Gagal menghapus destinasi:", err);
                    window.showToast('Gagal menghapus: ' + err.message, true);
                }
            });
        };

        // Load initially
        loadDestinasi();

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
                const schedule = document.getElementById('schedule').value;
                const facilities = document.getElementById('facilities').value;
                const contact_details = document.getElementById('contact_details').value;
                const gmaps_url = document.getElementById('gmaps_url').value;
                const social_media_url = document.getElementById('social_media_url').value;
                  const is_favorite = document.getElementById('is_favorite').checked;

                  // 2. Upload file to Supabase Storage ('destinations' bucket)
                  const fileInput = document.getElementById('thumbnail');
                  const file = fileInput.files[0];
                  
                  let filePath = null;
                  const isUpdate = document.getElementById('dest_id').value !== '';
                  if (!file && !isUpdate) throw new Error("File gambar wajib diunggah.");
                  
                  if (file) {
                      const fileExt = file.name.split('.').pop();
                      const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + fileExt;
                      filePath = fileName;

                      const { data: uploadData, error: uploadError } = await window.supabaseClient.storage
                          .from('destinations')
                          .upload(filePath, file);

                      if (uploadError) throw new Error("Gagal mengunggah gambar: " + uploadError.message);
                  }

                // 3. Insert to database
                const insertData = {
                    name: name,
                    slug: slug,
                    description: description,
                    schedule: schedule || null,
                    facilities: facilities || null,
                    contact_details: contact_details,
                    gmaps_url: gmaps_url,
                    social_media: social_media_url ? { url: social_media_url } : null,
                    is_favorite: is_favorite,
                    ...(filePath ? { thumbnail: filePath } : {})
                };

                
                let dbError;
                if (isUpdate) {
                    const { error } = await window.supabaseClient.from('destinations').update(insertData).eq('id', document.getElementById('dest_id').value);
                    dbError = error;
                } else {
                    const { error } = await window.supabaseClient.from('destinations').insert([insertData]);
                    dbError = error;
                }


                if (dbError) throw new Error("Gagal menyimpan data database: " + dbError.message);

                // Success
                console.log("Berhasil insert data:", insertData);
                
                alertBox.textContent = isUpdate ? "Destinasi berhasil diupdate!" : "Berhasil! Destinasi baru telah ditambahkan.";
                window.showToast(isUpdate ? 'Destinasi berhasil diupdate!' : 'Destinasi baru berhasil ditambahkan!');
                loadDestinasi();
                if(isUpdate) btnCancel.click(); // reset and hide cancel

                alertBox.className = "block p-4 rounded-lg text-sm font-medium bg-green-100 text-green-700 mb-4";
                form.reset();

            } catch (err) {
                console.error("Error detail:", err);
                window.showToast('Gagal: ' + err.message, true);
                alertBox.textContent = err.message;
                alertBox.className = "block p-4 rounded-lg text-sm font-medium bg-red-100 text-red-700 mb-4";
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.textContent = "Simpan Destinasi";
            }
        });

        
</script>
@endsection