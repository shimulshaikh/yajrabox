@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Update Product Category</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('productCategory.update',$productCategory->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $productCategory->id }}">

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Category Name</label>

                                        <div class="col-md-6">
                                          <input id="brand_name" type="brand_name" class="form-control" name="brand_name" value="{{$productCategory->brand_name}}">
                                                      
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