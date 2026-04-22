<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome To Indeta - Login</title>

  <!-- Memuat Bootstrap CSS dari CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Memuat icon FontAwesome untuk icon mata coret -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Memuat file CSS kustom untuk halaman login -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
</head>
<body class="min-vh-100 d-flex align-items-center justify-content-center position-relative m-0">

  <!-- Lapisan Gelap Transparan -->
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-overlay"></div>

  <!-- Kotak Konten Utama -->
  <div class="container position-relative text-center d-flex flex-column align-items-center" style="z-index: 2; max-width: 400px; padding: 2rem;">
    
    <!-- 1. Container Logo -->
    <div class="rounded-4 shadow-lg mb-4 px-4 py-3" style="background-color: #FFFFF0 !important; display: inline-block;">
      <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo Indeta" class="img-fluid" style="max-width: 160px; height: auto;">
    </div>

    <!-- 2. Judul -->
    <h1 class="text-white fw-bold mb-4 fs-2">Welcome To Indeta</h1>

    <form id="login-form" class="w-100 text-start">
      
      <!-- 3. Field Email -->
      <div class="mb-3">
        <label for="login-email" class="form-label text-white small mb-1">Email</label>
        <input type="email" id="login-email" name="email" class="form-control rounded-3 py-2 px-3" placeholder="example: indeta@gmail.com" required>
      </div>

      <!-- 4. Field Password dengan Ikon Mata (Input Group Bootstrap) -->
      <div class="mb-4">
        <label for="login-password" class="form-label text-white small mb-1">Password</label>
        <div class="input-group">
          <input type="password" id="login-password" name="password" class="form-control border-end-0 py-2 px-3" placeholder="enter your password" required style="border-start-start-radius: 0.5rem; border-end-start-radius: 0.5rem;">
          <span class="input-group-text bg-white border-start-0 pointer" id="toggle-icon-wrapper" onclick="togglePassword()" style="border-start-end-radius: 0.5rem; border-end-end-radius: 0.5rem;">
            <i class="fa-solid fa-eye-slash" id="toggle-icon"></i>
          </span>
        </div>
      </div>

      <!-- 5. Tombol Login Emas Membulat -->
      <button type="button" id="btn-login" onclick="window.handleLogin()" class="btn btn-gold rounded-pill fw-bold w-100 py-2 mt-2">Login</button>

    </form>

    <div id="status-message" class="mt-3 p-2 rounded-2 w-100 text-center text-white" style="display: none; font-size: 14px;"></div>

    <!-- 6. Teks Pendaftaran -->
    <p class="text-white mt-4 small">
      Belum punya akun? <a href="/register.html" class="text-white text-gold-hover fw-bold text-decoration-none">Daftar</a>
    </p>
  </div>

  <!-- Skrip Auth Supabase JS SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>  
  <script>
    const SUPABASE_URL = @json(env('SUPABASE_URL', ''));
    const SUPABASE_ANON_KEY = @json(env('SUPABASE_ANON_KEY', ''));

    let supabaseClient = null;

    if (window.supabase) {
      supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
    } else {
      console.error("GAGAL MEMUAT SUPABASE SDK DARI CDN!");
    }

    // Fungsi Toggle Mata Password
    window.togglePassword = function() {
      const passInput = document.getElementById('login-password');
      const eyeIcon = document.getElementById('toggle-icon');
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      } else {
        passInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      }
    };

    window.handleLogin = async function() {
      const loginEmail = document.getElementById('login-email').value.trim();   
      const loginPassword = document.getElementById('login-password').value;    
      const statusMessage = document.getElementById('status-message');
      const btnLogin = document.getElementById('btn-login');

      statusMessage.style.display = 'block'; // Tampilkan kotak pesan

      if (!loginEmail || !loginPassword) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)'; // Merah bootstrap (bg-danger)
        statusMessage.textContent = 'Harap isi Email dan Password terlebih dahulu!';
        return;
      }

      if (!supabaseClient) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
        statusMessage.textContent = 'Gagal: Konfigurasi Supabase bermasalah.';  
        return;
      }

      btnLogin.disabled = true;
      btnLogin.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i>Mengecek Data...';
      statusMessage.style.backgroundColor = 'rgba(13, 110, 253, 0.9)'; // Biru bootstrap (bg-primary)
      statusMessage.textContent = 'Mencocokkan kredensial...';

      try {
        // PROSES LOGIN
        const { data, error } = await supabaseClient.auth.signInWithPassword({  
          email: loginEmail,
          password: loginPassword
        });

        if (error) {
          statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
          statusMessage.textContent = 'Login Gagal: Email atau Password salah.';
          btnLogin.disabled = false;
          btnLogin.textContent = 'Login';
          return;
        }

        // --- PENGECEKAN ROLE ADMIN ---
        // Mengambil data role dari tabel "users" (public) berdasarkan email
        const { data: userData, error: roleError } = await supabaseClient
          .from('users')
          .select('role')
          .eq('email', data.user.email)
          .maybeSingle();

        if (roleError) {
          alert('Error ambil role: ' + roleError.message);
          console.error("Gagal mengambil role dari tabel users:", roleError);
        }

        // Paksa mengubah role menjadi huruf kecil sebelum dibandingkan
        const role = (userData?.role || data.user.user_metadata?.role || 'user').toLowerCase();

        if (role === 'admin') {
          // Jika ADMIN, arahkan ke dashboard admin
          statusMessage.style.backgroundColor = 'rgba(25, 135, 84, 0.9)'; // Hijau bootstrap
          statusMessage.textContent = 'Login Admin Berhasil! Mengalihkan...';
          btnLogin.textContent = 'Sukses Admin!';

          setTimeout(() => {
             window.location.href = '/admin-dashboard'; // Silakan sesuaikan dengan URL Admin kamu
          }, 1200);
        } else {
          // Jika USER BIASA, arahkan ke index/homepage
          statusMessage.style.backgroundColor = 'rgba(25, 135, 84, 0.9)'; // Hijau bootstrap
          statusMessage.textContent = 'Login Berhasil! Mengalihkan ke Homepage...';
          btnLogin.textContent = 'Sukses!';

          setTimeout(() => {
             window.location.href = '/index.html'; // Silakan sesuaikan dengan URL User biasa
          }, 1200);
        }

      } catch (err) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
        statusMessage.textContent = 'Error: ' + err.message;
        btnLogin.disabled = false;
        btnLogin.textContent = 'Login';
      }
    };
  </script>
</body>
</html>
