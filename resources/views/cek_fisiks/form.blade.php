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
                            <select name="alatukur_id" id="alatukur" class="form-control">
                                <option value="">-- Choose Alat Ukur --</option>
                                @foreach ($alatukur as $id)
                                    <option value="{{ $id->id }}">{{ $id->nama_alat }} || {{ $id->no_seri }}</option>
                                @endforeach
                            </select>
                                <span class="text-danger with-errors" id="namaError"></span>
                        </div>
                        <div class="form-group">
                            <label>Cek fisik 1</label>
                            <select name="check1" id="alatukur" class="form-control">
                                <option value="">--Cek Fisik 1--</option>
                                    <option value="1">OK</option>
                                    <option value="0">NG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cek fisik 2</label>
                            <select name="check2" id="alatukur" class="form-control">
                                <option value="">--Cek Fisik 2--</option>
                                    <option value="1">OK</option>
                                    <option value="0">NG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cek fisik 3</label>
                            <select name="check3" id="alatukur" class="form-control">
                                <option value="">--Cek Fisik 3--</option>
                                    <option value="1">OK</option>
                                    <option value="0">NG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cek fisik 4</label>
                            <select name="check4" id="alatukur" class="form-control">
                                <option value="">--Cek Fisik 4--</option>
                                    <option value="1">OK</option>
                                    <option value="0">NG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cek fisik 5</label>
                            <select name="check5" id="alatukur" class="form-control">
                                <option value="">--Cek Fisik 5--</option>
                                    <option value="1">OK</option>
                                    <option value="0">NG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Judge</label>
                            <select name="judge" id="judge" class="form-control">
                                <option value="OK">OK</option>
                                <option value="NG">NG</option>
                            </select>
                            <span class="text-danger with-errors" id="judgeError"></span>
                        </div>

                        <div class="form-group">
                            <label >Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
