@extends('Layouts.Member')

@section('content')
    <div id="heading" >
        <h1>Form Jual Barang</h1>
    </div>
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
                <form method="POST" action="{{ route('jual_barang_store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-12 text-md-center">{{ __('Nama Barang') }}</label>
                
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
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
                            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>
                
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
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                
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
                            <input id="phone_produk" type="number" class="form-control @error('phone_produk') is-invalid @enderror" name="phone_produk" value="{{ old('phone_produk') }}" required autocomplete="phone_produk" autofocus>
                
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
                                <div class="row">                                       
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="1" id="hands_id1" name="hands_id" checked>
                                    <label for="radio-alpha">Tangan Pertama</label>
                                </div>
                                <div class="col-6 col-12-small">
                                    <input type="radio" value="2" id="hands_id2" name="hands_id">
                                    <label for="radio-beta">Tangan Kedua</label>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">  
                                <label for="title" class="col-md-10 text-md-center">{{ __('Bersedia') }}</label>
                                <p>
                                <div class="col-md-10">                                           
                                    <select name="cod_id">
                                        @foreach($cod as $key)
                                            <option value="{{$key->id}}"> {{$key->name}}</option>
                                        @endforeach
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
                                            <select id="provinsi" name="province_id">
                                            <option value="">Select</option>
                                                @foreach($countries as $key)
                                                    <option value="{{$key->id}}"> {{$key->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 text-md-right">Select State:</label>
                                    <div class="col-md-7">
                                        <select id="state" name="cities_id">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 text-md-right">Select City:</label>
                                    <div class="col-md-7">
                                        <select name="districts_id" id="city">
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
                                        <select id="category" name="category_id">
                                            <option value="">Select</option>
                                                @foreach($categories as $cate)
                                                <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <label for="title" class="col-md-4 text-md-right">{{ __('  Category Barang') }}</label>
                                </div>
                
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <select name="sub_category_id" id="subcategory">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <label for="title" class="col-md-4 text-md-right">{{ __('  Jenis Barang') }}</label>
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <select name="merk_category_id" id="brandcategory">
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
                                    <textarea name="description" id="exampleFormControlTextarea2" rows="6" placeholder="Keterangan"></textarea>
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
                                <textarea name="body" id="exampleFormControlTextarea1" rows="6" placeholder="Keterangan"></textarea>
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

                    <h3 class="text-center">Gambar Untuk Halaman Depan & Detail Produk </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 ml-auto">
                            <div class="form-group ">
                                <label for="title" class="col-md-12 text-md-center">Gambar untuk Halaman Depan</label>
                                    <div class="col-md-12">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnails" class="custom-file-input" id="files">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group ">
                                <label for="title" class="col-md-12 text-md-center">Gambar untuk Detail Produk</label>
                                    <div class="col-md-12">
                                        <div class="custom-file">
                                            <input type="file" name="images[]" class="custom-file-input" id="files2"  multiple="multiple">
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                        </div>
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
$(document).ready(function(){

var host = window.location.href;    
    $("#provinsi").change(function() {
    $.getJSON(host + "/get-state-list/" + $("#provinsi option:selected").val(), function(data) {
        var temp = [];
            
            $.each(data, function(key, value) {
                temp.push({v:value, k: key});
            });
            
            temp.sort(function(a,b){
                if(a.v > b.v){ return 1}
                if(a.v < b.v){ return -1}
                    return 0;
            });
            
            $('#state').empty();
            $('#state').append('<option>Select</option>');
          
            $.each(temp, function(key, obj) {
                $('#state').append('<option value="' + obj.k +'">' + obj.v + '</option>');
            });
        });                       
    }); 


    $("#state").change(function() {
    $.getJSON(host + "/get-city-list/" + $("#state option:selected").val(), function(data) {
        var temp = [];
            
            $.each(data, function(key, value) {
                temp.push({v:value, k: key});
            });
    
            temp.sort(function(a,b){
                if(a.v > b.v){ return 1}
                if(a.v < b.v){ return -1}
                    return 0;
            });
    
            $('#city').empty();
            $.each(temp, function(key, obj) {
                $('#city').append('<option value="' + obj.k +'">' + obj.v + '</option>');           
            });            
    });
    }); 

});
</script>

<script type="text/javascript">
    $(document).ready(function(){
    
    var host = window.location.href;    
        $("#category").change(function() {
        $.getJSON(host + "/get-category-list/" + $("#category option:selected").val(), function(data) {
            var temp = [];
                
                $.each(data, function(key, value) {
                    temp.push({v:value, k: key});
                });
                
                temp.sort(function(a,b){
                    if(a.v > b.v){ return 1}
                    if(a.v < b.v){ return -1}
                        return 0;
                });
                
                $('#subcategory').empty();
                $('#subcategory').append('<option>Select State/Province</option>');
                $('#brandcategory').empty();
                $('#brandcategory').append('<option>NA</option>');
    
                $.each(temp, function(key, obj) {
                    $('#subcategory').append('<option value="' + obj.k +'">' + obj.v + '</option>');
                });
            });                       
        }); 
    
        $("#subcategory").change(function() {
        $.getJSON(host + "/get-brand-list/" + $("#subcategory option:selected").val(), function(data) {
            var temp = [];
                
                $.each(data, function(key, value) {
                    temp.push({v:value, k: key});
                });
        
                temp.sort(function(a,b){
                    if(a.v > b.v){ return 1}
                    if(a.v < b.v){ return -1}
                        return 0;
                });
        
                $('#brandcategory').empty();
                $.each(temp, function(key, obj) {
                    $('#brandcategory').append('<option value="' + obj.k +'">' + obj.v + '</option>');           
                });            
        });
        }); 
    
    });

    $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});


$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files2").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files2");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
    </script>
@endsection