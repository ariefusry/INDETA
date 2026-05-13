@extends('admin.layouts.app')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#819E4A]">Overview Sistem</h1>
        <p class="text-gray-500 mt-1">Ringkasan data platform INDETA.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
    loadStats();
</script>
@endsection