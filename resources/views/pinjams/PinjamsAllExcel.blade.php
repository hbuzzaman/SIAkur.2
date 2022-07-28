{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
{{--<!-- Font Awesome -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
{{--<!-- Ionicons -->--}}
{{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

{{--<title>Peminjaman Exports All PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #pinjams {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #pinjams td, #pinjams th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #pinjams tr:nth-child(even){background-color: #f2f2f2;}

    #pinjams tr:hover {background-color: #ddd;}

    #pinjams th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="pinjams" width="100%">
    <thead>
    <tr>
        <td>ID</td>
        <td>Nama Peminjam</td>
        <td>Nama Alat</td>
        <td>Tanggal Pinjam</td>
        <td>Tanggal Kembali</td>
        <td>Departemen</td>
    </tr>
    </thead>
    @foreach($pinjams as $p)
        <tbody>
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nama_peminjam }}</td>
            <td>{{ $p->alatukur->nama_alat }}</td>
            <td>{{ $p->tgl_pinjam }}</td>
            <td>{{ $p->tgl_kembali }}</td>
            <td>{{ $p->departemen->nama_departemen }}</td>
        </tr>
        </tbody>
    @endforeach

</table>


{{--<!-- jQuery 3 -->--}}
{{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


