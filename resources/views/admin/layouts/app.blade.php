<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Admin Dashboard - INDETA</title>
    @vite('resources/css/app.css')
    <!-- Supabase Logic -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        const SUPABASE_URL = @json(config('services.supabase.url'));
        const SUPABASE_ANON_KEY = @json(config('services.supabase.key'));
        window.supabaseClient = null;

        function initSupabase() {
            try {
                if (window.supabase) {
                    window.supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
                    console.log("Supabase initialized successfully.");
                } else {
                    console.error("Supabase library not found. Check CDN.");
                }
            } catch (err) {
                console.error("Error initializing Supabase:", err);
            }
        }
        
        initSupabase();
        
        async function checkSession() {
            if (!window.supabaseClient) {
                console.warn("Supabase client not initialized, skipping session check.");
                return;
            }
            try {
                const { data, error } = await window.supabaseClient.auth.getSession();
                if (error || !data.session) {
                    window.location.href = '/login.html';
                }
            } catch (err) {
                console.error("Session check failed:", err);
            }
        }
        checkSession();
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col md:flex-row">
    
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-[#819E4A] text-gray-900 shadow-md flex-shrink-0">
        <div class="p-6 text-center border-b border-black/10">
            <span class="font-extrabold text-2xl tracking-wider text-gray-900">AdminPanel</span>
        </div>
        <nav class="p-4 space-y-2 font-medium">
            <a href="/admin-dashboard" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">🏠 Dashboard</a>
            <a href="/admin-dashboard/destinasi" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard/destinasi') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">🏖️ Kelola Destinasi</a>
            <a href="/admin-dashboard/kategori" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard/kategori') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">📁 Kelola Kategori</a>
            <a href="/admin-dashboard/artikel" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard/artikel') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">📝 Kelola Artikel</a>
            <a href="/admin-dashboard/umkm" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard/umkm') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">🏪 Kelola UMKM</a>
            <a href="/admin-dashboard/paket" class="block px-4 py-2 rounded-lg transition-all {{ request()->is('admin-dashboard/paket') ? 'bg-[#6c853d] text-white shadow-sm' : 'hover:bg-[#6c853d]/50 text-gray-900 hover:text-black' }}">📦 Kelola Paket</a>
        </nav>
        <div class="px-4 mt-8 pb-8">
            <button type="button" id="global-btn-logout" class="block w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all font-bold shadow-md">Logout</button>
            <a href="/" class="block w-full px-4 py-2 mt-2 bg-white/20 hover:bg-white/30 text-gray-900 text-center rounded-lg transition-all font-bold border border-black/10">Lihat Web</a>
        </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 w-full bg-[#fdfbf7]">
        @yield('content')
    </main>

    <!-- Custom Confirm Modal -->
    <div id="custom-confirm-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 bg-white/20 backdrop-blur-md transition-all duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-95 opacity-0 duration-300 border border-white/50" id="confirm-modal-box">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 14c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2" id="confirm-title">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-center mb-6" id="confirm-message">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex space-x-3">
                <button id="confirm-cancel" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">Batal</button>
                <button id="confirm-ok" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('global-btn-logout').addEventListener('click', async () => {
            if (window.supabaseClient) {
                await window.supabaseClient.auth.signOut();
                window.location.href = '/login.html';
            }
        });

        // Custom Confirm Logic
        window.confirmDelete = function(message, callback) {
            const modal = document.getElementById('custom-confirm-modal');
            const box = document.getElementById('confirm-modal-box');
            const msgEl = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok');
            const cancelBtn = document.getElementById('confirm-cancel');

            msgEl.textContent = message;
            modal.classList.remove('hidden');
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 10);

            const close = () => {
                box.classList.add('scale-95', 'opacity-0');
                box.classList.remove('scale-100', 'opacity-100');
                setTimeout(() => modal.classList.add('hidden'), 200);
            };

            okBtn.onclick = () => { close(); callback(); };
            cancelBtn.onclick = () => { close(); };
            modal.onclick = (e) => { if(e.target === modal) close(); };
        };
    </script>
    @yield('scripts')
</body>
</html>