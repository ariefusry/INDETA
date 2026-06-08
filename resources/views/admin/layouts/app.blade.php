<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>@yield('title', 'Admin Dashboard') - INDETA</title>
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
                }
            } catch (err) {
                console.error("Error initializing Supabase:", err);
            }
        }
        initSupabase();
        
        async function checkSession() {
            if (!window.supabaseClient) return;
            try {
                const { data, error } = await window.supabaseClient.auth.getSession();
                if (error || !data.session) {
                    window.location.href = '/login';
                    return;
                }
                
                // Extra check for admin role
                const { data: roleData } = await window.supabaseClient
                    .from('users')
                    .select('role')
                    .eq('email', data.session.user.email)
                    .maybeSingle();
                
                if(!roleData || roleData.role !== 'admin') {
                   window.location.href = '/';
                }
            } catch (err) {
                console.error("Session check failed:", err);
            }
        }
        checkSession();
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col md:flex-row overflow-x-hidden">
    
    <!-- Mobile Header -->
    <header class="md:hidden bg-[#819E4A] text-white p-4 flex justify-between items-center sticky top-0 z-[60] shadow-md">
        <span class="font-bold text-xl tracking-tight">INDETA Admin</span>
        <button id="admin-mobile-menu-btn" class="p-2 focus:outline-none bg-black/10 rounded-lg">
            <svg id="admin-menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            <svg id="admin-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </header>

    <!-- Sidebar Overlay -->
    <div id="admin-sidebar-overlay" class="fixed inset-0 bg-black/50 z-[55] hidden transition-opacity duration-300"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-[#819E4A] text-gray-900 shadow-xl flex-shrink-0 z-[56] transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
        <div class="p-8 text-center border-b border-black/10">
            <span class="font-black text-3xl tracking-tighter text-gray-900">INDETA</span>
            <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-900/60 mt-1">Admin Panel</p>
        </div>
        
        <nav class="p-4 space-y-1 font-semibold flex-1 overflow-y-auto mt-4">
            <a href="/admin-dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">🏠</span>
                <span>Dashboard</span>
            </a>
            <a href="/admin-dashboard/destinasi" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard/destinasi') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">🏖️</span>
                <span>Destinasi</span>
            </a>
            <a href="/admin-dashboard/kategori" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard/kategori') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">📁</span>
                <span>Kategori</span>
            </a>
            <a href="/admin-dashboard/artikel" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard/artikel') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">📝</span>
                <span>Artikel</span>
            </a>
            <a href="/admin-dashboard/umkm" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard/umkm') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">🏪</span>
                <span>UMKM</span>
            </a>
            <a href="/admin-dashboard/paket" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin-dashboard/paket') ? 'bg-white text-[#819E4A] shadow-lg' : 'hover:bg-white/20 text-gray-900' }}">
                <span class="text-xl">📦</span>
                <span>Paket</span>
            </a>
        </nav>

        <div class="p-4 border-t border-black/10 space-y-2">
            <a href="/" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-white/20 hover:bg-white/30 text-gray-900 rounded-xl transition-all font-bold border border-black/10">
                <span>🌐</span>
                <span>Lihat Web</span>
            </a>
            <button type="button" id="global-btn-logout" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl transition-all font-bold shadow-lg shadow-red-900/20">
                <span>🚪</span>
                <span>Logout</span>
            </button>
        </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 w-full bg-[#fdfbf7] min-h-screen relative">
        <div class="p-4 md:p-8">
            @yield('content')
        </div>
    </main>

    <!-- Custom Confirm Modal -->
    <div id="custom-confirm-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 bg-black/20 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-95 opacity-0 duration-300 border border-gray-100" id="confirm-modal-box">
            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-50 rounded-full mb-6">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 14c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-2" id="confirm-title">Konfirmasi Hapus</h3>
            <p class="text-gray-500 text-center mb-8 leading-relaxed" id="confirm-message">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex space-x-4">
                <button id="confirm-cancel" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition-all">Batal</button>
                <button id="confirm-ok" class="flex-1 px-6 py-3 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- Global Toast Notification -->
    <div id="global-toast" class="fixed inset-0 z-[10000] hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm transition-all duration-300">
        <div id="toast-box" class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all scale-95 opacity-0 duration-300 border border-gray-100 text-center">
            <div id="toast-icon-container" class="flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5">
                <!-- Success Icon -->
                <svg id="toast-icon-success" class="w-10 h-10 text-green-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
                <!-- Error Icon -->
                <svg id="toast-icon-error" class="w-10 h-10 text-red-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h3 id="toast-title" class="text-xl font-bold text-gray-900 mb-2">Berhasil!</h3>
            <p id="toast-message" class="text-gray-500 text-sm leading-relaxed"></p>
        </div>
    </div>

    <script>
        const mobileMenuBtn = document.getElementById('admin-mobile-menu-btn');
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-sidebar-overlay');
        const menuIcon = document.getElementById('admin-menu-icon');
        const closeIcon = document.getElementById('admin-close-icon');

        if(mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = !sidebar.classList.contains('-translate-x-full');
                if (isOpen) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                } else {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            });
        }

        overlay?.addEventListener('click', () => mobileMenuBtn.click());

        document.getElementById('global-btn-logout').addEventListener('click', async () => {
            if (window.supabaseClient) {
                await window.supabaseClient.auth.signOut();
                window.location.href = '/login';
            }
        });

        // Custom Confirm Logic
        window.confirmDelete = function(message, callback) {
            const modal = document.getElementById('custom-confirm-modal');
            const box = document.getElementById('confirm-modal-box');
            const msgEl = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok');
            const cancelBtn = document.getElementById('confirm-cancel');

            msgEl.textContent = message || "Apakah Anda yakin?";
            modal.classList.remove('hidden');
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
            }, 10);

            const close = () => {
                box.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            };

            okBtn.onclick = () => { close(); callback(); };
            cancelBtn.onclick = close;
        };

        // Global Toast Notification
        window.showToast = function(message, isError = false, duration = 2500) {
            const toast = document.getElementById('global-toast');
            const box = document.getElementById('toast-box');
            const iconContainer = document.getElementById('toast-icon-container');
            const successIcon = document.getElementById('toast-icon-success');
            const errorIcon = document.getElementById('toast-icon-error');
            const title = document.getElementById('toast-title');
            const msg = document.getElementById('toast-message');

            // Configure appearance
            if (isError) {
                iconContainer.className = 'flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5 bg-red-50';
                successIcon.classList.add('hidden');
                errorIcon.classList.remove('hidden');
                title.textContent = 'Gagal!';
                title.className = 'text-xl font-bold text-red-700 mb-2';
            } else {
                iconContainer.className = 'flex items-center justify-center w-20 h-20 mx-auto rounded-full mb-5 bg-green-50';
                errorIcon.classList.add('hidden');
                successIcon.classList.remove('hidden');
                title.textContent = 'Berhasil!';
                title.className = 'text-xl font-bold text-green-700 mb-2';
            }
            msg.textContent = message;

            // Show
            toast.classList.remove('hidden');
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
            }, 10);

            // Auto-close
            setTimeout(() => {
                box.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);
            }, duration);
        };
    </script>
    @yield('scripts')
</body>
</html>