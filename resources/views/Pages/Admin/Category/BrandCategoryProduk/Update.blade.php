@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <form method="post" action="{{ url('category/update/main-merkcategory/'.$brandcategory->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="text-md-left">{{ __('Category Name') }}</label>                
                            <select class="form-control" name="category_id" readonly>                             
                                    <option value="{{ $brandcategory->subcategory->id }}"> {{ $brandcategory->subcategory->name }}  </option> 
                            </select>
                    </div>                
                    <label for="name" class="text-md-center">{{ __('Category Name') }}</label>
                    <div class="form-group">  
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $brandcategory->name }}" required autocomplete="name" autofocus> 
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <ul class="actions">
                            <li><input type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" value="Submit Form" class="btn btn-outline-primary"></li>
                        </ul>
                    </div>            
                </div>
                </form>
        </div>   
    </section> 
@endsection