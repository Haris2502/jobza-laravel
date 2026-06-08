<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.svg') }}" type="image/x-icon">

    @livewireStyles
</head>

<body>
    <div id="app">
        @include('components.layouts.partials.sidebar')

        <div id="main">
            @include('components.layouts.partials.header')

            <div class="page-content">
                {{ $slot }}
            </div>

            @include('components.layouts.partials.footer')
        </div>
    </div>

    <script src="{{ asset('dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('dist/assets/js/main.js') }}"></script>

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:init', () => {

            // ==========================================
            // KASUS A: KONFIRMASI HAPUS DATA UTAMA (Tabel/Database)
            // ==========================================
            Livewire.on('swal:confirm-delete', (event) => {
                const data = event[0];

                Swal.fire({
                    title: data.title || 'Apakah Anda yakin?',
                    text: data.text || "Data ini akan dihapus secara permanen dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',     // Merah untuk konfirmasi hapus
                    cancelButtonColor: '#6c757d',      // Abu-abu untuk batal
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true            // Posisi tombol batal di kiri, hapus di kanan
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Memicu method/fungsi hapus di Class Component Livewire Anda
                        Livewire.dispatch(data.action, { id: data.id });
                    }
                });
            });

            // ==========================================
            // KASUS B: KONFIRMASI HAPUS FOTO PREVIEW (Halaman CreateJob)
            // ==========================================
            Livewire.on('swal:confirm-remove-photo', (event) => {
                const data = event[0];

                Swal.fire({
                    title: 'Batalkan Foto ini?',
                    text: "Foto akan dikeluarkan dari daftar unggahan saat ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Keluarkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mengirim sinyal ke CreateJob.php untuk menghapus array index gambar
                        Livewire.dispatch('executeRemovePhoto', { index: data.index });
                    }
                });
            });

            // NOTIFIKASI TOAST SUKSES INSTAN (Dipakai setelah data terhapus)
            Livewire.on('swal:alert', (event) => {
                const data = event[0];
                Swal.fire({
                    icon: data.icon || 'success',
                    title: data.title || 'Berhasil',
                    text: data.text || '',
                    timer: data.timer || 2000,
                    showConfirmButton: false
                });
            });

        });
    </script>
</body>
</html>
