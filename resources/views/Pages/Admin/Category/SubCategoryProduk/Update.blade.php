@extends('Layouts.Admin')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <form method="post" action="{{ url('category/update/main-subcategory/'.$subcategory->id) }}">
                @csrf
                <div class="col-md-12">
                    <label class="text-md-left">{{ __('Category Name') }}</label>                
                        <select class="form-control" name="category_id" readonly>                             
                            <option value="{{ $subcategory->Category->id }}"> {{ $subcategory->Category->name }}  </option> 
                        </select>
                </div>                
                   <br>
                <div class="col-md-12">
                    <label for="name" class="text-md-left">{{ __('Jenis Category Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subcategory->name }}" required autocomplete="name" autofocus> 
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                   
                <div class="modal-footer">
                    <ul class="actions">
                        <li><input type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" value="Submit Form" class="primary"></li>
                    </ul>
                </div>            
            </form>
        </div>   
    </section> 
@endsection