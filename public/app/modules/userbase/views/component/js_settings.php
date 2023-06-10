<script>
    $(document).ready(function() {
        request = $.ajaxq("queue", {
            "url" : "<?php echo base_url("userbase/users/get_data?id=".$this->session->userdata("id").md5($this->session->userdata("name"))); ?>",
            "dataType" : "json",
            "beforeSend" : function(){}
        });
        request.done(function(json){
            $("#form_edit").find("select option").prop("selected", false);
            $("#form_edit").find("input[name=last_username]").val(json.data[0].username);
            $("#form_edit").find("input[name=last_email]").val(json.data[0].email);
            $("#form_edit").find("input[name=name]").val(json.data[0].full_name);
            $("#form_edit").find("input[name=username]").val(json.data[0].username);
            $("#form_edit").find("input[name=email]").val(json.data[0].email);
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
    });
    $(document).on("submit", "#form_edit", function(event){
        event.preventDefault();
        form = $(this);
        $btn = form.find("button[type='submit']");
        request = $.ajaxq("queue", {
            "url" : form.attr("action"),
            "type" : "POST",
            "data" : form.serialize(),
            "dataType" : "json",
            "beforeSend" : function(){
                $btn.button("loading");
            }
        });
        request.done(function(json){
            if(json.success){
                form.find("input[name=last_username]").val(form.find("input[name=username]").val());
                form.find("input[name=last_email]").val(form.find("input[name=email]").val());
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
    $(document).on("submit", "#form_password", function(event){
        event.preventDefault();
        form = $(this);
        $btn = form.find("button[type='submit']");
        request = $.ajaxq("queue", {
            "url" : form.attr("action"),
            "type" : "POST",
            "data" : form.serialize(),
            "dataType" : "json",
            "beforeSend" : function(){
                $btn.button("loading");
            }
        });
        request.done(function(json){
            if(json.success){
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