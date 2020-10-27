@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Product Category</a>
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
                                <a href="{{ route('productCategory.create') }}" class="btn btn-success">Add Category</a>
                            </div>
                            <div class="card-body">
                                   
                                   <table id="category_table" class="table">
                                      <thead>
                                        <tr>
                                          <th>id</th>
                                          <th>Brand Name</th>
                                          <th>Slug</th>
                                          <th>Create Time</th>
                                          <th>Update Time</th>
                                          <th>Action</th>
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
            $('#category_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.proguctCategorys') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions' },
                ]
            });
        });
</script>
@endpush