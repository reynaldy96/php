@extends('Layouts.Member')

@section('content')
<section id="main" class="wrapper">
    <div class="inner">
        <div class="container">
            <hr>
            <div class="text-center">
                More Information Condition 
            </div>
            <hr>
            <div class="card">
                <form action="{{ route('search') }}" method="GET">  
                    <div class="col-md-12"> 
                        <input name="query" type="text" class="form-control border-right" placeholder="Konfirmasi Pembayaran"  value="{{ request()->input('query') }}" />
                        <p>
                    </div>
                    <div class="col-md-12"> 
                        <button type="submit" onclick="this.disabled=true;this.value='Searching, please wait...';this.form.submit();" class="default-btn btn-login floatright btn-block text-uppercase">Cari Kode Barang </button>
                        <p>
                    </div>
                </form>
            </div> 
                <hr>
        </div> 
    </div>
</section> 
@endsection