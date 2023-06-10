<script>
    $(document).ready(function() {
        $.fn.DataTable.ext.pager.numbers_length = 5;
        oTable = $("#data-table-responsive").DataTable({
            "dom": "<<f>r>t<'row'<'col-sm-4'i><'col-sm-8'p>>",
            "searching":true,
            "language": {
                "search": "",
                "searchPlaceholder": "Search data.."
            },
            "lengthChange":false,
            "info":false,
            "pagingType": "simple_numbers",
            "sorting":[[1, "asc"]],
            "displayLength": 5,
            "responsive": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": false,
            "serverMethod": "POST",
            "ajax":"<?php echo base_url("users/load_data"); ?>",
            "columns": [
                {"data": "no", "class": "text-center", "sortable": false},
                {"data": "full_name", "class": "align-middle"},
                {"data": "username", "class": "align-middle"},
                {"data": "role", "class": "align-middle",
                    render : function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    }
                },
                {"data": "email", "class": "align-middle"},
                {"data": "phone", "class": "align-middle"},
                {"data": "action", "class": "text-center", "searchable":false, "sortable":false}
            ]
        });
        oTable.on('order.dt search.dt', function () {
            oTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    });
</script>