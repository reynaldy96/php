@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Kabupaten Indonesia</h2>           
          <hr>
          <div class="row">
            <div class="table-content table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nomor
                            </th>
                            <th>
                                Kabupaten name
                            </th>	               
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($kabupaten as $key=>$row)
                    <tr role="row" class="odd">                                     
                        <td>{{ $key +1 }}</td>
                        <td class="product-name">{{ $row->name }}</td>              
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div> 
          </div>
        </div>   
    </section> 
@endsection
