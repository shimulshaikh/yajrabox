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
                          <div id="my_div"></div>
                          <div class="card">
                            <div class="card-header" style="margin-bottom: 15px">
                                   <!-- Button trigger modal -->
                                   <a class="btn btn-success" href="javascript:void(0)" id="createNewCustomer"> Add customer</a>
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

<!-- Start for customer modal -->

<!-- Modal -->
<div class="modal fade" id="customerModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelHeading">Customer Created</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="customerForm" name="customerForm" class="form-horizontal">
                   <input type="hidden" name="customer_id" id="customer_id">
          <div class="form-group">
                <label for="customer_name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
          </div>

          <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
              </div>
          </div>

          <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="" maxlength="20" required="">
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End for customer modal -->
@stop

@push('css')
<!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
@endpush

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<script type="text/javascript">
  
        $(document).ready( function () {

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          var table =  $('#customer_table').DataTable({
                order: [[0, 'desc']],
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
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                
            });

        //start CRUD  
        $('#createNewCustomer').click(function () {
        $('#saveBtn').val("create-customer");
        $('#customer_id').val('');
        $('#customerForm').trigger("reset");
        $('#modelHeading').html("Create New Customer");
        $('#customerModal').modal('show');
      });
    
    $('body').on('click', '.editCustomer', function () {
      var customer_id = $(this).data('id');
      $.get("{{ route('customer.index') }}" +'/' + customer_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Customer");
          $('#saveBtn').val("edit-user");
          $('#customerModal').modal('show');
          $('#customer_id').val(data.id);
          $('#customer_name').val(data.customer_name);
          $('#email').val(data.email);
          $('#phone').val(data.phone);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('save Change');
    
        $.ajax({
          data: $('#customerForm').serialize(),
          url: "{{ route('customer.store') }}",
          type: "POST",
          dataType: 'json',
          
          success: function (data) {
     
              $('#customerForm').trigger("reset");
              $('#customerModal').modal('hide');
              $('#my_div').html(data);
              table.draw();

              iziToast.success({
                title: 'Customer Saved successfully',
                message: '{{ Session('success') }}',
                position: 'bottomRight'
              });

          },

          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteCustomer', function () {
     
        var customer_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
            type: "DELETE",
            url: "{{ route('customer.store') }}"+'/'+customer_id,
            success: function (data) {
                table.draw();

                iziToast.success({
                title: 'Customer Deleted Successfully',
                message: '{{ Session('success') }}',
                position: 'bottomRight'
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
          });
        }
        
    });

 });
//end CRUD        


        // Statr for date range search
        $('#btnFiterSubmitSearch').click(function(){
            $('#customer_table').DataTable().draw(true);
        });
        // End for date range search

</script>

@endpush