@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Update Product</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                          
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('product.update',$product->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $product->id }}">

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Product Category</label>

                                        <div class="col-md-6">
                                          <select class="form-control" name="category_id">
                                          @foreach($productCategorys as $products)  
                                          <option value="{{ $products->id }}" {{ ($products->id == $product->category_id) ? 'selected' : '' }}>{{ $products->brand_name }}</option>
                                          @endforeach
                                        </select>
                                                      
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="product_name" class="col-md-2 col-form-label text-md-right">Product Name</label>

                                        <div class="col-md-6">
                                          <input id="product_name" type="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}" required autocomplete="product_name" autofocus>
                                          @error('product_name')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="price" class="col-md-2 col-form-label text-md-right">Price</label>

                                        <div class="col-md-6">
                                          <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" autofocus>
                                          @error('price')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Description</label>
                                        <div class="col-md-6 col-sm-6 ">
                                          <textarea class="form-control @error('product_desc') is-danger @enderror" name="product_desc" id="product_desc" rows="3">{{ $product->product_desc }}</textarea>

                                            @error('product_desc')
                                          <p class="help is-danger">{{ $errors->first('product_desc') }}</p>
                                          @enderror
                                        </div>
                                    </div>  
                                    <button type="submit" class="btn btn-primary">Update</button>

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