@extends('Layouts.Member')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Riwayat Transaksi Saya </h2>
          <hr>

          <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Transaksi Tanggal </th>
                        <th>Jumlah Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Thumnail Produk</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ presentDate($order->created_at) }}</td>
                        <td>@currency($order->billing_total)</td>
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
                        @foreach ($order->products as $product)
                            <td>
                                <img src="{{ $product->ProductsThumbnailImages->thumbnail_product_image_path }}" height="80px" alt="Product Image">
                            </td>
                            <td>
                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                            </td>
                            <td>
                                {{ $product->pivot->quantity }}
                            </td>
                        @endforeach
                        <td>
                            <a class="button primary" href="{{ route('orders.show', $order->id) }}">Invoice</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

      </div>   
    </section> 
@endsection