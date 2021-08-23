@extends('Layouts.Member')

@section('content')
<section id="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                    @csrf
                <input type="hidden" name="status_transaksi" value="0">
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    @if (Sentinel::getUser())
                        <input type="email" class="form-control" id="email" name="billing_email" value="{{ Sentinel::getUser()->email }}" readonly>
                    @else
                        <input type="email" class="form-control" id="email" name="billing_email" value="{{ old('email') }}" required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="billing_name" value="{{ Sentinel::getUser()->	first_name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Handphone yang bisa diHubungin</label>
                    <input type="number" class="form-control" id="phone" name="billing_phone" style="padding: 0px; margin: 0px;" value="" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="billing_address" value="{{ old('address') }}" required>
                </div>
                <hr>  	
                <div class="form-group">
                    <label> Bank Transfer: </label>
                    <select name="bank_transfer_id">
                        <option value="">Select</option>
                            @foreach($bank as $key)
                                <option value="{{$key->id}}"> {{$key->name}} = {{$key->number_bank}}</option>
                            @endforeach
                    </select>
                </div>
                <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Complete Order</button>
         </form>
            </div>
            <div class="col-md-6">
                <table>
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                {{ $item->model->name }} <strong class="product-quantity"> ({{ $item->qty }})</strong>
                            </td>
                            <td>
                                <span class="amount">@currency( $item->model->price)</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total </th>
                            <td><span class="amount">@currency(Cart::subtotal())</span></td>
                        </tr>
                        <tr>
                            <th>Biaya System (6%) </th>
                            <td><span class="amount">@currency($newTax)</span></td>
                        </tr>
                        <tr>
                            <th> Total Yang Harus diBayar </th>
                            <td><strong><span class="amount">@currency($newTotal)</span></strong>
                            </td>
                        </tr>	
                    </tfoot>
                </table>
            </div>
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
    </script>
@endsection