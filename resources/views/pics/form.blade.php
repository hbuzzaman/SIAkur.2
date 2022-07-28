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
                            <label >ID Karyawan</label>
                            <input type="text" class="form-control" id="idkaryawan" name="idkaryawan"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Nama PIC</label>
                            <input type="text" class="form-control" id="nama_pic" name="nama_pic"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Departemen</label>
                            {!! Form::select('departemen_id', $departemen, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Departemen --', 'id' => 'departemen_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
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
