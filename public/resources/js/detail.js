const body = document.getElementById('body-berita')
const toggleBerita = document.getElementById('toggle-berita')
body.style.textAlign='justify';
async function toggleLihatSelengkapnya(){
	const id = toggleBerita.dataset.id
	try{
		const response = await fetch("/body/get?id="+id)
		const data = await response.text()
		if(!response.ok)
			throw new Error("HTTP ERROR " + response.status)
		
		if(response.status === 200)
			body.innerHTML = data

	}catch(error){
		body.innerHTML += error
	}
}


toggleBerita.addEventListener("click", toggleLihatSelengkapnya)