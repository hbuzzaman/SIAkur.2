@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Data Alat Ukur</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            {{-- <table id="alatukurs-table" class="table table-striped"> --}}
            <table id="p" class="dataTables_wrapper form-inline dt-bootstrap" style="width:100%">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Alatt</th>
                    <th>Nomor Seri</th>
                    <th>Nomor Registrasi</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($status as $akur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $akur->nama_alat }}</td> 
                        <td>{{ $akur->no_seri }}</td> 
                        <td>{{ $akur->no_reg }}</td>
                        <td>{{ $akur->status }}</td>
                        <!-- asset('storage/'.$alatukurz->gambar) -->
                        <td><img class="rounded-square" width="50" height="50" src="{{asset('storage/'.$akur->gambar)}}" alt=""></td>
                        <td>
                            <a href="/alatukurs/{{$akur->id}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a>
                            <a onclick="editForm('. $alatukurz->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a onclick="deleteData('. $alatukurz->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('bot')

<script>
    $(document).ready( function () {
    $('#p').DataTable();
    });
</script>

    <!-- DataTables -->
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    
    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    

@endsection
