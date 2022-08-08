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
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Alat Ukur</h3>
                </div>
                <div class="box-body">
                    <div class="text-center">
                        <img src="{{ asset('storage/'.$akur->gambar) }}" alt="gambar" class="img-square" width="200" height="200">
                    </div>
                    @if ($new <= $akur->created_at)
                        <h2 class="gambar-nama text-center">{{ $akur->nama_alat }} (<span style="color:rgb(44, 183, 93)">New</span>)</h2>
                    @else
                        <h2 class="gambar-nama text-center">{{ $akur->nama_alat }}</h2>
                    @endif

                    <div class="row">

                        <div class="col-md-6">
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;Nomor Seri: 
                                <p>&nbsp;<strong>{{ $akur->no_seri }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;Nomor Registrasi: 
                                <p>&nbsp;<strong>{{ $akur->no_reg }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;Range: 
                                <p>&nbsp;<strong>{{ $akur->range }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;Resolusi: 
                                <p>&nbsp;<strong>{{ $akur->resolusi }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;Maker: 
                                <p>&nbsp;<strong>{{ $akur->maker->nama_maker }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                &nbsp;PIC Alat:
                                <p>&nbsp;<strong>{{ $akur->pic->nama_pic }}</strong></p>
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <h4>
                                <i class="text-muted"></i>
                                Tanggal Kalibrasi: 
                                <p><strong>{{ $akur->tgl_plan }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                Tanggal Efective: 
                                <p><strong>{{ $akur->tgl_actual }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                Departemen: 
                                <p><strong>{{ $akur->departemen->nama_departemen }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                Section: 
                                <p><strong>{{ $akur->lokasi_alatukur->lokasi_alatukur }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                Freq. Kalibrasi: 
                                <p><strong>{{ $akur->frekuensi }}</strong></p>
                            </h4>
                            <h4>
                                <i class="text-muted"></i>
                                Riwayat Kalibrasi: 
                                <p><strong>{{ $count }}</strong></p>
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Sertifikat</h3>
                </div>
                <div class="box-body">
                    <div class="text-center">
                        @foreach ($kb as $id)
                        <img src="{{ asset('storage/'.$id->sertifikat) }}" alt="sertifikat" class="img-square" width="400" height="300">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat Kalibrasi</h3>
                </div>
                <div class="box-body">
                    {{-- <table id="p" class="dataTables_wrapper form-inline dt-bootstrap" style="width:100%"> --}}
                    <table id="p" class="table table-striped table-bordered table-responsive" style="width:100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Alat Ukur</th>
                            <th>Tanggal Kalibrasi</th>
                            <th>Tanggal Next Kalibrasi</th>
                            <th>Tanggal Sertifikat</th>
                            <th>Sertifikat</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kalibrasis as $kal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kal->alatukur->nama_alat }}</td> 
                            <td>{{ $kal->tgl_kalibrasi }}</td> 
                            <td>{{ $kal->tgl_nextkalibrasi }}</td>
                            <td>{{ $kal->tgl_sertifikat }}</td>
                            <td><img class="rounded-square" width="50" height="50" src="{{asset('storage/'.$kal->sertifikat)}}" alt=""></td>
                            <td>{{ $kal->status }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</section>
@endsection

@section('bot')
    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
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

    <script>
        $(document).ready( function () {
            $('#p').DataTable();
        });
    </script>
@endsection