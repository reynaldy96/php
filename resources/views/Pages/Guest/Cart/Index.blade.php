@extends('Layouts.Guest')

@section('content')
    <section id="main" class="wrapper">
        <div class="cart-section container">
            <div>
                @if (Cart::count() > 0)
                <div class="cart-main-area pt-95 pb-100">            
                <div class="container">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="cart-heading">{{ Cart::count() }} item(s) Dalam Cart</h1>
                <div class="table-content table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>images</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga</th>                      
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td>
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit">Remove</button>
                            </form>
                            
                            <p>

                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit">Save for Later</button>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('shop.show', $item->model->slug) }}">
                                <div class="card-img">
                                    <img class="card-img-top" src="{{ $item->model->ProductsThumbnailImages->thumbnail_product_image_path }}">
                                </div>
                            </a>
                        </td>

                        <td>
                            <a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->name }}</a>
                        </td>
                        
                        <td>
                            {{ $item->qty }}
                        </td>
                        
                        <td>
                            <span class="amount"> @currency($item->price)</span>
                        </td>                       
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div> 
                <hr>

                <div class="card">
                <h2 class="text-right">Total Barang yang harus diBayar</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Jumlah dalam Keranjang</th>
                            <th>Biaya System( {{$taxsystem}}% )</th>
                            <th>Total yang harus Dibayar</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <td>@currency($newSubtotal)</td>
                        <td>@currency($newTax)</td>
                        <td>@currency($newTotal)</td>
                    </tbody>
                </table>

                <center>
                    <a class="default-btn btn-login floatright btn-block text-uppercase" href="{{ route('checkout.index') }}">Proceed to checkout</a>
                </center>
                </div>

                </div>
                </div>
                </div>
                </div>         

                @else

                
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <th>
                                <center> Tidak ada Barang dalam Cart </center>
                            </th>
                        </thead>
                    </table>
                </div>


                @endif
                <hr>
                @if (Cart::instance('saveForLater')->count() > 0)

                <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>
                
                <div class="table-content table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>images</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga</th>                            
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach (Cart::instance('saveForLater')->content() as $item)
                    <tr>
                        <td class="product-remove">
                                <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit">Remove</button>
                                </form>						
                            <p>
                                <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit">Tambah Keranjang</button>
                                </form>
                        </td>
                                                                
                        <td>
                            <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ $item->model->ProductsThumbnailImages->thumbnail_product_image_path }}" style="height:140px; width:207px" alt=""></a>
                        </td>
                        <td><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->qty }}</td>
                        <td><span class="amount"> @currency($item->price)</span></td>                       
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <th>
                                <center> Tidak ada Barang dalam favorite </center>
                            </th>
                        </thead>
                    </table>
                </div>
                @endif
            </div>

        </div> 
    </section> 
@endsection