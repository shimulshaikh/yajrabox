@extends('layout3.app')
@section('title', 'Job Category')

@section('header')
@endsection

@section('footer')

@section('footer')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#data_table').DataTable({
                order: [[2, 'dsc']],

                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{{ route('jobConfigData') }}",
                    type: 'GET',
                    data: function (d) {
                        d.company = $('#company').val();
                    }
                },
                "columns": [
                    {"data":"DT_RowIndex", searchable: false},
                    {"data": "company"},
                    {"data": "type"},
                    {"data": "category"},
                    {"data": "salary"},
                    {"data": "cfc_percentage"},
                    {"data": "created_at"},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        });

        $('#company_filter').click(function () {
            $('#data_table').DataTable().draw(true);
        });
    </script>
@endsection
@endsection

@section('content')

    <div class="card card-small">
        <div class="card-header border-bottom">
            <h4>Job Configuration</h4>
        </div>

        <div class="card-body">



        <!-- Trigger the modal with a button -->


            <a href="{{route('job-config.create')}}" class="btn btn-info">Create Job Configuration</a>
            <a href="{{route('job-config.import')}}" class="btn btn-info">Import CSV</a>

            <br>   <br>


            <div style="margin-bottom: 20px" class="row">


                <div class="col-md-3">
                </div>
                <div class="col-md-3">

                    <select id="company" name="company" class="form-control" id="sel1">
                        <option value="0">Select Company</option>
                        @foreach(\App\Company::all() as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                    <div id="code_error3" style="color: #e3342f;font-size: 80%;font-weight: bolder;"></div>
                </div>

                <div class="col-md-2">
                    <button type="submit" id="company_filter" class="btn btn-warning btn-sm">Search
                    </button>
                </div>

                <div class="col-md-4">
                </div>
            </div>


            <div class="table-responsive">
                <table id="data_table" class="table table-striped table-bordered" style="width:100%">

                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company</th>
                        <th>Job Type</th>
                        <th>Job Category</th>
                        <th>Salary</th>
                        <th>Country</th>

                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                   {{-- <tbody>
                    @foreach($jobConfigs as $jobConfig)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$jobConfig->company->name}}</td>
                            <td>{{$jobConfig->type->name}}</td>
                            <td>{{optional($jobConfig->category)->name}}</td>
                            <td>{{$jobConfig->salary}}</td>
                            <td>{{($jobConfig->cfc_percentage) ? "Cameroon" : "Gabon"}}</td>
                            <td>{{$jobConfig->created_at}}</td>
                            <td>
                                <a href="{{route('job-config.edit', $jobConfig->id)}}" class="btn btn-warning btn-sm">Edit</a>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete_{{$jobConfig->id}}">Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>--}}

                    </thead>
                </table>
            </div>
        </div>
    </div>



@endsection