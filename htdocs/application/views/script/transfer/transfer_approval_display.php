<!-- PAGE RELATED PLUGIN(S)  -->
<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">



    pageSetUp();

    var dt = $('.transfer_list').dataTable({
        "pageLength": <?php echo data_table_config('pageLength'); ?>,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "<?php echo site_url('api/transfer_approve/all'); ?>",
            type: 'GET'
        },
        "autoWidth": true,
        "paging": false,
        "info": false,
        "bDestroy": true,
        "destroy": true,
        "columns": [
            {"data": "order_no"},
            {"data": "created_at"},
            {"data": "order_total", render: $.fn.dataTable.render.number(',', '.', 2, '')},
            {"data": "reason_title"},
            {"data": "branchs_name"},
            {"data": "branchs_name_to"},
            {"data": "created_by"},
            {"data": "order_status"},

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