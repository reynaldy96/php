@extends('Layouts.Member')

@section('content')
    <div id="heading">
        <h1>Update Data Barang</h1>
    </div>
	
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
                <form method="post" action="{{ URL('update-barang/product/'. $product->id . '/data/'. $product->slug ) }} }} " enctype="multipart/form-data">    
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Nama Barang') }}</label>
                
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>
                
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="quantity" class="col-md-12 text-md-center">{{ __('Jumlah Barang Yang diJual ') }}</label>
                
                        <div class="col-md-12">
                            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity }}" required autocomplete="quantity" autofocus>
                
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="form-group">
                    <label for="price" class="col-md-12 text-md-center">{{ __('Harga') }}</label>
                
                    <div class="col-md-12">
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" autofocus>
                
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    </div>
            
                    <div class="form-group">
                        <label for="phone_produk" class="col-md-12 text-md-center">{{ __('Nomor Telephone Penjual') }}</label>
                
                        <div class="col-md-12">
                            <input id="phone_produk" type="number" class="form-control @error('phone_produk') is-invalid @enderror" name="phone_produk" value="{{ $product->phone_produk }}" required autocomplete="phone_produk" autofocus>
                
                            @error('phone_produk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">  
                                <label for="title" class="col-md-12 text-md-center">{{ __('Kepemilikan') }}</label>
                                <p>
                               
                                <div class="col-md-12">  
                                @if($product->hands_id == 1)     
                                <div class="row">                                    
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="1" id="hands_id1" name="hands_id" checked>
                                    <label for="radio-alpha">Tangan Pertama</label>
                                </div>
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="2" id="hands_id2" name="hands_id" checked>
                                    <label for="radio-beta">Tangan Kedua</label>
                                </div>
                                </div>
                                @else
                                <div class="row">
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="1" id="hands_id1" name="hands_id" checked>
                                    <label for="radio-alpha">Tangan Pertama</label>
                                </div>
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="2" id="hands_id2" name="hands_id" checked>
                                    <label for="radio-beta">Tangan Kedua</label>
                                </div>
                                </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">  
                                <label for="title" class="col-md-10 text-md-center">{{ __('Bersedia') }}</label>
                                <p>
                                <div class="col-md-10">                                           
                                    <select name="cod_id">
                                        <option value="0">Pilih</option>
                                        <option id="cod_id1" value="1">Cek Barang Ditempat</option>
                                        <option id="cod_id2" value="2">Pengiriman via Kurir</option>
                                        <option id="cod_id3" value="3">Cek Barang Ditempat & Pengiriman via Kurir</option>                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center">Lokasi & Category </h3>
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6 ml-auto">
                            <label class="col-md-12 text-md-center">Lokasi Anda Tinggal</label>
                                <hr>
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 text-md-right">Select Provinsi:</label>
                                        <div class="col-md-7">
                                            <select id="country" name="province_id">
                                            <option value="">Select</option>
                                                @foreach($countries as $key => $country)
                                                    <option value="{{$key}}"> {{$country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 text-md-right">Select State:</label>
                                    <div class="col-md-7">
                                        <select id="state" name="districts_id">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 text-md-right">Select City:</label>
                                    <div class="col-md-7">
                                        <select name="cities_id" id="city">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <label class="col-md-12 text-md-center">Category Barang</label>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <select id="cate" name="category_id">
                                            <option value="">Select</option>
                                                @foreach($categories as $key => $cate)
                                                    <option value="{{$key}}"> {{$cate}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <label for="title" class="col-md-4 text-md-right">{{ __('  Category Barang') }}</label>
                                </div>
                
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <select name="sub_category_id" id="categor">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <label for="title" class="col-md-4 text-md-right">{{ __('  Jenis Barang') }}</label>
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <select name="merk_category_id" id="bran">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <label for="title" class="col-md-4 text-md-right">{{ __('  Merk Barang') }}</label>
                                </div>
                        </div>
                    </div>
                    <hr>

                    <h3 class="text-center">Informasi Barang & Transaksi</h3>
                    <hr>
                    <div class="row">       
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">
                            <label for="exampleFormControlTextarea2" class="col-md-12 text-md-center">{{ __('Description') }}</label>
                                <div class="col-md-12">
                                    <textarea name="description" id="exampleFormControlTextarea2" rows="6">{{ $product->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6 ml-auto">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="col-md-12 text-md-center">{{ __('Tempat Transaksi yang diSarankan') }}</label>
                    
                            <div class="col-md-12">
                                <textarea name="body" id="exampleFormControlTextarea1" rows="6">{{ $product->body }}</textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>                
                    <hr>

                    <div class="button-box">
                        <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Posting </button>
                    </div>
                </form>
            </div>
        </div>
    </section> 
@endsection

@section('ajax')
<script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?province_id="+countryID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?city_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>

<script type="text/javascript">
    $('#cate').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-category-list')}}?category_id="+categoryID,
           success:function(res){               
            if(res){
                $("#categor").empty();
                $("#categor").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#categor").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#categor").empty();
            }
           }
        });
    }else{
        $("#categor").empty();
        $("#bran").empty();
    }      
   });
    $('#categor').on('change',function(){
    var subcateID = $(this).val();    
    if(subcateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-brand-list')}}?subcategory_id="+subcateID,
           success:function(res){               
            if(res){
                $("#bran").empty();
                $.each(res,function(key,value){
                    $("#bran").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#bran").empty();
            }
           }
        });
    }else{
        $("#bran").empty();
    }
        
   });
</script>

@endsection