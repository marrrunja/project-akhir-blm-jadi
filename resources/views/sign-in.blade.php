<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form method="post" action="/login">
            @csrf
            <h2>Sign in for your account</h2>
            <p>Don’t have an account? <a href="/register">Sign Up</a></p>
            @if (Session::has('error'))
            <div class="mb-3">
                <div class="alert danger">
                    {{ Session::get('error') }}
                </div>
            </div>
            @endif
            <input type="text" id="username" name="email" class="input-box" placeholder="Email">
            <input type="password" id="password" name="password" class="input-box" placeholder="Password">
            <button class="btn" id="signInBtn" type="submit">Sign In</button>
        </form>
    </div>
    <!-- <script>
        document.getElementById('signInBtn').addEventListener('click', function() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            
            if(username === "" || password === "") {
                alert("Please enter both username and password.");
            } else {
                alert("Sign in successful!");
                window.location.href = 'about.html'; // Ganti dengan halaman utama
            }
        });
    </script> -->
</body>
</html>
