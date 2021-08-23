@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">

            <form method="post" action="{{ route('update_order_edit_waiting_admin', $waiting->id) }}" enctype="multipart/form-data">    
                @csrf
            
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Email Pembeli') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="{{$waiting->billing_email}}" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Nama Pembeli') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="{{$waiting->billing_name}}" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Biaya Barang yang diBeli') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="@currency($waiting->billing_subtotal)" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                    <div class="col-md-4 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Biaya System') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="@currency($waiting->billing_tax)" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                    <div class="col-md-4 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Total Biaya yang harus diBayar') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="@currency($waiting->billing_total)" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                </div>

                <hr>
                
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Bank Transfer') }}</label>
            
                        <div class="col-md-12">
                            <img class="card-img-top" src="{{ $waiting->kode->bank_transfer_image_path }}" height="200px" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Nama Pembeli') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control" value="{{$waiting->billing_name}}" autocomplete="name" readonly autofocus>
                        </div>

                        <br>

                        <label for="name" class="col-md-12 text-md-center">{{ __('Total Biaya yang harus diBayar') }}</label>
            
                        <div class="col-md-12">
                            <input class="form-control text-center" value="@currency($waiting->billing_total)" autocomplete="name" readonly autofocus>
                        </div>
                    </div>
                </div>

                <hr>
                <form method="post" action="{{ route('update_order_edit_waiting_admin', $waiting->id) }}" enctype="multipart/form-data">    
                    @csrf

                    <label for="title" class="col-md-12 text-md-center">{{ __('Apakah Jumlah Transaksi sudah sesuai dengan System') }}</label>
                    
                        <select name="status_transaksi">
                            <option> Pilih</option>
                            <option value="0"> Tidak, Transaksi Tidak sesuai System</option>
                            <option value="1"> Ya, Transaksi sesuai System </option>
                        </select>
                    
                    <br>

                    <label for="title" class="col-md-12 text-md-center">{{ __('Apakah Admin Sudah Memeriksa Transaksi User dengan Benar ?') }}</label>
                    
                        <select name="status_transaksi1">
                            <option> Pilih</option>
                            <option value="0"> Tidak, Admin Belum Periksa Transaksi</option>
                            <option value="1"> Ya, Admin Sudah Periksa Transaksi</option>
                        </select>

                    <br>

                    <div class="button-box">
                        <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Posting </button>
                    </div>
                </form>

        </div>   
    </section> 
@endsection