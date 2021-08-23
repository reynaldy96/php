@extends('Layouts.Member')

@section('content')

@forelse ($products as $product)
<section id="main" class="wrapper">
    <div class="inner">
        <div class="container">
            <hr>
            <div class="text-center">
                Informasi Kode Barang 
            </div>
            <hr>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Email</th>
                                <th>Harga Barang </th>
                                <th>Biaya System </th>
                                <th>Total yang harus diBayar </th>
                                <th>Status Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->kode_pembayaran }}</td>
                                <td>{{ $product->billing_email }}</td>
                                <td>{{ $product->billing_subtotal }}</td>
                                <td>{{ $product->billing_tax }}</td>
                                <td>{{ $product->billing_total }}</td>
                                <td>{{ $product->status_transaksi }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <a onclick="this.disabled=true;this.value='Searching, please wait...';this.form.submit();" class="default-btn btn-login floatright btn-block text-uppercase" href="{{ route('edit.search', $product->id) }}">Lihat Transaksi</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @empty
            <p>                    
                <h4> Kode Barang Tidak diTemukan !!! </h4>
            </p>
            @endforelse
        </div> 
    </div>
</section> 
@endsection
