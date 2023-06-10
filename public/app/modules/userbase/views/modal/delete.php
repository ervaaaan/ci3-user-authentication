<?php $this->load->view("userbase/component/js_delete"); ?>
<div class="modal fade modal-delete" id="modal-dialog">
    <form id="form_delete" role="form" action="<?php echo base_url("users/delete"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <?php echo form_hidden("id", ""); ?>
                    <?php echo form_hidden("name", ""); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="note note-danger m-b-0">
                                <div class="note-icon f-s-20">
                                    <i class="fa fa-exclamation-triangle fa-2x"></i>
                                </div>
                                <div class="note-content">
                                    <h4 class="m-t-5 m-b-5 p-b-2">Are you sure want to delete this user?</h4>
                                    <p>You will not be able to recover this action!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        FormPlugins.init();
    });
</script>