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
                                   
                               <table id="category_table" class="table table-striped table-borderd">
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


@push('css')
<!-- Start for button Excel PDF CSV -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<!-- End for button Excel PDF CSV -->
@endpush

@push('scripts')
 <!-- Start for button Excel PDF CSV -->  
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
<!-- End for button Excel PDF CSV -->

<script> 
        $(document).ready( function () {
            $('#category_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('productCategory.index') !!}',
                dom: 'Bfrtip',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions' },
                ],

                buttons: [
                      
                        {
                        extend: 'copyHtml5',
                        
                        exportOptions: {
                            columns: ':visible'
                          }
                        },

                        {
                          extend: 'excelHtml5',
                          
                          exportOptions: {
                              columns: ':visible'
                          }
                        },

                        {
                          extend: 'pdfHtml5',
                          
                          exportOptions: {
                              columns: ':visible'
                          }
                        },

                       'colvis'
                    ]

            });
        });
</script>


@endpush