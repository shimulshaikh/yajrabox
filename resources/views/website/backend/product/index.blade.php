@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Product</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                          @include('partials.alerts')
                          <div class="card">
                            <div class="card-header" style="margin-bottom: 15px">
                                   <a href="{{ route('product.create') }}" class="btn btn-success">Add Product</a>
                            </div>
                            <div class="card-body">
                                   
                                   <table id="product_table" class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Product Name</th>
                                          <th scope="col">Product Category</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Description</th>
                                          <th scope="col">Create Time</th>
                                          <th scope="col">Update Time</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                      </thead>
                                    </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

@stop


@push('scripts')
<script> 
        $(document).ready( function () {
            $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.product') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'price', name: 'price' },
                    { data: 'product_desc', name: 'product_desc' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions' }
                ]
            });
        });
</script>
@endpush