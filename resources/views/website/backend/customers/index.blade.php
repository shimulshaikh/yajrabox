@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">customer</a>
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
                                   <!-- Button trigger modal -->
                                    <a href="" class="btn btn-info" data-toggle="modal">
                                      Add customer
                                    </a>
                            </div>
                            <div class="card-body">

            <!-- Start For time search -->
            <div  style="margin-bottom: 20px" class="row">
              <div class="col-md-3">
                <input type="date"   id="start_date"  name="start_date"  required="required"
                       placeholder="From Date" class="form-control year-picker">
              </div>

              <div class="col-md-3">
                <input type="date"   id="end_date"  name="end_date"  required="required"
                       placeholder="From Date" class="form-control year-picker">
              </div>

              <div class="col-md-2">
                <button type="submit" id="btnFiterSubmitSearch" class="btn btn-info btn-sm">Filter</button>
              </div>
            </div>
            <!-- End for time search -->

                                   
                              <table id="customer_table" class="table table-striped table-borderd">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Create Time</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
        $(document).ready( function () {

            $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });

            $('#customer_table').DataTable({
                order: [[0, 'asc']],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customer.index') }}",
                    type: 'GET',
                    // Statr for date range search
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                         }
                    // End for date range search     
                      },  
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },
                ],
                
            });
          });
        // Statr for date range search
        $('#btnFiterSubmitSearch').click(function(){
            $('#customer_table').DataTable().draw(true);
        });
        // End for date range search

</script>

@endpush