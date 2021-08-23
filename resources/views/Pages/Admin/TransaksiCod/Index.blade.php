@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Main Menu TransaksiCod </h2>           
            <a href="#" class="btn btn-outline-black" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add Data</a>
          
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
                                TransaksiCod name
                            </th>
                            <th>
                                Action
                            </th>			               
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($cod as $key=>$row)
                    <tr role="row" class="odd">                                     
                        <td>{{ $key +1 }}</td>
                        <td class="product-name">{{ $row->name }}</td>      
                        <td>                                                        
                            <a href="{{ URL::to('cods/update/main-cods/'.$row->id) }}" class="btn btn-sm btn-info">Update</a>
                            <a href="{{ URL::to('cods/delete/main-cods/'.$row->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin ingin menghapus {{$row->name}} TransaksiCod ?')">Delete</a>
                        </td>          
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div> 
          </div>
        </div>   
    </section> 
@endsection

@section('ajax')

<div class="modal fade bd-example-modal-lg" id="modaldemo3">
    <div class="modal-dialog">
      <div class="modal-content">
        <br>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add TransaksiCod</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form method="post" action="{{ route('store_cods_admin') }}">
        @csrf
        <div class="modal-body">                
            <label for="name" class="text-md-center">{{ __('Transaksi Cod Name') }}</label>
            <div class="form-group">  
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <ul class="actions">
                    <li><input type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" value="Submit Form" class="primary"></li>
                </ul>
            </div>
            
        </div>
        </form>
      </div>
    </div>
</div>

@endsection