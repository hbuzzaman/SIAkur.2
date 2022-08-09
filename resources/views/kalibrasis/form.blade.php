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
                            <label >Alat Ukur</label>
                            <select name="alatukur_id" id="nama_alat" class="form-control">
                                <option value="">-- Choose Alat Ukur --</option>
                                @foreach ($alatukur as $id)
                                <option value="{{ $id->id }}">{{ $id->nama_alat }} || {{ $id->no_seri}} </option>
                                @endforeach
                                </select>
                                <span class="text-danger with-errors" id="alatError"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Kalibrasi</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tgl_kalibrasi" name="tgl_kalibrasi">
                                <span class="text-danger with-errors" id="tglkError"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Next Kalibrasi</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tgl_nextkalibrasi" name="tgl_nextkalibrasi">
                                <span class="text-danger with-errors" id="tglnextError"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal Sertifikat</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tgl_sertifikat" name="tgl_sertifikat">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Sertifikat</label>
                            <input type="file" class="form-control" id="sertifikat" name="sertifikat">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Status</label>
                            <!-- <input type="text" class="form-control" id="status" name="status"> -->
                            <select name="status" id="status" class="form-control">
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select >
                            <span class="help-block with-errors"></span>
                        </div>


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
