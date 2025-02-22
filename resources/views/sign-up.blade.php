<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form method="post" class="mt-3" action="/register">
            @csrf
            <h2>Sign up for your account</h2>
            <p>Already have an account? <a href="/login">Sign In</a></p>
            @if (Session::has('error'))
            <div class="alert danger">
                {{ Session::get('error') }}
            </div>   
            @endif
            @if (Session::has('status'))
            <div class="alert success">
                {{ Session::get('status') }}
            </div>   
            @endif
            <input type="text" id="username" class="input-box" placeholder="Name" name="nama">
            <input type="email" id="email" class="input-box" placeholder="Email" name="email">
            
            <input type="password" id="password" class="input-box" placeholder="Password" name="password">
            <button class="btn" id="signupBtn">Sign Up</button>
        </form>
        <div class="mt-3">
        </div>
    </div>
</body>
</html>
