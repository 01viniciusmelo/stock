<!-- PAGE RELATED PLUGIN(S)  -->
<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">



    pageSetUp();

    var dt = $('.order_list').dataTable({
        "pageLength": <?php echo data_table_config('pageLength'); ?>,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "<?php echo site_url('api/order/all'); ?>",
            type: 'GET'
        },
        "autoWidth": true,
        "paging": false,
//        "ordering": true,
        "info": false,
        "bDestroy": true,
        "destroy": true,
//        "searching": false,
        "columns": [
            {"data": "order_no"},
            {"data": "created_at"},
//            {"data": "order_subtotal", render: $.fn.dataTable.render.number(',', '.', 2, '')},
//            {"data": "order_discount", render: $.fn.dataTable.render.number(',', '.', 2, '')},
//            {"data": "order_tax", render: $.fn.dataTable.render.number(',', '.', 2, '')},
            {"data": "order_total", render: $.fn.dataTable.render.number(',', '.', 2, '')},
            {"data": "reason_title"},
            {"data": "branchs_name"},
            {"data": "created_by"},
            {"data": "order_status"},
            {"data": "active"},
            {"data": "action"}
        ]
//        "bFilter": true,
//        "bLengthChange": false
    }).api();

</script>

<style type="text/css">
    div.dt-toolbar{
        display: none;
    }
</style>