// Ambil semua elemen dengan class 'card-thumbnail'
let cardThumbnail = document.querySelectorAll('.card-thumbnail');

for (let i = 0; i < cardThumbnail.length; i++) {
    cardThumbnail[i].addEventListener("mouseover", () => {
        // Gunakan querySelector untuk memilih img
        cardThumbnail[i].querySelector('img').style.filter = "grayscale(0%)";
        cardThumbnail[i].querySelector('img').style.transform = "scale(1.1)";
    });
    
    cardThumbnail[i].addEventListener("mouseout", () => {
        cardThumbnail[i].querySelector('img').style.filter = "grayscale(70%)";
        cardThumbnail[i].querySelector('img').style.transform = "scale(1)";
    });
}
