{{-- javascripct --}}
<script src="{{ asset('template/assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('template/assets/js/app.js')}}"></script>

<!-- Need: Apexcharts -->
<script src="{{ asset('template/assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ asset('template/assets/js/pages/dashboard.js')}}"></script>
<script>
// JavaScript
function readMore(button) {
    var parentDiv = button.parentElement;
    var shortText = parentDiv.querySelector('.short-text');
    var dots = parentDiv.querySelector('.dots');
    var longText = parentDiv.querySelector('.long-text');

    // Toggle tampilan antara short-text dan long-text
    if (shortText.style.display === "none") {
        shortText.style.display = "inline";
        dots.style.display = "inline";
        longText.style.display = "none";
        button.innerText = "read more";
    } else {
        shortText.style.display = "none";
        dots.style.display = "none";
        longText.style.display = "inline";
        button.innerText = "read less";
    }
    event.preventDefault(); // Menahan perilaku default tautan
}

    </script>
   <script>
    // Mendapatkan elemen-elemen yang diperlukan
    var tahunDropdown = document.getElementById('tahun');
    var programDropdown = document.getElementById('program');
    var apbdDropdown = document.getElementById('apbd');
    var okeButton = document.getElementById('oke-pilih');

    // Menambahkan event listener untuk klik tombol "OKE PILIH"
    okeButton.addEventListener('click', function() {
        // Mendapatkan nilai yang dipilih dari dropdown
        var tahunValue = tahunDropdown.value;
        var programValue = programDropdown.value;
        var apbdValue = apbdDropdown.value;

        // Menampilkan nilai yang dipilih (opsional, bisa dihapus jika tidak diperlukan)
        console.log('Tahun:', tahunValue);
        console.log('Program:', programValue);
        console.log('Tahapan APBD:', apbdValue);

        // Lakukan aksi yang diinginkan, seperti mengarahkan ke halaman baru dengan parameter yang sesuai
        // Contoh:
        window.location.href = '/hasil-pilihan?tahun=' + tahunValue + '&program=' + programValue + '&apbd=' + apbdValue;
    });
        
    
    
</script>
        </script>
        