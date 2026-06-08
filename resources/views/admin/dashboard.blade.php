@extends('admin.layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#819E4A]">Overview Sistem</h1>
        <p class="text-gray-500 mt-1">Ringkasan data platform INDETA.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-blue-500">
            <h3 class="text-sm font-bold text-gray-500">Total Destinasi</h3>
            <p id="stat-destinasi" class="text-3xl font-extrabold text-blue-600 mt-2">...</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-green-500">
            <h3 class="text-sm font-bold text-gray-500">Total Kategori</h3>
            <p id="stat-kategori" class="text-3xl font-extrabold text-green-600 mt-2">...</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-purple-500">
            <h3 class="text-sm font-bold text-gray-500">Total Artikel</h3>
            <p id="stat-artikel" class="text-3xl font-extrabold text-purple-600 mt-2">...</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-orange-500">
            <h3 class="text-sm font-bold text-gray-500">Total UMKM</h3>
            <p id="stat-umkm" class="text-3xl font-extrabold text-orange-600 mt-2">...</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-yellow-500">
            <h3 class="text-sm font-bold text-gray-500">Total Paket</h3>
            <p id="stat-paket" class="text-3xl font-extrabold text-yellow-600 mt-2">...</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-indigo-500">
            <h3 class="text-sm font-bold text-gray-500">Total User</h3>
            <p id="stat-users" class="text-3xl font-extrabold text-indigo-600 mt-2">...</p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="mt-10 bg-white rounded-2xl shadow-xl p-6 border border-gray-200/30">
        <div class="flex justify-between items-center mb-6 border-b-2 border-gray-200/30 pb-4">
            <div>
                <h2 class="text-2xl font-bold text-[#819E4A]">Daftar User Terdaftar</h2>
                <p class="text-xs text-gray-500 mt-1">Semua pengguna yang telah mendaftar di platform INDETA.</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-[#6c853d]">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Tanggal Daftar</th>
                        <th class="px-4 py-3">Terakhir Update</th>
                    </tr>
                </thead>
                <tbody id="users-table-body" class="divide-y divide-gray-200">
                    <tr><td colspan="5" class="text-center py-4">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    async function loadStats() {
        try {
            if(!window.supabaseClient) throw new Error("Supabase client belum siap.");
            
            const [cDest, cArt, cUmkm, cCat, cPak] = await Promise.all([
                window.supabaseClient.from('destinations').select('*', { count: 'exact', head: true }),
                window.supabaseClient.from('articles').select('*', { count: 'exact', head: true }),
                window.supabaseClient.from('umkm_products').select('*', { count: 'exact', head: true }),
                window.supabaseClient.from('categories').select('*', { count: 'exact', head: true }),
                window.supabaseClient.from('tour_packages').select('*', { count: 'exact', head: true })
            ]);

            document.getElementById('stat-destinasi').textContent = cDest.count || 0;
            document.getElementById('stat-artikel').textContent = cArt.count || 0;
            document.getElementById('stat-umkm').textContent = cUmkm.count || 0;
            document.getElementById('stat-kategori').textContent = cCat.count || 0;
            document.getElementById('stat-paket').textContent = cPak.count || 0;
        } catch (err) {
            console.error("Load Stats Error:", err);
            ['stat-destinasi', 'stat-artikel', 'stat-umkm', 'stat-kategori', 'stat-paket'].forEach(id => {
                const el = document.getElementById(id);
                if(el) el.textContent = '!';
            });
        }
    }

    async function loadUsers() {
        const tbody = document.getElementById('users-table-body');
        const statEl = document.getElementById('stat-users');
        try {
            if(!window.supabaseClient) throw new Error("Supabase client belum siap.");

            // Query langsung ke public.users (tabel Laravel)
            const { data, error, count } = await window.supabaseClient
                .from('users')
                .select('id, name, email, created_at, updated_at, role', { count: 'exact' })
                .order('created_at', { ascending: false });

            if (error) throw error;

            statEl.textContent = count ?? (data ? data.length : 0);

            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada user terdaftar</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            data.forEach((user, idx) => {
                const createdAt = user.created_at
                    ? new Date(user.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })
                    : '-';
                const updatedAt = user.updated_at
                    ? new Date(user.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })
                    : '-';

                const roleBadge = user.role === 'admin'
                    ? `<span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">${user.role}</span>`
                    : `<span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">${user.role || 'user'}</span>`;

                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50';
                tr.innerHTML = `
                    <td class="px-4 py-3 text-gray-400 text-xs font-mono">${idx + 1}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">${user.name || '-'} ${roleBadge}</td>
                    <td class="px-4 py-3 text-gray-700">${user.email || '-'}</td>
                    <td class="px-4 py-3 text-gray-600 text-sm">${createdAt}</td>
                    <td class="px-4 py-3 text-gray-600 text-sm">${updatedAt}</td>
                `;
                tbody.appendChild(tr);
            });
        } catch (err) {
            console.error("Load Users Error:", err);
            statEl.textContent = '!';
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-red-500 py-4">Gagal memuat data: ${err.message}</td></tr>`;
        }
    }

    loadStats();
    loadUsers();
</script>
@endsection