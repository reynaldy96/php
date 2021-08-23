@extends('Layouts.Member')

@section('content')
<section id="main" class="wrapper">
    <div class="container">
        <h2 class="text-center">Terima Kasih atas kepercayaan anda untuk bertransaksi pada kami </h2>
<div class="card">
    <br>
    <div class="text-center">Pesanan Anda sedang kami Proses</div>
    <br>
        <div class="text-center">Silahkan melakukan Konfirmasi Pembayaran pada Email yang telah Kami Kirimkan</div>
    <div class="spacer"></div>
    <hr>
    <div>
        <center>
            <a href="{{ url('/') }}" class="button">Kembali Halaman Utama</a>
        </center>
    </div>
</div>
</div>   
</section> 
@endsection