<?php $this->load->view("userbase/component/js_add"); ?>
<div class="modal fade modal-add" id="modal-dialog">
    <form id="form_add" role="form" action="<?php echo base_url("users/add"); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <?php
                                    $data = array(
                                        "name" => "name",
                                        "class" => "form-control",
                                        "placeholder" => "Full Name",
                                        "required" => "required"
                                    );
                                    echo form_label($data["placeholder"]);
                                    echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    $data = array(
                                        "name" => "username",
                                        "class" => "form-control",
                                        "placeholder" => "Username",
                                        "required" => "required"
                                    );
                                    echo form_label($data["placeholder"]);
                                    echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    $data = array(
                                        "type" => "tel",
                                        "name" => "phone",
                                        "class" => "form-control input-number-add",
                                        "placeholder" => "Phone",
                                        "pattern" => "^(^\+[0-9]\s?|^0)(\d{3,4}-?){2}\d{3,4}$",
                                        "required" => "required"
                                    );
                                    echo form_label($data["placeholder"]." (08xx34567890)");
                                    echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    $data = array(
                                        "type" => "email",
                                        "name" => "email",
                                        "class" => "form-control",
                                        "placeholder" => "Email",
                                        "required" => "required"
                                    );
                                    echo form_label($data["placeholder"]);
                                    echo form_email($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Photo</label>
                                <input type="file" class="file-add hide" name="user_img" id="upPhoto" accept=".jpg" />
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-md" readonly placeholder="Upload Image" style="background:#fff;color:#000;border-left:none">
                                    <div class="input-group-append">
                                        <button class="browse-add btn btn-grey btn-md full-width" type="button" style="border-left:none"><i class="fa fa-folder-open"></i> Browse</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <img id="photo-preview" class="hide" style="object-fit:cover;width:100%" src="#" alt="Photo" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        FormPlugins.init();

        $(".input-number-add").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 32, 107]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                // Allow: Ctrl/cmd+C
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+X
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: +
                (e.keyCode == 187 && (e.shiftKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#photo-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#upPhoto").change(function() {
            $('#photo-preview').removeClass('hide');
            readURL(this);
        });

        $(document).on('click', '.browse-add', function(){
            var file = $(this).parent().parent().parent().find('.file-add');
            file.trigger('click');
        });

        $(document).on('change', '.file-add', function(){
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    });
</script>