<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

                    <div class="box-body">
                        <div class="form-group">
                            <label >Nama Alat</label>
                            <input type="text" class="form-control" id="nama_alat" name="nama_alat"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Nomor Seri</label>
                            <input type="text" class="form-control" id="no_seri" name="no_seri"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Nomor Registrasi</label>
                            <input type="text" class="form-control" id="no_reg" name="no_reg"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Range</label>
                            <input type="text" class="form-control" id="range" name="range"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Resolusi</label>
                            <input type="text" class="form-control" id="resolusi" name="resolusi"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Maker</label>
                            {!! Form::select('maker_id', $maker, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Maker --', 'id' => 'maker_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Plan</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tgl_plan" name="tgl_plan"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Actual</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tgl_actual" name="tgl_actual">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Departemen</label>
                            {!! Form::select('departemen_id', $departemen, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Departemen --', 'id' => 'departemen_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Lokasi Alat Ukur</label>
                            {!! Form::select('lokasi_alatukur_id', $lokasi_alatukur, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Section --', 'id' => 'lokasi_alatukur_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Frekuensi</label>
                            <input type="text" class="form-control" id="frekuensi" name="frekuensi" >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Kondisi</label>
                            <!-- <input type="text" class="form-control" id="status" name="status"> -->
                            <select name="kondisi" id="kondisi" class="form-control">
                                <option value="OK">OK</option>
                                <option value="Rusak">Rusak</option>
                            </select >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Status</label>
                            <!-- <input type="text" class="form-control" id="status" name="status"> -->
                            <select name="status" id="status" class="form-control">
                                <option value="Reguler">Reguler</option>
                                <option value="Spare">Spare</option>
                            </select >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >PIC Alat</label>
                            <select name="pic_id" id="nama_pic" class="form-control">
                            <option value="">-- Choose PIC --</option>
                                @foreach ($pic as $id)
                                <option value="{{ $id->id }}">{{ $id->nama_pic}}</option>
                                @endforeach
`                           </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <!-- <div class="form-group">
                            <label >Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat" >
                            <span class="help-block with-errors"></span>
                        </div> -->

                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
