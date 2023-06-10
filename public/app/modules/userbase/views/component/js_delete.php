<script>
    $(document).on("click", ".data-delete", function(event) {
        event.preventDefault();
        $btn = $(this);
        request = $.ajaxq("queue", {
            "url" : $(this).attr("url-api"),
            "dataType" : "json",
            "beforeSend" : function(){
                $("#form_delete").find("button[type='reset']").click();
                $btn.button("loading");
            }
        });
        request.done(function(json){
            $("#form_delete").find("select option").prop("selected", false);
            
            $("#form_delete").find("input[name=id]").val(json.data[0].user_id);
            $("#form_delete").find("input[name=name]").val(json.data[0].full_name);
            
            $(".modal-delete").modal({backdrop: 'static'});
            $(".modal-delete").modal("show");
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
            $btn.button("reset");
        });
        return false;
    });
    $(document).on("submit", "#form_delete", function(event){
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
                $(".modal-delete").modal("hide");
            }
            swal({
                title: json.title,
                text: json.messages,
                icon: 'info',
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
        });
        request.fail(function(jqXHR, textStatus){
            $(".modal-delete").modal("hide");
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