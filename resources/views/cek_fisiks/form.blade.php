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
                            <select name="alatukur_id" id="alatukur" class="form-control">
                                <option value="">-- Choose Alat Ukur --</option>
                                @foreach ($alatukur as $id)
                                <option value="{{ $id->id }}">{{ $id->nama_alat }} || {{ $id->no_seri }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label><strong>Cek Fisik</strong></label><br>
                            <label><input type="checkbox" name="check1" value="1"> 1</label>
                            <label><input type="checkbox" name="check2" value="2"> 2</label>
                            <label><input type="checkbox" name="check3" value="3"> 3</label>
                            <label><input type="checkbox" name="check4" value="4"> 4</label>
                            <label><input type="checkbox" name="check5" value="5"> 5</label>
                        </div>  
                        <div class="form-group">
                            <label >Judge</label>
                            <select name="judge" id="judge" class="form-control">
                                <option value="OK">OK</option>
                                <option value="NG">NG</option>
                            </select >
                        </div>
                        <div class="form-group">
                            <label >Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control">
                            </textarea>
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
