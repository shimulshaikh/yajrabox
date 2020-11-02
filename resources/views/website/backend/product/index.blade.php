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

                              <div class="col-md-6 col-md-6" style="margin-bottom: 20px">
                                <select class="form-control" name="category" id="category" id="sel1">
                                  <option value="0">--Select Category--</option>
                                  @foreach(\App\ProductCategory::all() as $category) 
                                   <option value="{{ $category->id }}">{{ $category->brand_name }}</option>
                                  @endforeach
                                </select>                    
                              </div>

                              <div class="col-md-2">
                                <button type="submit" id="category_filter" class="btn btn-warning btn-sm">Filter
                                </button>
                              </div>
                                   
                                   <table id="product_table" class="table table-striped table-borderd">
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

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script> 

        $(document).ready( function () {
          
                $('#product_table').DataTable({
                  order: [[2, 'dsc']],
                    processing: true,
                    serverSide: true,
                    ajax: {
                      url:"{{ route('product.index') }}",
                      type: 'GET',
                      data: function (d) {
                        d.category = $('#category').val();
                      }
                    },

                    columns: [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'product_name', name: 'product_name' },
                    { data: 'brand_name', name: 'brand_name', orderable: false, searchable: false },
                    { data: 'price', name: 'price' },
                    { data: 'product_desc', name: 'product_desc' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                  ]

                });

           });

        //For custom search
        $('#category_filter').click(function () {
              $('#product_table').DataTable().draw(true);
          });

</script>
@endpush