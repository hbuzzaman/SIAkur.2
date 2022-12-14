@extends('layouts.master')

@section('top')
@endsection
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@section('content')
    <div class="row">
        <div class="box">
            <div class="box-body">
            <div class="callout callout-success">
            <a href="/masterjadwal" class="btn btn-primary pull-right" style="margin-top: -8px;">Master Schedule</a>
            <a href="/alatukur/reguler" class="btn btn-primary pull-right" style="margin-top: -8px;">Reguler</a>
            <a href="/alatukur/spare" class="btn btn-primary pull-right" style="margin-top: -8px;">Spare</a>
                <h4>Success</h4>

                <p>{{ session('status') }} You are logged in!</p>
            </div>
            </div>
        </div>
    </div>
<!-- Small boxes (Stat box) -->
    <div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ \App\User::count() }}</h3>
                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Alatukur::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Alat Ukur</p>
            </div>
            <div class="icon">
                <i class="ion ion-wrench"></i>
            </div>
            <a href="{{ route('alatukurs.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Pic::count() }}</h3>
                <p>PIC</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('pics.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ \App\Pinjam::count() }}</h3>
                <p>Peminjaman</p>
            </div>
            <div class="icon">
                <i class="ion ion-clipboard"></i>
            </div>
            <a href="{{ route('pinjams.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ \App\LokasiAlatukur::count() }}</h3>

                <p>Lokasi Alat Ukur</p>
            </div>
            <div class="icon">
                <i class="ion ion-navigate"></i>
            </div>
            <a href="{{ route('lokasi_alatukurs.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ \App\Kalibrasi::count() }}</h3>
                <p>Riwayat Kalibrasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-document-text"></i>
            </div>
            <a href="{{ route('kalibrasis.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray">
            <div class="inner">
                <h3>{{ $count  }}</h3>

                <p>Alat Ukur Rusak</p>
            </div>
            <div class="icon">
                <i class="ion ion-location"></i>
            </div>
            <a href="/alatukursr" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <h4>Pimpinan: <strong>Aminudin</strong></h4>
        <h4>PIC Kalibrasi: <strong>Aziz</strong></h4>
    </div>
</div>

<div class="row">
    <div class="box-body table-responsive">
        {{-- <table id="p" class="dataTables_wrapper form-inline dt-bootstrap" style="width:100%"> --}}
        <table id="p" class="table table-striped table-bordered " style="width:100%">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama Alat Ukurr</th>
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
                <td>{{ date("d-m-Y", strtotime($kal->tgl_kalibrasi))}}</td>
                    @if($kal->tgl_nextkalibrasi<=now())
                    <td><span class="label label-danger">{{date("d-m-Y", strtotime($kal->tgl_nextkalibrasi))}}</span></td>
                    @elseif( date('Y-m-d H:i:s', strtotime($kal->tgl_nextkalibrasi . ' -5 day')) < now() && now() < $kal->tgl_nextkalibrasi)
                    <td><span class="label label-warning">{{date("d-m-Y", strtotime($kal->tgl_nextkalibrasi))}}</span></td>
                    @else
                    <td><span class="label label-primary">{{date("d-m-Y", strtotime($kal->tgl_nextkalibrasi))}}</span></td>
                    @endif
                <td>{{ date("d-m-Y", strtotime($kal->tgl_sertifikat))}}</td>
                <td><img class="rounded-square" width="50" height="50" src="{{asset('storage/'.$kal->sertifikat)}}" alt=""></td>
                <td>{{ $kal->status }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('bot')
    <!-- DataTables -->
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#p').DataTable();
        });
    </script>
@endsection
