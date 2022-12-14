<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
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
                            <label>Nama</label>
                            <input type="text" class="form-control" id="name" name="name"  autofocus>
                            <span class="text-danger with-errors" id="nameError"></span>
                        </div>

                        <div class="form-group">
                            <label >Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <span class="text-danger with-errors" id="emailError"></span>
                        </div>

                        <div class="form-group">
                            <label >Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--Choose Role--</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Staff">Staff</option>
                                </select >
                                <span class="text-danger with-errors" id="roleError"></span>
                        </div>

                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="text-danger with-errors" id="passwordError"></span>
                        </div>

                        <div class="form-group">
                            <label >Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            <span class="text-danger with-errors"></span>
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
