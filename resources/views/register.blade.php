<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome To Indeta - Register</title>

  <!-- Memuat Bootstrap CSS dari CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Memuat icon FontAwesome untuk icon mata coret -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Memuat file CSS kustom khusus untuk halaman register -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
</head>
<body class="min-vh-100 d-flex align-items-center justify-content-center position-relative m-0">

  <!-- Lapisan Gelap Transparan -->
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-overlay"></div>

  <!-- Kotak Konten Utama -->
  <div class="container position-relative text-center d-flex flex-column align-items-center" style="z-index: 2; max-width: 400px; padding: 2rem;">
    
    <!-- 1. Container Logo Sama Seperti Login -->
    <div class="rounded-4 shadow-lg mb-4 px-4 py-3" style="background-color: #FFFFF0 !important; display: inline-block;">
      <img src="{{ asset('images/logo INdeta Fix.png') }}" alt="Logo Indeta" class="img-fluid" style="max-width: 160px; height: auto;">
    </div>

    <!-- 2. Judul -->
    <h1 class="text-white fw-bold mb-4 fs-2">Daftar Akun</h1>

    <form id="register-form" class="w-100 text-start" onsubmit="event.preventDefault(); window.handleRegister();">
      
      <!-- Field Full Name -->
      <div class="mb-3">
        <label for="register-name" class="form-label text-white small mb-1">Nama Lengkap</label>
        <input type="text" id="register-name" name="full_name" class="form-control rounded-3 py-2 px-3" placeholder="Masukkan nama lengkap" required>
      </div>

      <!-- Field Email -->
      <div class="mb-3">
        <label for="register-email" class="form-label text-white small mb-1">Email</label>
        <input type="email" id="register-email" name="email" class="form-control rounded-3 py-2 px-3" placeholder="example: indeta@gmail.com" required>
      </div>

      <!-- Field Password dengan Ikon Mata (Input Group Bootstrap) -->
      <div class="mb-3">
        <label for="register-password" class="form-label text-white small mb-1">Password</label>
        <div class="input-group">
          <input type="password" id="register-password" name="password" class="form-control border-end-0 py-2 px-3" placeholder="Buat password" required style="border-start-start-radius: 0.5rem; border-end-start-radius: 0.5rem;">
          <span class="input-group-text bg-white border-start-0 pointer" id="toggle-icon-wrapper" onclick="togglePassword('register-password', 'toggle-icon')" style="border-start-end-radius: 0.5rem; border-end-end-radius: 0.5rem;">
            <i class="fa-solid fa-eye-slash" id="toggle-icon"></i>
          </span>
        </div>
      </div>

      <!-- Field Konfirmasi Password -->
      <div class="mb-4">
        <label for="register-confirm-password" class="form-label text-white small mb-1">Konfirmasi Password</label>
        <div class="input-group">
          <input type="password" id="register-confirm-password" name="confirm_password" class="form-control border-end-0 py-2 px-3" placeholder="Ulangi password" required style="border-start-start-radius: 0.5rem; border-end-start-radius: 0.5rem;">
          <span class="input-group-text bg-white border-start-0 pointer" id="toggle-confirm-icon-wrapper" onclick="togglePassword('register-confirm-password', 'toggle-confirm-icon')" style="border-start-end-radius: 0.5rem; border-end-end-radius: 0.5rem;">
            <i class="fa-solid fa-eye-slash" id="toggle-confirm-icon"></i>
          </span>
        </div>
      </div>

      <!-- Tombol Register (Memanfaatkan kelas btn-gold dari login.css) -->
      <button type="button" id="btn-register" onclick="window.handleRegister()" class="btn btn-gold rounded-pill fw-bold w-100 py-2 mt-2">Daftar</button>

    </form>

    <div id="status-message" class="mt-3 p-2 rounded-2 w-100 text-center text-white" style="display: none; font-size: 14px;"></div>

    <!-- Teks Login -->
    <p class="text-white mt-4 small">
      Sudah punya akun? <a href="/login" class="text-white text-gold-hover fw-bold text-decoration-none">Login</a>
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

    // Fungsi Toggle Mata Password Secara Dinamis
    window.togglePassword = function(inputId, iconId) {
      const passInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById(iconId);
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

    window.handleRegister = async function() {
      const registerName = document.getElementById('register-name').value.trim();
      const registerEmail = document.getElementById('register-email').value.trim();
      const registerPassword = document.getElementById('register-password').value;
      const registerConfirmPassword = document.getElementById('register-confirm-password').value;
      const statusMessage = document.getElementById('status-message');
      const btnRegister = document.getElementById('btn-register');

      statusMessage.style.display = 'block'; // Tampilkan kotak pesan

      if (!registerName || !registerEmail || !registerPassword || !registerConfirmPassword) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)'; // Merah bootstrap
        statusMessage.textContent = 'Harap isi seluruh form termasuk Konfirmasi Password!';
        return;
      }

      if (registerPassword !== registerConfirmPassword) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)'; // Merah bootstrap
        statusMessage.textContent = 'Password dan Konfirmasi Password tidak cocok!';
        return;
      }

      if (!supabaseClient) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
        statusMessage.textContent = 'Gagal: Konfigurasi Supabase bermasalah.';
        return;
      }

      btnRegister.disabled = true;
      btnRegister.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i>Mendaftarkan...';
      statusMessage.style.backgroundColor = 'rgba(13, 110, 253, 0.9)'; // Biru bootstrap
      statusMessage.textContent = 'Menghubungkan ke database...';

      try {
        const { data, error } = await supabaseClient.auth.signUp({
          email: registerEmail,
          password: registerPassword,
          options: {
            data: {
              full_name: registerName
            }
          }
        });

        if (error) {
          statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
          statusMessage.textContent = 'Pendaftaran Gagal: ' + error.message;
          btnRegister.disabled = false;
          btnRegister.textContent = 'Daftar';
          return;
        }

        statusMessage.style.backgroundColor = 'rgba(25, 135, 84, 0.9)'; // Hijau bootstrap
        statusMessage.textContent = 'Pendaftaran Berhasil! Mengalihkan ke halaman Login...';
        btnRegister.textContent = 'Sukses!';

        setTimeout(() => {
          window.location.href = '/login';
        }, 1500);

      } catch (err) {
        statusMessage.style.backgroundColor = 'rgba(220, 53, 69, 0.9)';
        statusMessage.textContent = 'Error: ' + err.message;
        btnRegister.disabled = false;
        btnRegister.textContent = 'Daftar';
      }
    };
  </script>
</body>
</html>
