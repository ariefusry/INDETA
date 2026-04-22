<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login dan Register</title>
</head>
<body>
  <h1>Autentikasi Pengguna</h1>

  <h2>Login</h2>
  <form id="login-form" onsubmit="event.preventDefault()">
    <label for="login-email">Email</label>
    <input type="email" id="login-email" name="email" required>

    <label for="login-password">Password</label>
    <input type="password" id="login-password" name="password" required>

    <button type="submit" id="btn-login" name="btn_login">Login</button>
  </form>

  <hr>

  <h2>Register</h2>
  <form id="register-form" onsubmit="event.preventDefault()">
    <label for="register-name">Nama Lengkap</label>
    <input type="text" id="register-name" name="full_name" required>

    <label for="register-email">Email</label>
    <input type="email" id="register-email" name="email" required>

    <label for="register-password">Password</label>
    <input type="password" id="register-password" name="password" required>

    <button type="submit" id="btn-register" name="btn_register">Register</button>
  </form>

  <script>
    // Inisialisasi Supabase Client:
    // const supabase = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

    // Login handler (signInWithPassword):
    // 1) Ambil nilai dari #login-email dan #login-password
    // 2) Panggil supabase.auth.signInWithPassword({ email, password })
    // 3) Tangani response error/sukses

    // Register handler (signUp):
    // 1) Ambil nilai dari #register-name, #register-email, #register-password
    // 2) Panggil supabase.auth.signUp({
    //      email,
    //      password,
    //      options: { data: { full_name: name } }
    //    })
    // 3) Tangani response error/sukses

    // Contoh pemasangan event submit:
    // document.getElementById('login-form').addEventListener('submit', async function () {
    //   // TODO: implement login with signInWithPassword
    // });

    // document.getElementById('register-form').addEventListener('submit', async function () {
    //   // TODO: implement register with signUp
    // });
  </script>
</body>
</html>
