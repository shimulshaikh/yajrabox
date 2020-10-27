@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Add Product Image</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                          
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{ route('productImage.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Product Name</label>

                                        <div class="col-md-6 col-md-6">
                                          <select class="form-control" name="product_id">
                                            @foreach($products as $product) 
                                              <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                          </select>
                                                      
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Image Title</label>

                                        <div class="col-md-6 col-md-6">
                                          <input id="img_title" type="text" class="form-control @error('img_title') is-invalid @enderror" name="img_title" value="{{old('img_title')}}" required autocomplete="img_title" autofocus>
                                          @error('img_title')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Product Image</label>

                                        <div class="col-md-6 col-md-6">
                                          <input type="file" class="form-control @error('image') is-danger @enderror" name="image" 
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png, image/svg, image/webp' onchange="previewFile(this)">  

                                          @error('image')
                                            <p class="help is-danger">{{ $errors->first('image') }}</p>
                                          @enderror

                                          <img id="previewImg" style="max-width: 130px;margin-top: 20px;">
                                                      
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