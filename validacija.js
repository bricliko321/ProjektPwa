document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('slanje').onclick = function(event) {
        var slanjeForme = true;

       
        var naslov = document.getElementById('naslov').value;
        var porukaNaslov = document.getElementById('porukaNaslov');
        if (naslov.length < 5 || naslov.length > 30) {
            slanjeForme = false;
            porukaNaslov.innerHTML = "Naslov vijesti mora imati između 5 i 30 znakova!";
            porukaNaslov.style.color = 'red';
        } else {
            porukaNaslov.innerHTML = "";
        }

       
        var kratkiSadrzaj = document.getElementById('kratki_sadrzaj').value;
        var porukaKratkiSadrzaj = document.getElementById('porukaKratkiSadrzaj');
        if (kratkiSadrzaj.length < 10 || kratkiSadrzaj.length > 100) {
            slanjeForme = false;
            porukaKratkiSadrzaj.innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!";
            porukaKratkiSadrzaj.style.color = 'red';
        } else {
            porukaKratkiSadrzaj.innerHTML = "";
        }

       
        var sadrzaj = document.getElementById('sadrzaj').value;
        var porukaSadrzaj = document.getElementById('porukaSadrzaj');
        if (sadrzaj.trim().length === 0) {
            slanjeForme = false;
            porukaSadrzaj.innerHTML = "Sadržaj vijesti mora biti unesen!";
            porukaSadrzaj.style.color = 'red';
        } else {
            porukaSadrzaj.innerHTML = "";
        }

 
        var slika = document.getElementById('slika').value;
        var porukaSlika = document.getElementById('porukaSlika');
        if (slika.trim().length === 0) {
            slanjeForme = false;
            porukaSlika.innerHTML = "Slika mora biti odabrana!";
            porukaSlika.style.color = 'red';
        } else {
            porukaSlika.innerHTML = "";
        }

      
        var kategorija = document.getElementById('kategorija').value;
        var porukaKategorija = document.getElementById('porukaKategorija');
        if (kategorija === "") {
            slanjeForme = false;
            porukaKategorija.innerHTML = "Kategorija mora biti odabrana!";
            porukaKategorija.style.color = 'red';
        } else {
            porukaKategorija.innerHTML = "";
        }

        
        if (!slanjeForme) {
            event.preventDefault();
        }
    };
});
