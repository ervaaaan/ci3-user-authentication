<script>
    $(document).on("click", ".data-edit", function(event) {
        event.preventDefault();
        $btn = $(this);
        request = $.ajaxq("queue", {
            "url" : $(this).attr("url-api"),
            "dataType" : "json",
            "beforeSend" : function(){
                $("#form_edit").find("button[type='reset']").click();
                $btn.button("loading");
            }
        });
        request.done(function(json){
            $("#form_edit").find("button[type='reset']").click();
            $("#form_edit").find("select option").prop("selected", false);
            $("#form_edit").find("input, select, button:not(.btn-danger)").prop("disabled", false);
            
            $("#form_edit").find("input[name=id]").val(json.data[0].user_id);
            $("#form_edit").find("input[name=last_username]").val(json.data[0].username);
            $("#form_edit").find("input[name=last_email]").val(json.data[0].email);
            $("#form_edit").find("input[name=user_name]").val(json.data[0].full_name);
            $("#form_edit").find("input[name=user_username]").val(json.data[0].username);
            $("#form_edit").find("input[name=user_email]").val(json.data[0].email);
            $("#form_edit").find("input[name=user_phone]").val(json.data[0].phone);
            $("#form_edit").find("select[name=user_role] option[value='"+json.data[0].role+"']").prop("selected", true);
            if (typeof variable !== 'undefined') {
                $("#form_edit").find("img[id=edit-photo-preview]").prop("src", '<?php echo base_url("assets/img/users/"); ?>'+json.data[0].user_id+".jpg");
            } else {
                $("#form_edit").find("img[id=edit-photo-preview]").prop("src", '<?php echo base_url("assets/img/users/default.jpg"); ?>');
            }
            
            $(".modal-edit").modal({backdrop: 'static'});
            $(".modal-edit").modal("show");
            $(".selectpicker").selectpicker("refresh");
            $btn.button("reset");
        });
        request.fail(function(jqXHR, textStatus){
            swal({
                title: 'Request failed',
                text: textStatus,
                icon: 'error',
                buttons: {
                    confirm: {
                        text: 'OK',
                        value: true,
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true
                    }
                }
            }).then (function() {
                location.reload();
            });
        });
        return false;
    });
    $(document).on("submit", "#form_edit", function(event){
        event.preventDefault();
        form = $(this);
        formData = $(this)[0];
        $btn = form.find("button[type='submit']");
        request = $.ajaxq("queue", {
            "url" : form.attr("action"),
            "type" : "POST",
            "data" : new FormData(formData),
            "dataType" : "json",
            "cache": false,
            "contentType": false,
            "processData": false,
            "beforeSend" : function(){
                $btn.button("loading");
            }
        });
        request.done(function(json){
            if(json.success){
                form.find("input[name=last_username]").val(form.find("input[name=username]").val());
                form.find("input[name=last_email]").val(form.find("input[name=email]").val());
                $(".modal-edit").modal("hide");
                swal({
                    title: json.title,
                    text: json.messages,
                    icon: 'success',
                    buttons: {
                        confirm: {
                            text: 'OK',
                            value: true,
                            visible: true,
                            className: 'btn btn-info',
                            closeModal: true
                        }
                    }
                }).then (function() {
                    location.reload();
                });
            }
            else {
                swal({
                    title: json.title,
                    text: json.messages,
                    icon: 'error',
                    buttons: {
                        confirm: {
                            text: 'OK',
                            value: true,
                            visible: true,
                            className: 'btn btn-danger',
                            closeModal: true
                        }
                    }
                });
            }
        });
        request.fail(function(jqXHR, textStatus){
            form.find("input[name=last_username]").val(form.find("input[name=username]").val());
            form.find("input[name=last_email]").val(form.find("input[name=email]").val());
            $(".modal-edit").modal("hide");
            swal({
                title: 'Request failed',
                text: textStatus,
                icon: 'error',
                buttons: {
                    confirm: {
                        text: 'OK',
                        value: true,
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true
                    }
                }
            }).then (function() {
                location.reload();
            });
        });
        return false;
    });
</script>