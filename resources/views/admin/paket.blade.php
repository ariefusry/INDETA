
@extends('admin.layouts.app')
@section('content')
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
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Judul Paket</label>
                    <input type="text" id="paket_title" required class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                </div>

                <!-- Dynamic Price List -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-2">Daftar Harga <span class="text-red-500">*</span></label>
                    <p class="text-xs text-gray-500 mb-3">Tambahkan satu atau lebih item harga. Contoh: "Tiket Dewasa" — 50000</p>
                    <div id="price-list-items" class="space-y-3">
                        <!-- Price items will be added here dynamically -->
                    </div>
                    <button type="button" id="btn-add-price-item" class="mt-3 px-4 py-2 bg-green-50 text-green-700 border border-green-200 rounded-xl font-bold text-sm hover:bg-green-100 transition-colors flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Tambah Item Harga</span>
                    </button>
                </div>

                <!-- Range Harga (Opsional) -->
                <div>
                    <label class="block text-sm font-bold text-[#6c853d] mb-1">Range Harga (Opsional)</label>
                    <p class="text-xs text-gray-500 mb-2">Ditampilkan sebagai kisaran harga di halaman publik. Kosongkan jika tidak diperlukan.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Harga Minimum (Rp)</label>
                            <input type="number" id="paket_price_min" min="0" placeholder="0" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Harga Maksimum (Rp)</label>
                            <input type="number" id="paket_price_max" min="0" placeholder="0" class="w-full px-4 py-2 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30">
                        </div>
                    </div>
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
            <div class="flex justify-between items-center mb-2 border-b-2 border-[gray-200]/30 pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-[#819E4A]">Daftar Paket</h2>
                    <p class="text-xs text-gray-500 mt-1">Setiap destinasi bisa memiliki lebih dari satu paket wisata.</p>
                </div>
                <button type="button" id="paket-btn-add-new" class="px-6 py-2 bg-[#819E4A] text-white rounded-lg font-bold hover:bg-[#6c853d] transition-all">+ Tambah Paket</button>
            </div>
            <div class="overflow-x-auto mb-12">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[gray-100] text-[#6c853d]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Judul Paket</th>
                            <th class="px-4 py-3">Destinasi</th>
                            <th class="px-4 py-3">Daftar Harga</th>
                            <th class="px-4 py-3">Range Harga</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="paket-table-body" class="divide-y divide-gray-200">
                        <tr><td colspan="6" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Mapping Section -->
            <div class="mt-10 bg-[gray-100]/30 p-6 rounded-2xl border border-[gray-200]/50">
                <h3 class="text-xl font-bold text-[#6c853d] mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Hubungkan Paket dengan Destinasi
                </h3>
                <p class="text-xs text-gray-500 mb-4">Pilih paket dan destinasi yang ingin dihubungkan.</p>
                <form id="form-assign-paket-dest" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Pilih Paket</label>
                        <select id="assign_paket_id" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all">
                            <option value="" disabled selected>Memuat paket...</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#6c853d] mb-2">Pilih Destinasi</label>
                        <select id="assign_paket_dest_id" required class="w-full px-4 py-2.5 bg-white border border-[gray-200] rounded-xl focus:ring-2 focus:ring-[#819E4A]/30 outline-none transition-all">
                            <option value="" disabled selected>Memuat destinasi...</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" id="btn-submit-assign-paket" class="px-6 py-2.5 bg-green-700 hover:bg-green-800 text-white rounded-xl font-bold w-full transition-all shadow-md shadow-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tautkan Sekarang
                        </button>
                    </div>
                    <div id="assign-paket-alert-box" class="hidden md:col-span-2 lg:col-span-3 p-3 rounded-lg text-sm mt-2 font-medium"></div>
                </form>
            </div>

            <!-- Table 2: Daftar Tautan Destinasi -->
            <div class="flex flex-col md:flex-row justify-between items-center mt-8 mb-6 border-b-2 border-[gray-200]/30 pb-4">
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

        // === Dynamic Price List Builder ===
        let priceItemCounter = 0;
        function addPriceItem(name = '', price = '') {
            priceItemCounter++;
            const container = document.getElementById('price-list-items');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 price-row';
            row.id = 'price-row-' + priceItemCounter;
            row.innerHTML = `
                <span class="text-gray-400 font-bold text-sm w-6 text-center">${container.children.length + 1}.</span>
                <input type="text" placeholder="Nama item (cth: Tiket Dewasa)" value="${name}" class="price-name flex-1 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#819E4A]/30 outline-none">
                <input type="number" placeholder="Harga (Rp)" value="${price}" min="0" class="price-value w-36 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#819E4A]/30 outline-none">
                <button type="button" onclick="this.closest('.price-row').remove(); renumberPriceItems()" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus item">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            container.appendChild(row);
        }
        window.renumberPriceItems = function() {
            document.querySelectorAll('#price-list-items .price-row').forEach((row, i) => {
                row.querySelector('span').textContent = (i + 1) + '.';
            });
        };
        function getPriceList() {
            const items = [];
            document.querySelectorAll('#price-list-items .price-row').forEach(row => {
                const name = row.querySelector('.price-name').value.trim();
                const price = row.querySelector('.price-value').value.trim();
                if (name || price) items.push({ name: name, price: price ? Number(price) : 0 });
            });
            return items;
        }
        function clearPriceList() {
            document.getElementById('price-list-items').innerHTML = '';
            priceItemCounter = 0;
        }
        function populatePriceList(list) {
            clearPriceList();
            if (Array.isArray(list)) {
                list.forEach(item => addPriceItem(item.name || '', item.price || ''));
            }
        }
        document.getElementById('btn-add-price-item').addEventListener('click', () => addPriceItem());
        // Start with one empty row
        addPriceItem();

        // Load Destinations for Dropdowns
        async function loadDestinations() {
            const assignDestSelect = document.getElementById('assign_paket_dest_id');
            const filterSelect = document.getElementById('filter-paket-dest');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('destinations').select('id, name').order('name');
                if (error) throw error;
                if (data) {
                    assignDestSelect.innerHTML = '<option value="" disabled selected>Pilih salah satu destinasi...</option>';
                    if (filterSelect) filterSelect.innerHTML = '<option value="all">Semua Destinasi</option>';
                    
                    data.forEach(d => {
                        assignDestSelect.appendChild(new Option(d.name, d.id));
                        if (filterSelect) filterSelect.appendChild(new Option(d.name, d.id));
                    });
                }
            } catch (err) {
                console.error("Load Destinations Error:", err);
                assignDestSelect.innerHTML = '<option value="" disabled selected>Gagal memuat destinasi</option>';
            }
        }

        // Load Paket for Assign Dropdown
        async function loadPaketDropdown() {
            const selectPaket = document.getElementById('assign_paket_id');
            try {
                const { data } = await window.supabaseClient.from('tour_packages').select('id, title').order('title');
                if (data) {
                    selectPaket.innerHTML = '<option value="" disabled selected>Pilih salah satu paket...</option>';
                    data.forEach(d => selectPaket.appendChild(new Option(d.title, d.id)));
                }
            } catch (err) {
                selectPaket.innerHTML = '<option value="" disabled selected>Gagal memuat paket</option>';
            }
        }

        // Load Paket List
        async function loadPaketList() {
            const tbody = document.getElementById('paket-table-body');
            try {
                if (!window.supabaseClient) throw new Error("Supabase client belum siap.");
                const { data, error } = await window.supabaseClient.from('tour_packages')
                    .select('*, destinations(name)')
                    .order('created_at', { ascending: false });
                
                if (error) throw error;
                if (!data || data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-gray-500">Belum ada data paket</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                data.forEach(d => {
                    // Build price list display
                    let priceListHtml = '<span class="text-gray-400 italic">-</span>';
                    if (Array.isArray(d.price_list) && d.price_list.length > 0) {
                        priceListHtml = d.price_list.map(p => {
                            const fp = !isNaN(p.price) ? 'Rp ' + Number(p.price).toLocaleString('id-ID') : p.price;
                            return `<div class="flex justify-between text-xs py-0.5"><span class="text-gray-700">${p.name || '-'}</span><span class="font-bold text-emerald-700 ml-2">${fp}</span></div>`;
                        }).join('');
                    }
                    
                    // Build range display
                    let rangeHtml = '<span class="text-gray-400 italic text-xs">Tidak diset</span>';
                    if (d.price_min && d.price_max) {
                        rangeHtml = `<span class="text-xs font-semibold text-blue-700">Rp ${Number(d.price_min).toLocaleString('id-ID')} — Rp ${Number(d.price_max).toLocaleString('id-ID')}</span>`;
                    }
                    
                    const destName = d.destinations ? d.destinations.name : '<span class="text-gray-400 italic">Belum ditautkan</span>';
                    
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50';
                    tr.innerHTML = `
                        <td class="px-4 py-3 text-gray-400 text-xs font-mono">${d.id}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">${d.title}</td>
                        <td class="px-4 py-3 text-sm">${destName}</td>
                        <td class="px-4 py-3 min-w-[200px]">${priceListHtml}</td>
                        <td class="px-4 py-3">${rangeHtml}</td>
                        <td class="px-4 py-3 space-x-2">
                            <button onclick='editPaket(${JSON.stringify(d).replace(/'/g, "&#39;")})' class="text-blue-600 hover:text-blue-800 font-bold">Edit</button>
                            <button onclick="deletePaket('${d.id}')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                console.error("Load Paket Error:", err);
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
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
                    window.showToast('Gagal melepas tautan: ' + err.message, true);
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
            document.getElementById('paket_price_min').value = '';
            document.getElementById('paket_price_max').value = '';
            clearPriceList();
            addPriceItem();
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
            const title = document.getElementById('paket_title').value;
            const priceList = getPriceList();
            const priceMin = document.getElementById('paket_price_min').value;
            const priceMax = document.getElementById('paket_price_max').value;
            const desc = document.getElementById('paket_desc').value;
            const fileInput = document.getElementById('paket_image');

            if (priceList.length === 0) {
                showAlert('Tambahkan minimal 1 item harga', true);
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

                // Use the lowest price from price list as the main price
                const mainPrice = priceList.length > 0 ? Math.min(...priceList.map(p => p.price)) : 0;

                const payload = {
                    title: title,
                    price: mainPrice,
                    description: desc,
                    price_list: priceList,
                    price_min: priceMin ? Number(priceMin) : null,
                    price_max: priceMax ? Number(priceMax) : null
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
                clearPriceList();
                addPriceItem();
                document.getElementById('paket_price_min').value = '';
                document.getElementById('paket_price_max').value = '';
                loadPaketList();
                loadPaketDropdown();
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
            document.getElementById('paket_title').value = d.title || '';
            document.getElementById('paket_desc').value = d.description || '';
            document.getElementById('paket_price_min').value = d.price_min || '';
            document.getElementById('paket_price_max').value = d.price_max || '';
            
            // Populate dynamic price list
            if (d.price_list && Array.isArray(d.price_list)) {
                populatePriceList(d.price_list);
            } else {
                clearPriceList();
                addPriceItem();
            }
            
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
                    window.showToast('Paket berhasil dihapus!');
                    loadPaketList();
                    loadPaketDropdown();
                } catch (err) {
                    console.error("Gagal menghapus paket:", err);
                    window.showToast('Gagal menghapus: ' + err.message, true);
                }
            });
        };

        // Assign Paket to Destination
        const formAssignPaket = document.getElementById('form-assign-paket-dest');
        if (formAssignPaket) {
            formAssignPaket.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btnAssign = document.getElementById('btn-submit-assign-paket');
                const alertBox2 = document.getElementById('assign-paket-alert-box');
                btnAssign.disabled = true; btnAssign.textContent = 'Menautkan...';
                try {
                    const paketId = document.getElementById('assign_paket_id').value;
                    const destId = document.getElementById('assign_paket_dest_id').value;
                    if (!paketId || !destId) throw new Error('Pilih paket dan destinasi');
                    
                    const { error } = await window.supabaseClient.from('tour_packages').update({ destination_id: destId }).eq('id', paketId);
                    if (error) throw error;
                    
                    alertBox2.className = 'block md:col-span-2 lg:col-span-3 p-3 rounded-lg text-sm mt-2 font-medium bg-green-100 text-green-700';
                    alertBox2.textContent = 'Berhasil menautkan paket ke destinasi!';
                    window.showToast('Berhasil menautkan paket ke destinasi!');
                    formAssignPaket.reset();
                    loadAssignList();
                    loadPaketList();
                } catch (err) {
                    alertBox2.className = 'block md:col-span-2 lg:col-span-3 p-3 rounded-lg text-sm mt-2 font-medium bg-red-100 text-red-700';
                    alertBox2.textContent = 'Error: ' + err.message;
                } finally {
                    btnAssign.disabled = false; btnAssign.textContent = 'Tautkan Sekarang';
                }
            });
        }

        // Initialize
        loadDestinations();
        loadPaketList();
        loadPaketDropdown();
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
