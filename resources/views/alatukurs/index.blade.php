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

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary">Add Alat Ukur</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="alatukurs-table" class="table table-striped">
                <thead>
                <tr>
                    <th >No.</th>
                    <th>Nama Alat</th>
                    <th>Nomor Seri</th>
                    <th>Nomor Registrasi</th>
                    <!-- <th>Range</th>
                    <th>Resolusi</th>
                    <th>Maker</th> -->
                    <th>Tanggal Plan</th>
                    <th>Tanggal Actual</th>
                    <!-- <th>Departemen</th>
                    <th>Lokasi Alat Ukur</th>
                    <th>Frekuensi</th> -->
                    <th>Gambar</th>
                    <th>Status Alat</th>
                    <!-- <th>Sertifikat</th> -->
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('alatukurs.form')

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

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script>
        $(function () {
            //Date picker
            $('#tgl_plan').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })
            $('#tgl_actual').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })
            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()
            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

    <script type="text/javascript">
        var table = $('#alatukurs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.alatukurs') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'nama_alat', name: 'nama_alat'},
                {data: 'no_seri', name: 'no_seri'},
                {data: 'no_reg', name: 'no_reg'},
                {data: 'tgl_plan', name: 'tgl_plan'},
                {data: 'tgl_actual', name: 'tgl_actual'},
                {data: 'show_photo', name: 'show_photo'},
                {data: 'new', name: 'new'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Alatukurs');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            // document.getElementById('hhh').style.visibility="hidden"; //
            $.ajax({
                url: "{{ url('alatukurs') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Alatukurs');

                    $('#id').val(data.id);
                    $('#nama_alat').val(data.nama_alat);
                    $('#no_seri').val(data.no_seri);
                    $('#no_reg').val(data.no_reg);
                    $('#range').val(data.range);
                    $('#resolusi').val(data.resolusi);
                    $('#maker_id').val(data.maker_id);
                    $('#tgl_plan').val(data.tgl_plan);
                    $('#tgl_actual').val(data.tgl_actual);
                    $('#departemen_id').val(data.departemen_id);
                    $('#lokasi_alatukur_id').val(data.lokasi_alatukur_id);
                    $('#frekuensi').val(data.frekuensi);
                    $('#kondisi').val(data.kondisi);
                    $('#status').val(data.status);
                    $('#nama_pic').val(data.pic_id);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('alatukurs') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('alatukurs') }}";
                    else url = "{{ url('alatukurs') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error:function (response) {
                            $('#namaError').text(response.responseJSON.errors.nama_alat);
                            $('#no_seriError').text(response.responseJSON.errors.no_seri);
                            $('#no_regError').text(response.responseJSON.errors.no_reg);
                            $('#rangeError').text(response.responseJSON.errors.range);
                            $('#resolusiError').text(response.responseJSON.errors.resolusi);
                            $('#makerError').text(response.responseJSON.errors.maker_id);
                            $('#tglplanError').text(response.responseJSON.errors.tgl_plan);
                            $('#tglactError').text(response.responseJSON.errors.tgl_actual);
                            $('#departemenError').text(response.responseJSON.errors.departemen_id);
                            $('#lokasiError').text(response.responseJSON.errors.lokasi_alatukur_id);
                            $('#frekuensiError').text(response.responseJSON.errors.frekuensi);
                            $('#kondisiError').text(response.responseJSON.errors.kondisi);
                            $('#statusError').text(response.responseJSON.errors.status);
                            $('#picError').text(response.responseJSON.errors.pic_id);
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
