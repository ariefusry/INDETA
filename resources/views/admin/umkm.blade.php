@extends('admin.layouts.app')
@section('content')
<div class="p-8">
<div id="view-umkm_products" class="block">

            <div id="form-container" class="hidden bg-[white] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 border border-[gray-200]/30">
            <div class="mb-4">
                <button type="button" id="btn-cancel-umkm" class="flex items-center text-[#6c853d] hover:text-[#819E4A] font-bold transition-all hover:-translate-x-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>
            <h2 id="umkm-form-title" class="text-2xl font-bold text-[#819E4A] mb-8 border-b-2 border-[gray-200]/30 pb-4">Tambah UMKM Baru</h2>

            <div class="space-y-8">
                <!-- UMKM Main Form Card -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[gray-200]/30">
                    <form id="form-add-category" class="space-y-6">
                        <input type="hidden" id="umkm_id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#6c853d] mb-2">Nama UMKM <span class="text-red-500">*</span></label>
                                <input type="text" id="umkm_name" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#6c853d] mb-2">Slug (URL friendly) <span class="text-red-500">*</span></label>
                                <input type="text" id="umkm_slug" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-2">Deskripsi Produk UMKM <span class="text-red-500">*</span></label>
                            <textarea id="umkm_desc" rows="4" required class="w-full px-4 py-3 bg-white border border-[gray-200] text-gray-800 rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 focus:border-[#819E4A] shadow-sm outline-none transition-all leading-relaxed"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-2">Upload Gambar UMKM (opsional)</label>
                            <div class="relative flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[gray-200] border-dashed rounded-xl cursor-pointer bg-white hover:bg-[gray-100]/50 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-[#8c8c62]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-[#6c853d]"><span class="font-semibold">Klik untuk upload gambar produk</span></p>
                                    </div>
                                    <input type="file" id="umkm_image" accept="image/*" class="hidden" />
                                </label>
                            </div>
                            <div id="umkm_image_preview_container" class="hidden mt-4 p-2 bg-white border border-[gray-200] rounded-xl inline-block">
                                <p class="text-xs font-bold text-[#6c853d] mb-2">Gambar Saat Ini:</p>
                                <img id="umkm_image_preview" src="" class="h-32 object-cover rounded-lg">
                            </div>
                        </div>

                        <div id="umkm-alert-box" class="hidden p-4 rounded-xl text-sm font-medium"></div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" id="btn-submit-cat" class="px-12 py-3 bg-[#819E4A] hover:bg-[#6c853d] text-white rounded-full font-bold shadow-lg transition-all hover:-translate-y-1">Simpan Data UMKM</button>
                        </div>
                    </form>
                </div>

                <!-- Mapping Section -->
                <div class="bg-[gray-100]/30 p-8 rounded-3xl border border-[gray-200]/50 shadow-sm">
                    <h3 class="text-xl font-bold text-[#6c853d] mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        Hubungkan UMKM dengan Destinasi
                    </h3>
                    <form id="form-assign-umkm-dest" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-end">
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-2">Pilih UMKM</label>
                            <select id="assign_umkm_id" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all">
                                <option value="" disabled selected>Memuat umkm...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-2">Pilih Destinasi</label>
                            <select id="assign_dest_id" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all">
                                <option value="" disabled selected>Memuat destinasi...</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" id="btn-submit-assign" class="px-6 py-2.5 bg-green-700 hover:bg-green-800 text-white rounded-xl font-bold w-full transition-all shadow-md shadow-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tautkan Sekarang
                            </button>
                        </div>
                        <div id="assign-alert-box" class="hidden md:col-span-2 lg:col-span-3 p-3 rounded-lg text-sm mt-2 font-medium"></div>
                    </form>
                </div>
            </div>
        </div>

    
</div>

        <div id="table-container">
        <div class="mt-12 bg-white rounded-2xl shadow-xl p-6 border border-[gray-200]/30">
            <div class="flex justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
            <h2 class="text-2xl font-bold text-[#819E4A]">Daftar UMKM</h2>
            <button type="button" id="umkm-btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d] transition-all">+ Tambah UMKM</button>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama UMKM</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="umkm-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="3" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center mt-12 mb-6 border-b-2 border-[gray-200]/30 pb-4">
                <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Tautan Destinasi</h2>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <span class="text-sm font-bold text-gray-500">Filter Destinasi:</span>
                    <select id="filter-umkm-dest" class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all min-w-[200px]">
                        <option value="all">Semua Destinasi</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">UMKM</th>
                            <th class="px-4 py-3">Destinasi</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="assign-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="3" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
</div>
@endsection
@section('scripts')
<script>
// Auto Slug for Categories
        const catNameInput = document.getElementById('umkm_name');
        if(catNameInput) {
            catNameInput.addEventListener('input', function(e) {
                document.getElementById('umkm_slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            });
        }

        // Load data for Assign form
        async function loadDestinationsForCategory() {
            const selectCat = document.getElementById('assign_umkm_id');
            const selectDest = document.getElementById('assign_dest_id');
            
            if(selectCat && selectDest) {
                const { data: catData } = await window.supabaseClient.from('umkm_products').select('id, name').order('name');
                if(catData) {
                    selectCat.innerHTML = '<option value="" disabled selected>Pilih salah satu umkm...</option>';
                    catData.forEach(c => selectCat.appendChild(new Option(c.name, c.id)));
                }

                const { data: destData } = await window.supabaseClient.from('destinations').select('id, name').order('name');
                if(destData) {
                    selectDest.innerHTML = '<option value="" disabled selected>Pilih salah satu destinasi...</option>';
                    const filterSelect = document.getElementById('filter-umkm-dest');
                    if (filterSelect) filterSelect.innerHTML = '<option value="all">Semua Destinasi</option>';
                    
                    destData.forEach(d => {
                        selectDest.appendChild(new Option(d.name, d.id));
                        if (filterSelect) filterSelect.appendChild(new Option(d.name, d.id));
                    });
                }
            }
        }

        // Submit Add Category
        
        
        // Elements
        const formCat = document.getElementById('form-add-category');
        const btnCancelCat = document.getElementById('btn-cancel-umkm');
        const formTitleCat = document.getElementById('umkm-form-title');
        const formContainer = document.getElementById('form-container');
        const tableContainer = document.getElementById('table-container');
        const btnAddNew = document.getElementById('umkm-btn-add-new');
        const btnSubmitCat = document.getElementById('btn-submit-cat');
        const catAlertBox = document.getElementById('umkm-alert-box');

        btnAddNew.addEventListener('click', () => {
            document.getElementById('umkm_image_preview_container').classList.add('hidden');
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            btnCancelCat.classList.remove('hidden');
            formCat.reset();
            document.getElementById('umkm_id').value = '';
            formTitleCat.textContent = '1. Buat UMKM Baru';
            btnSubmitCat.textContent = 'Buat UMKM';
        });
        btnCancelCat.addEventListener('click', () => {
                        document.getElementById('umkm_image_preview_container').classList.add('hidden');
formCat.reset();
            document.getElementById('umkm_id').value = '';
            document.getElementById('umkm_image_preview_container').classList.add('hidden');
            formContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
        });

        async function loadUMKMList() {
            const tbody = document.getElementById('umkm-table-body');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('umkm_products').select('*').order('name');
                if (error) throw error;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Belum ada data umkm</td></tr>';
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
                        <td class="px-4 py-3 space-x-2">
                            <button onclick='editUMKM(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deleteUMKM('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load UMKM Error:", err);
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
            }
        }

        async function loadAssignList() {
            const tbody = document.getElementById('assign-table-body');
            const filterDestId = document.getElementById('filter-umkm-dest')?.value || 'all';

            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                
                // Fetch UMKM names for mapping
                const { data: umkmList } = await window.supabaseClient.from('umkm_products').select('id, name');
                const umkmMap = {};
                if (umkmList) umkmList.forEach(u => umkmMap[u.id] = u.name);

                let query = window.supabaseClient.from('category_destinations')
                    .select('category_id, destination_id, destinations(name)');
                
                if (filterDestId !== 'all') {
                    query = query.eq('destination_id', filterDestId);
                }

                const { data, error } = await query;
                
                if (error) throw error;
                
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Belum ada tautan</td></tr>';
                    return;
                }

                tbody.innerHTML = '';
                data.forEach(d => {
                    const umkmName = umkmMap[d.category_id] || `${d.category_id} (ID UMKM)`;
                    // Only show if it's likely a UMKM (not a Category)
                    // Since the user is using the same table, we check if the ID exists in our UMKM map
                    if (!umkmMap[d.category_id]) return; 

                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 font-medium text-gray-900">${umkmName}</td>
                        <td class="px-4 py-3 text-gray-500">${d.destinations ? d.destinations.name : '-'}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick="deleteAssign('${d.category_id}', '${d.destination_id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus Tautan</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Assign List Error:", err);
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-red-500 py-4">Gagal memuat tautan: ${err.message}</td></tr>`;
            }
        }

        window.editUMKM = function(d) {
            if (d.image_url) {
                let finalUrl = d.image_url;
                if (!finalUrl.startsWith('http')) {
                    const { data } = window.supabaseClient.storage.from('umkm_products').getPublicUrl(d.image_url);
                    finalUrl = data.publicUrl;
                }
                document.getElementById('umkm_image_preview').src = finalUrl;
                document.getElementById('umkm_image_preview_container').classList.remove('hidden');
            } else {
                document.getElementById('umkm_image_preview_container').classList.add('hidden');
            }
            document.getElementById('umkm_id').value = d.id;
            document.getElementById('umkm_name').value = d.name;
            document.getElementById('umkm_slug').value = d.slug;
            document.getElementById('umkm_desc').value = d.description || '';
            
            formTitleCat.textContent = 'Edit UMKM: ' + d.name;
            document.getElementById('btn-submit-cat').textContent = 'Update UMKM';
            btnCancelCat.classList.remove('hidden');
            
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        window.deleteUMKM = function(id) {
            console.log("Menghapus UMKM ID:", id);
            window.confirmDelete('Yakin menghapus umkm ini? (Tautan dengan destinasi juga mungkin terputus)', async () => {
                try {
                    const { error } = await window.supabaseClient.from('umkm_products').delete().eq('id', id);
                    if(error) throw error;
                    alert('Berhasil dihapus');
                    loadUMKMList();
                    loadDestinationsForCategory();
                } catch (err) {
                    console.error("Gagal menghapus UMKM:", err);
                    alert('Gagal menghapus: ' + err.message);
                }
            });
        };

        window.deleteAssign = function(catId, destId) {
            console.log("Menghapus tautan UMKM-Destinasi:", { catId, destId });
            window.confirmDelete('Yakin menghapus tautan ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('category_destinations').delete().eq('category_id', catId).eq('destination_id', destId);
                    if(error) throw error;
                    loadAssignList();
                } catch (err) {
                    console.error("Gagal menghapus tautan:", err);
                    alert('Gagal menghapus tautan: ' + err.message);
                }
            });
        };

        // Load initially
        loadUMKMList();
        loadAssignList();
        loadDestinationsForCategory();

        // Filter listener
        document.getElementById('filter-umkm-dest').addEventListener('change', () => {
            loadAssignList();
        });

        if(formCat) {
            formCat.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btnSubmitCat = document.getElementById('btn-submit-cat');
                const catAlertBox = document.getElementById('umkm-alert-box');
                btnSubmitCat.disabled = true; btnSubmitCat.textContent = "Menyimpan...";
                
                try {
                    let imageUrl = null;
                    const fileInput = document.getElementById('umkm_image');
                    
                    const isUpdate = document.getElementById('umkm_id').value !== '';
                    if(fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + file.name.split('.').pop();
                        const { error: upErr } = await window.supabaseClient.storage.from('umkm_products').upload(fileName, file);
                        if(upErr) throw upErr;
                        imageUrl = fileName;
                    }

                    
                    const insertData = {
                        name: document.getElementById('umkm_name').value,
                        slug: document.getElementById('umkm_slug').value,
                        description: document.getElementById('umkm_desc').value,
                        ...(imageUrl ? { image_url: imageUrl } : {})
                    };


                    
                    let error;
                    if (isUpdate) {
                        const { error: errUpdate } = await window.supabaseClient.from('umkm_products').update(insertData).eq('id', document.getElementById('umkm_id').value);
                        error = errUpdate;
                    } else {
                        const { error: errInsert } = await window.supabaseClient.from('umkm_products').insert([insertData]);
                        error = errInsert;
                    }

                    if(error) throw error;
                    
                    catAlertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                    
                    catAlertBox.textContent = isUpdate ? "UMKM berhasil diupdate!" : "UMKM berhasil dibuat!";
                    if(isUpdate) btnCancelCat.click();
                    loadUMKMList();

                    formCat.reset();
                    loadDestinationsForCategory();
                } catch(e) {
                    catAlertBox.className = "block mt-2 p-3 rounded text-sm text-red-700 bg-red-100 font-bold";
                    catAlertBox.textContent = "Error: " + e.message;
                } finally {
                    btnSubmitCat.disabled = false; btnSubmitCat.textContent = "Buat UMKM";
                }
            });
        }

        // Submit Assign Destination
        const formAssign = document.getElementById('form-assign-umkm-dest');
        if(formAssign) {
            formAssign.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btnAssign = document.getElementById('btn-submit-assign');
                const assignAlertBox = document.getElementById('assign-alert-box');
                btnAssign.disabled = true; btnAssign.textContent = "Menautkan...";
                
                try {
                    const insertData = {
                        category_id: document.getElementById('assign_umkm_id').value,
                        destination_id: document.getElementById('assign_dest_id').value
                    };

                    const { error } = await window.supabaseClient.from('category_destinations').insert([insertData]);
                    if(error) {
                        if(error.code === '23505') throw new Error("Destinasi sudah ada di umkm ini.");
                        throw error;
                    }
                    
                    assignAlertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                    assignAlertBox.textContent = "Berhasil menautkan destinasi ke umkm!";
                    formAssign.reset();
                    loadAssignList();
                } catch(e) {
                    assignAlertBox.className = "block mt-2 p-3 rounded text-sm text-red-700 bg-red-100 font-bold";
                    assignAlertBox.textContent = "Error: " + e.message;
                } finally {
                    btnAssign.disabled = false; btnAssign.textContent = "Tautkan Destinasi";
                }
            });
        }
    
document.addEventListener('DOMContentLoaded', () => { if(typeof loadDestinationsForCategory === 'function') loadDestinationsForCategory(); });
</script>
@endsection