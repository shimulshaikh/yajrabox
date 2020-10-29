@extends('layout3.app')
@section('title', 'Leave')

@section('header')
@endsection

@section('footer')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#data_table').DataTable({
                order: [[7, 'dsc']],

                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{{ route('leaveApplicationData') }}",
                    type: 'GET',
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },
                "columns": [
                    {"data":"DT_RowIndex", searchable: false},
                    {"data": "employee"},
                    {"data": "company"},
                    {"data": "type"},
                    {"data": "from"},
                    {"data": "to"},
                    {"data": "duration"},
                    {"data": "remark"},
                    {"data": "paid"},
                    {"data": "authorized"},
                    { data: 'file'},
                    {"data": "created_at"},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

        $('#btnFiterSubmitSearch').click(function(){
            $('#data_table').DataTable().draw(true);
        });
    </script>
@endsection

@section('content')

        <div class="card card-small">
            <div class="card-header border-bottom">
                <h4>Leave Requisition</h4>
            </div>


        <div class="card-body">

        <div  style="margin-bottom: 20px" class="row">


            <div class="col-md-4"> </div>

            <div class="col-md-3">

                <input type="date"   id="start_date"  name="start_date"  required="required"
                       placeholder="From Date" class="form-control year-picker">
            </div>

            <div class="col-md-3">
                <input type="date"   id="end_date"  name="end_date"  required="required"
                       placeholder="From Date" class="form-control year-picker">
            </div>

            <div class="col-md-2">
                <button type="submit" id="btnFiterSubmitSearch" class="btn btn-info btn-sm">Search</button>
            </div>


        </div>


        <div class="table-responsive">
            <table id="data_table" class="table table-striped table-bordered" style="width:100%">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Employee</th>
                    <th>Company</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Duration</th>
                    <th>Remarks</th>
                    <th>Paid</th>
                    <th>Authorized</th>
                    <th>Document</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>


@endsection