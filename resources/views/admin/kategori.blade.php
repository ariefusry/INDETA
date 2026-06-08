@extends('admin.layouts.app')
@section('content')
<div id="view-categories" class="block">

            <div id="form-container" class="hidden bg-[white] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 border border-[gray-200]/30">
            <div class="mb-4">
                <button type="button" id="btn-cancel-cat" class="flex items-center text-[#6c853d] hover:text-[#819E4A] font-bold transition-all hover:-translate-x-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Tambah Kategori -->
                <div>
                    <input type="hidden" id="cat_id">
                    <h3 id="cat-form-title" class="text-xl font-bold text-[#6c853d] mb-4">1. Buat Kategori Baru</h3>
                    <form id="form-add-category" class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Nama Kategori</label>
                            <input type="text" id="cat_name" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Slug Kategori</label>
                            <input type="text" id="cat_slug" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Upload Gambar Kategori (opsional)</label>
                            <input type="file" id="cat_image" accept="image/*" class="w-full text-sm">
                            <div id="cat_image_preview_container" class="hidden mt-2">
                                <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                                <img id="cat_image_preview" src="" class="h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Deskripsi Kategori</label>
                            <textarea id="cat_desc" rows="3" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30"></textarea>
                        </div>
                        <div id="cat-alert-box" class="hidden p-3 rounded-lg text-sm"></div>
                        
                        <div>
                            
                            <button type="submit" id="btn-submit-cat" 
 class="px-6 py-2 bg-[#819E4A] hover:bg-[#6c853d] text-white rounded-xl font-bold w-full transition-colors">Buat Kategori</button>
                        </div>
                    </form>
                </div>

                <!-- Assign Destinasi ke Kategori -->
                <div class="bg-[gray-100]/50 p-6 rounded-2xl border border-[gray-200]/50">
                    <h3 class="text-xl font-bold text-[#6c853d] mb-4">2. Pasangkan Destinasi ke Kategori</h3>
                    <form id="form-assign-cat-dest" class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Pilih Kategori</label>
                            <select id="assign_cat_id" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                                <option value="" disabled selected>Memuat kategori...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#6c853d] mb-1">Pilih Destinasi</label>
                            <select id="assign_dest_id" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                                <option value="" disabled selected>Memuat destinasi...</option>
                            </select>
                        </div>
                        <div id="assign-alert-box" class="hidden p-3 rounded-lg text-sm"></div>
                        <button type="submit" id="btn-submit-assign" class="px-6 py-2 bg-green-700 hover:bg-green-800 text-white rounded-xl font-bold w-full transition-colors">Tautkan Destinasi</button>
                    </form>
                </div>
            </div>
        </div>

    
</div>

        <div id="table-container">
        <div class="mt-12 bg-white rounded-2xl shadow-xl p-6 border border-[gray-200]/30">
            <div class="flex justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
            <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Kategori</h2>
            <button type="button" id="cat-btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d] transition-all">+ Tambah Kategori</button>
        </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama Kategori</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kategori-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="3" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center mt-12 mb-6 border-b-2 border-[gray-200]/30 pb-4">
                <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Tautan Destinasi</h2>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <span class="text-sm font-bold text-gray-500">Filter Destinasi:</span>
                    <select id="filter-assign-dest" class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all min-w-[200px]">
                        <option value="all">Semua Destinasi</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">Kategori</th>
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
@endsection
@section('scripts')
<script>
// Auto Slug for Categories
        const catNameInput = document.getElementById('cat_name');
        if(catNameInput) {
            catNameInput.addEventListener('input', function(e) {
                document.getElementById('cat_slug').value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            });
        }

        // Load data for Assign form
        async function loadDestinationsForCategory() {
            const selectCat = document.getElementById('assign_cat_id');
            const selectDest = document.getElementById('assign_dest_id');
            
            if(selectCat && selectDest) {
                const { data: catData } = await window.supabaseClient.from('categories').select('id, name').order('name');
                if(catData) {
                    selectCat.innerHTML = '<option value="" disabled selected>Pilih salah satu kategori...</option>';
                    catData.forEach(c => selectCat.appendChild(new Option(c.name, c.id)));
                }

                const { data: destData } = await window.supabaseClient.from('destinations').select('id, name').order('name');
                if(destData) {
                    selectDest.innerHTML = '<option value="" disabled selected>Pilih salah satu destinasi...</option>';
                    const filterSelect = document.getElementById('filter-assign-dest');
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
        const btnCancelCat = document.getElementById('btn-cancel-cat');
        const formTitleCat = document.getElementById('cat-form-title');
        const btnSubmitCat = document.getElementById('btn-submit-cat');
        const catAlertBox = document.getElementById('cat-alert-box');
        const formContainer = document.getElementById('form-container');
        const tableContainer = document.getElementById('table-container');
        const btnAddNew = document.getElementById('cat-btn-add-new');

        btnAddNew.addEventListener('click', () => {
            document.getElementById('cat_image_preview_container').classList.add('hidden');
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            btnCancelCat.classList.remove('hidden');
            formCat.reset();
            document.getElementById('cat_id').value = '';
            formTitleCat.textContent = '1. Buat Kategori Baru';
            btnSubmitCat.textContent = 'Buat Kategori';
        });

        // btnCancelCat was defined above
        
        btnCancelCat.addEventListener('click', () => {
                        document.getElementById('cat_image_preview_container').classList.add('hidden');
formCat.reset();
            document.getElementById('cat_id').value = '';
            document.getElementById('cat_image_preview_container').classList.add('hidden');
            formContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
        });

        async function loadKategoriList() {
            const tbody = document.getElementById('kategori-table-body');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('categories').select('*').order('name');
                if (error) throw error;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Belum ada data kategori</td></tr>';
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
                            <button onclick='editKategori(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deleteKategori('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Kategori Error:", err);
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
            }
        }

        async function loadAssignList() {
            const tbody = document.getElementById('assign-table-body');
            const filterDestId = document.getElementById('filter-assign-dest')?.value || 'all';
            
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                
                let query = window.supabaseClient.from('category_destinations')
                    .select('category_id, destination_id, categories(name), destinations(name)');
                
                if (filterDestId !== 'all') {
                    query = query.eq('destination_id', filterDestId);
                }

                const { data, error } = await query;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Belum ada tautan</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                data.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 font-medium text-gray-900">${d.categories ? d.categories.name : '-'}</td>
                        <td class="px-4 py-3 text-gray-500">${d.destinations ? d.destinations.name : '-'}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick="deleteAssign('${d.category_id}', '${d.destination_id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus Tautan</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Assign Error:", err);
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-red-500 py-4">Gagal memuat tautan: ${err.message}</td></tr>`;
            }
        }

        window.editKategori = function(d) {
            if (d.image_url) {
                const { data } = window.supabaseClient.storage.from('indeta_assets').getPublicUrl('categories/' + d.image_url);
                document.getElementById('cat_image_preview').src = data.publicUrl;
                document.getElementById('cat_image_preview_container').classList.remove('hidden');
            } else {
                document.getElementById('cat_image_preview_container').classList.add('hidden');
            }
            document.getElementById('cat_id').value = d.id;
            document.getElementById('cat_name').value = d.name;
            document.getElementById('cat_slug').value = d.slug;
            document.getElementById('cat_desc').value = d.description || '';
            
            formTitleCat.textContent = 'Edit Kategori: ' + d.name;
            document.getElementById('btn-submit-cat').textContent = 'Update Kategori';
            btnCancelCat.classList.remove('hidden');
            
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        window.deleteKategori = function(id) {
            console.log("Menghapus kategori ID:", id);
            window.confirmDelete('Yakin menghapus kategori ini? (Tautan dengan destinasi juga mungkin terputus)', async () => {
                try {
                    const { error } = await window.supabaseClient.from('categories').delete().eq('id', id);
                    if(error) throw error;
                    window.showToast('Kategori berhasil dihapus!');
                    loadKategoriList();
                    loadDestinationsForCategory();
                } catch (err) {
                    console.error("Gagal menghapus kategori:", err);
                    window.showToast('Gagal menghapus: ' + err.message, true);
                }
            });
        };

        window.deleteAssign = function(catId, destId) {
            console.log("Menghapus tautan Kategori-Destinasi:", { catId, destId });
            window.confirmDelete('Yakin menghapus tautan ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('category_destinations').delete().eq('category_id', catId).eq('destination_id', destId);
                    if(error) throw error;
                    loadAssignList();
                } catch (err) {
                    console.error("Gagal menghapus tautan:", err);
                    window.showToast('Gagal menghapus tautan: ' + err.message, true);
                }
            });
        };

        // Load initially
        loadKategoriList();
        loadAssignList();
        loadDestinationsForCategory();

        // Filter listener
        document.getElementById('filter-assign-dest').addEventListener('change', () => {
            loadAssignList();
        });

        // formCat was defined above
        if(formCat) {
            formCat.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btnSubmitCat = document.getElementById('btn-submit-cat');
                const catAlertBox = document.getElementById('cat-alert-box');
                btnSubmitCat.disabled = true; btnSubmitCat.textContent = "Menyimpan...";
                
                try {
                    let imageUrl = null;
                    const fileInput = document.getElementById('cat_image');
                    
                    const isUpdate = document.getElementById('cat_id').value !== '';
                    if(fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        const fileName = Date.now() + '-' + Math.random().toString(36).substring(7) + '.' + file.name.split('.').pop();
                        const { error: upErr } = await window.supabaseClient.storage.from('indeta_assets').upload('categories/' + fileName, file);
                        if(upErr) throw upErr;
                        imageUrl = fileName;
                    } else {
                        // for update without image, we skip image_url by only adding it if exists
                    }

                    
                    const insertData = {
                        name: document.getElementById('cat_name').value,
                        slug: document.getElementById('cat_slug').value,
                        description: document.getElementById('cat_desc').value,
                        ...(imageUrl ? { image_url: imageUrl } : {})
                    };


                    
                    let error;
                    if (isUpdate) {
                        const { error: errUpdate } = await window.supabaseClient.from('categories').update(insertData).eq('id', document.getElementById('cat_id').value);
                        error = errUpdate;
                    } else {
                        const { error: errInsert } = await window.supabaseClient.from('categories').insert([insertData]);
                        error = errInsert;
                    }

                    if(error) throw error;
                    
                    catAlertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                    
                    catAlertBox.textContent = isUpdate ? "Kategori berhasil diupdate!" : "Kategori berhasil dibuat!";
                    window.showToast(isUpdate ? 'Kategori berhasil diupdate!' : 'Kategori baru berhasil dibuat!');
                    if(isUpdate) btnCancelCat.click();
                    loadKategoriList();

                    formCat.reset();
                    loadDestinationsForCategory();
                } catch(e) {
                    catAlertBox.className = "block mt-2 p-3 rounded text-sm text-red-700 bg-red-100 font-bold";
                    catAlertBox.textContent = "Error: " + e.message;
                } finally {
                    btnSubmitCat.disabled = false; btnSubmitCat.textContent = "Buat Kategori";
                }
            });
        }

        // Submit Assign Destination
        const formAssign = document.getElementById('form-assign-cat-dest');
        if(formAssign) {
            formAssign.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btnAssign = document.getElementById('btn-submit-assign');
                const assignAlertBox = document.getElementById('assign-alert-box');
                btnAssign.disabled = true; btnAssign.textContent = "Menautkan...";
                
                try {
                    const insertData = {
                        category_id: document.getElementById('assign_cat_id').value,
                        destination_id: document.getElementById('assign_dest_id').value
                    };

                    const { error } = await window.supabaseClient.from('category_destinations').insert([insertData]);
                    if(error) {
                        if(error.code === '23505') throw new Error("Destinasi sudah ada di kategori ini.");
                        throw error;
                    }
                    
                    assignAlertBox.className = "block mt-2 p-3 rounded text-sm text-green-700 bg-green-100 font-bold";
                    assignAlertBox.textContent = "Berhasil menautkan destinasi ke kategori!";
                    window.showToast('Berhasil menautkan destinasi ke kategori!');
                    formAssign.reset();
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