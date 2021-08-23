@extends('Layouts.Member')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Order ID: {{ $order->id }}</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <h2 class="text-center">Pesanan Saya</h2>
                        <tbody>
                            <tr>
                                <td>Nomor Hp Saya </td>
                                <td>{{$order->billing_phone}} </td>
                            </tr>
                            <tr>
                                <td>Biaya Barang</td>
                                <td>@currency($order->billing_subtotal) </td>
                            </tr>
                            <tr>
                                <td>Biaya System</td>
                                <td>@currency($order->billing_tax) </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>@currency($order->billing_total) </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <h2 class="text-center">Informasi Saya</h2>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $order->user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                    </tbody>   
                    </table>
                </div>
            <div class="col-md-6">
                <table class="table">
                    <h2 class="text-center">Barang yang saya Beli</h2>
                    <thead>
                        <tr>
                            <th>Thumbnail Barang </th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($products as $product)
                            <td>
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    <img src="{{ $product->ProductsThumbnailImages->thumbnail_product_image_path }}" height="80px" alt="Product Image">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>@currency($product->price) </td>
                            <td>{{ $product->pivot->quantity }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                    <table class="table">
                        <h2 class="text-center">Status Transaksi</h2>
                    <tbody>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>{{ presentDate($order->created_at) }}</td>
                        </tr>
                        <tr>
                            <td>Status Transaksi</td>
                            <td>                           
                                @if($order->status_transaksi == 0)
                                <center>
                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                </center>
                                @else
                                <center>
                                    <span class="badge badge-success">Transaksi Selesai</span>
                                </center>
                                @endif  
                            </td>
                        </tr>
                    </tbody>   
                    </table>
                </table>
                </div>
                </div>   
                <hr>
                <center>
                    <a class="button primary" href="{{ route('orders.index') }}">Back To Main Invoice</a>
                </center>
                <hr>
            </div>   
    </section> 
@endsection