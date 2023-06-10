<script>
    $(document).on("click", ".data-add", function(event){
        event.preventDefault();
        $("#form_add").find("button[type='reset']").click();
        $(".modal-add").modal({backdrop: 'static'});
        $(".modal-add").modal("show");
    });

    $(document).on("submit", "#form_add", function(event){
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
                $(".modal-add").modal("hide");
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
            $(".modal-add").modal("hide");
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