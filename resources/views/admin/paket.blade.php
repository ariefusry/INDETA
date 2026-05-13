
@extends('admin.layouts.app')
@section('content')
<div class="p-8">
    <div id="view-tour_packages" class="block">
        
        <!-- Form Container -->
        <div id="form-container" class="hidden bg-[white] rounded-b-2xl rounded-tr-2xl shadow-xl p-6 md:p-10 border border-[gray-200]/30">
            <div class="mb-6 flex items-center">
                <button type="button" id="btn-back" class="flex items-center text-[#6c853d] hover:text-[#819E4A] font-bold text-lg transition-colors">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
            </div>
            <h2 id="paket-form-title" class="text-3xl font-bold text-[#819E4A] mb-8">Tambah Paket Baru</h2>

            <form id="form-add-paket" class="space-y-6 max-w-3xl">
                <input type="hidden" id="paket_id">
                
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Pilih Destinasi</label>
                    <select id="paket_dest_id" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                        <option value="" disabled selected>Memuat destinasi...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Judul Paket</label>
                    <input type="text" id="paket_title" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Harga (Rp)</label>
                    <input type="number" id="paket_price" required min="0" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">List Harga (Opsional - JSON/Text)</label>
                    <textarea id="paket_price_list" rows="3" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30" placeholder='Misal: {"Domestik": 100000, "Mancanegara": 200000}'></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Upload Gambar Paket</label>
                    <input type="file" id="paket_image" accept="image/*" class="w-full text-sm">
                            <div id="paket_image_preview_container" class="hidden mt-2">
                                <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                                <img id="paket_image_preview" src="" class="h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar saat edit.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Deskripsi Paket</label>
                    <textarea id="paket_desc" rows="4" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30"></textarea>
                </div>

                <div id="paket-alert-box" class="hidden p-4 rounded-xl text-sm font-semibold"></div>
                
                <button type="submit" id="btn-submit-paket" class="px-8 py-3 bg-[#819E4A] hover:bg-[#6c853d] text-white rounded-xl font-bold w-full transition-colors text-lg shadow-lg">Buat Paket</button>
            </form>
        </div>

        <!-- Table Container -->
        <div id="table-container" class="mt-12 bg-white rounded-2xl shadow-xl p-6 border border-[gray-200]/30">
            <!-- Table 1: Daftar Paket -->
            <div class="flex justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
                <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Paket</h2>
                <button type="button" id="paket-btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d] transition-all">+ Tambah Paket</button>
            </div>
            <div class="overflow-x-auto mb-12">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Judul Paket</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="paket-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="4" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Table 2: Daftar Tautan Destinasi -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 border-b-2 border-[gray-200]/30 pb-4">
                <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Tautan Destinasi</h2>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <span class="text-sm font-bold text-gray-500">Filter Destinasi:</span>
                    <select id="filter-paket-dest" class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all min-w-[200px]">
                        <option value="all">Semua Destinasi</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">Paket</th>
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
    document.addEventListener('DOMContentLoaded', () => {
        const formContainer = document.getElementById('form-container');
        const tableContainer = document.getElementById('table-container');
        const btnAddNew = document.getElementById('paket-btn-add-new');
        const btnBack = document.getElementById('btn-back');
        const formPaket = document.getElementById('form-add-paket');
        const formTitle = document.getElementById('paket-form-title');
        const btnSubmit = document.getElementById('btn-submit-paket');
        const alertBox = document.getElementById('paket-alert-box');

        // Load Destinations for Dropdown
        async function loadDestinations() {
            const selectDest = document.getElementById('paket_dest_id');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('destinations').select('id, name').order('name');
                if (error) throw error;
                if (data) {
                    selectDest.innerHTML = '<option value="" disabled selected>Pilih salah satu destinasi...</option>';
                    const filterSelect = document.getElementById('filter-paket-dest');
                    if (filterSelect) filterSelect.innerHTML = '<option value="all">Semua Destinasi</option>';
                    
                    data.forEach(d => {
                        selectDest.appendChild(new Option(d.name, d.id));
                        if (filterSelect) filterSelect.appendChild(new Option(d.name, d.id));
                    });
                }
            } catch (err) {
                console.error("Load Destinations Error:", err);
                selectDest.innerHTML = '<option value="" disabled selected>Gagal memuat destinasi</option>';
            }
        }

        // Load Paket List
        async function loadPaketList() {
            const tbody = document.getElementById('paket-table-body');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('tour_packages')
                    .select('*')
                    .order('created_at', { ascending: false });
                
                if (error) throw error;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-500">Belum ada data paket</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                data.forEach(d => {
                    const priceFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(d.price || 0);
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 text-gray-400 text-xs font-mono">${d.id}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">${d.title}</td>
                        <td class="px-4 py-3 text-gray-600">${priceFormatted}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick='editPaket(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deletePaket('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Paket Error:", err);
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
            }
        }

        async function loadAssignList() {
            const tbody = document.getElementById('assign-table-body');
            const filterDestId = document.getElementById('filter-paket-dest')?.value || 'all';

            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                
                let query = window.supabaseClient.from('tour_packages')
                    .select('id, title, destination_id, destinations(name)');
                
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
                    if (!d.destination_id) return; // Skip if no link
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 font-medium text-gray-900">${d.title}</td>
                        <td class="px-4 py-3 text-gray-500">${d.destinations ? d.destinations.name : '-'}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick="unassignDest('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus Tautan</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Assign Error:", err);
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-red-500 py-4">Gagal memuat tautan: ${err.message}</td></tr>`;
            }
        }

        window.unassignDest = async function(id) {
            window.confirmDelete('Yakin ingin melepas tautan destinasi dari paket ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('tour_packages').update({ destination_id: null }).eq('id', id);
                    if (error) throw error;
                    loadAssignList();
                    loadPaketList();
                } catch (err) {
                    alert('Gagal melepas tautan: ' + err.message);
                }
            });
        };

        function showAlert(msg, isError) {
            alertBox.textContent = msg;
            alertBox.className = `p-4 rounded-xl text-sm font-semibold mb-4 block ${isError ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}`;
            setTimeout(() => { alertBox.classList.add('hidden'); }, 5000);
        }

        // Toggle Views
        btnAddNew.addEventListener('click', () => {
                        document.getElementById('paket_image_preview_container').classList.add('hidden');
formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            formPaket.reset();
                document.getElementById('paket_id').value = '';
                document.getElementById('paket_image_preview_container').classList.add('hidden');
            formTitle.textContent = 'Tambah Paket Baru';
            btnSubmit.textContent = 'Buat Paket';
            alertBox.classList.add('hidden');
        });

        btnBack.addEventListener('click', () => {
            formContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
            formPaket.reset();
                document.getElementById('paket_id').value = '';
                document.getElementById('paket_image_preview_container').classList.add('hidden');
        });

        // Submit Form
        formPaket.addEventListener('submit', async (e) => {
            e.preventDefault();
            btnSubmit.disabled = true;
            btnSubmit.textContent = 'Menyimpan...';

            const id = document.getElementById('paket_id').value;
            const dest_id = document.getElementById('paket_dest_id').value;
            const title = document.getElementById('paket_title').value;
            const price = document.getElementById('paket_price').value;
            const price_list = document.getElementById('paket_price_list').value;
            const desc = document.getElementById('paket_desc').value;
            const fileInput = document.getElementById('paket_image');

            if (!dest_id) {
                showAlert('Pilih destinasi terlebih dahulu', true);
                btnSubmit.disabled = false;
                btnSubmit.textContent = id ? 'Update Paket' : 'Buat Paket';
                return;
            }

            let imageUrl = null;

            try {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const fileExt = file.name.split('.').pop();
                    const fileName = `paket-${Date.now()}.${fileExt}`;
                    const { data: uploadData, error: uploadError } = await window.supabaseClient.storage
                        .from('tour_packages')
                        .upload(fileName, file);
                    if (uploadError) throw new Error('Gagal upload gambar: ' + uploadError.message);
                    
                    imageUrl = fileName;
                }

                const payload = {
                    destination_id: dest_id,
                    title: title,
                    price: price,
                    description: desc,
                    price_list: price_list || null
                };

                if (imageUrl) payload.image_url = imageUrl;

                let actionError;
                if (id) {
                    const { error } = await window.supabaseClient.from('tour_packages').update(payload).eq('id', id);
                    actionError = error;
                } else {
                    const { error } = await window.supabaseClient.from('tour_packages').insert([payload]);
                    actionError = error;
                }

                if (actionError) throw new Error(actionError.message);

                showAlert('Paket berhasil disimpan!', false);
                formPaket.reset();
                document.getElementById('paket_id').value = '';
                document.getElementById('paket_image_preview_container').classList.add('hidden');
                loadPaketList();
                loadAssignList();
                
                setTimeout(() => {
                    formContainer.classList.add('hidden');
                    tableContainer.classList.remove('hidden');
                }, 1000);

            } catch (err) {
                showAlert(err.message, true);
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.textContent = id ? 'Update Paket' : 'Buat Paket';
            }
        });

        // Edit Function
        window.editPaket = function(d) {
            if (d.image_url) {
                let finalUrl = d.image_url;
                if (!finalUrl.startsWith('http')) {
                    const { data } = window.supabaseClient.storage.from('tour_packages').getPublicUrl(d.image_url);
                    finalUrl = data.publicUrl;
                }
                document.getElementById('paket_image_preview').src = finalUrl;
                document.getElementById('paket_image_preview_container').classList.remove('hidden');
            } else {
                document.getElementById('paket_image_preview_container').classList.add('hidden');
            }
            document.getElementById('paket_id').value = d.id;
            document.getElementById('paket_dest_id').value = d.destination_id || '';
            document.getElementById('paket_title').value = d.title || '';
            document.getElementById('paket_price').value = d.price || '';
            document.getElementById('paket_price_list').value = d.price_list || '';
            document.getElementById('paket_desc').value = d.description || '';
            
            formTitle.textContent = 'Edit Paket';
            btnSubmit.textContent = 'Update Paket';
            alertBox.classList.add('hidden');
            
            formContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        // Delete Function
        window.deletePaket = function(id) {
            console.log("Menghapus paket ID:", id);
            window.confirmDelete('Yakin menghapus paket ini?', async () => {
                try {
                    const { error } = await window.supabaseClient.from('tour_packages').delete().eq('id', id);
                    if(error) throw error;
                    alert('Berhasil dihapus');
                    loadPaketList();
                } catch (err) {
                    console.error("Gagal menghapus paket:", err);
                    alert('Gagal menghapus: ' + err.message);
                }
            });
        };

        // Initialize
        // Initialize
        loadDestinations();
        loadPaketList();
        loadAssignList();

        // Filter Listener
        const filterSelect = document.getElementById('filter-paket-dest');
        if (filterSelect) {
            filterSelect.addEventListener('change', () => {
                loadAssignList();
            });
        }
    });
</script>
@endsection
