<!-- PAGE RELATED PLUGIN(S)  -->
        

<script src="<?php echo asset_url('js/plugin/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.colVis.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.tableTools.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatable-responsive/datatables.responsive.min.js');?>"></script>

<script type="text/javascript">

    $(document).ready(function () {

        pageSetUp();

        var dtTable = $('#dt-table-ajax').dataTable({
           "iDisplayLength": <?php echo data_table_config('pageLength');?>,
           "ajax": {
                    url: "<?php echo site_url('api/product/all');?>",
                    type: 'GET'
           },
           "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                   "t" +
                   "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
           "autoWidth": true,
           "searching": true,
           "bDestroy": true,
           "oLanguage": {
               "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
           },
            "columns": [
                { "data": "branch_name" },
                { "data": "product_name" },
                { "data": "product_code" },
                { "data": "product_number" },
                { "data": "product_desc" },
                { "data": "product_price_purchasing" },
                { "data": "cat_desc" },
                { "data": "status" },
                { "data": "action" }
            ]
            ,"order": [[1, 'asc']]
       });
    })

</script>