@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <form method="post" action="{{ url('category/update/main-category/'.$category->id) }}">
                @csrf
                <div class="modal-body">                
                    <label for="name" class="text-md-center">{{ __('Category Name') }}</label>
                    <div class="form-group">  
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autocomplete="name" autofocus> 
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