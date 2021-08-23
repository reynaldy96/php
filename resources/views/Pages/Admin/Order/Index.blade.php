@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Waiting Status Produk </h2>
          <hr>
          <div class="row">
            <div class="table-content table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Nama Barang
                            </th>
                            <th>
                                Total Barang
                            </th>
                            <th>
                                Status
                            </th>	
                            <th>
                                Action
                            </th>			               
                        </tr>
                    </thead>
                    
                    <tbody>
                    @forelse($order as $key=>$row)
                    <tr role="row" class="odd">                                     
                        <td>{{ $key +1 }}</td>   
                        <td>{{$row->user->first_name}}</td>
                        <td>@currency($row->billing_total)</td>
                        <td>
                            @if($row->status_transaksi == 0)
                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                            @else
                                <span class="badge badge-success">Transaksi Selesai</span>
                            @endif  
                        </td>
                        <td>
                            <a href="{{ route('order_edit_waiting_admin', $row->id) }}" class="btn btn-outline-primary">View Status</a>
                        </td>
                    </tr>                    
                    @empty
						 <td colspan="5" style="text-align: center">Belum Ada Barang yang Dijual</td>
						 
                    @endforelse
                    </tbody>
                    </table>
                </div> 
          </div>
        </div>   
    </section> 
@endsection