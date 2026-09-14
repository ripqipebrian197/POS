@extends('layouts.app') {{-- Sesuaikan 'layouts.app' dengan file layout utama Anda --}}

@section('content')
 @include('layouts.navbar')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4">
        <!-- Judul -->
        <h3 class="fw-bold mb-3">Tentang POS Minuman Segar</h3>

        <hr>

        <!-- Informasi Aplikasi -->
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Nama:</strong> POS Minuman Segar<br>
                <strong>Pemilik:</strong> CEO Ripqi<br>
                <strong>Alamat:</strong> JL.JB Lanud, No.123<br>
            </div>
            <div class="col-md-6">
                <strong>Pengembang:</strong> Tim POS<br>
                <strong>Tahun Terbit:</strong> 2026
            </div>
            <div><strong>Menu Yang Tersedia:</strong> Bermacam-macam minuman segar, kopi, teh, DLL.
        </div>
        </div>

        <hr>

<div class="text-center mt-3">
    <img src="{{ asset('img/toko ess.jpeg') }}" alt="Logo POS" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
</div>
    </div>
</div>
@endsection