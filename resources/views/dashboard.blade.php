<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enigma</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <header>
        <div class="logo">
            <span>📖</span> <strong>Enigma</strong>
        </div>
        <nav>
            <a href="/login"><button class="login">Log In</button></a>
            <a href="/register"><button class="signup">Sign In</button></a>
        </nav>
    </header>
    <main>
        <section class="content">
            <h1>Welcome to enigma !</h1>
            <h2>Explore the Latest News from Around the World</h2>
            <p>Stay informed with our comprehensive coverage of breaking news, trending stories, and in-depth analysis from every corner of the globe.</p>
            <a href="about.html" class="about-link"><button class="about-us">About Us</button></a>
        </section>
        <section class="illustration">
            <img src="assets/img/nothing.png" alt="3D Illustration">
        </section>
    </main>
    <script>
        document.querySelector(".about-link").addEventListener("click", function(event) {
            event.preventDefault();
            alert("Redirecting to About Us page...");
            window.location.href = "about.html";
        });
    </script>
</body>
</html>
