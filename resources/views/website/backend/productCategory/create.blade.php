@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Add Product Category</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('productCategory.store')}}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Category Name</label>

                                        <div class="col-md-6">
                                          <input id="brand_name" type="brand_name" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{old('brand_name')}}" required autocomplete="brand_name" autofocus>
                                          @error('brand_name')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div>  
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                  </form>
                              </div>
                            </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

@endsection