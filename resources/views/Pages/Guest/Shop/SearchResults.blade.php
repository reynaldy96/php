@extends('Layouts.Guest')

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Details</th>
            <th>Description</th>
           
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <th><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></th>
                <td>{{ $product->details }}</td>
                <td>{{ $product->description }}</td>
               
            </tr>                    
        @empty
            <div style="text-align: left">Belum Ada Barang yang Dijual</div>
        @endforelse
    </tbody>
</table>
@endsection