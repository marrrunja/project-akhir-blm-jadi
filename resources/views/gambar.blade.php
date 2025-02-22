<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Image</title>
</head>
<body>
    <h2>Random Image</h2>
    <img id="randomImage" width="400">
    <img src="{{ asset('storage/images/'. $n->gambar) }}" alt="">
    <script>
        const images = [
            @foreach($news as $n)
            {{ asset('storage/images/'. $n->gambar) }}
            @endforeach
        ];

        document.getElementById("randomImage").src = images[Math.floor(Math.random() * images.length)];
    </script>

</body>
</html>