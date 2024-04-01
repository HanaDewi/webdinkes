{{-- javascripct --}}
<script src="{{ asset('template/assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('template/assets/js/app.js')}}"></script>

<!-- Need: Apexcharts -->
<script src="{{ asset('template/assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ asset('template/assets/js/pages/dashboard.js')}}"></script>
<script>
    function readMore(element) {
        var dots = element.previousElementSibling.previousElementSibling;
        var moreText = element.previousElementSibling;
    
        if (dots.style.display === 'none') {
            dots.style.display = 'inline';
            element.textContent = 'read more';
            moreText.style.display = 'none';
        } else {
            dots.style.display = 'none';
            element.textContent = 'read less';
            moreText.style.display = 'inline';
        }
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
        