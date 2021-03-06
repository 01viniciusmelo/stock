<!-- PAGE RELATED PLUGIN(S) 
                <script src="..."></script>-->

<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">
    var table;
    $(document).ready(function () {

        pageSetUp();


        /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">' +
                    '<tr>' +
                    '<td style="width:100px">Project Title:</td>' +
                    '<td>' + d.name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Deadline:</td>' +
                    '<td>' + d.ends + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Extra info:</td>' +
                    '<td>And any further details here (images etc)...</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Comments:</td>' +
                    '<td>' + d.comments + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Action:</td>' +
                    '<td>' + d.action + '</td>' +
                    '</tr>' +
                    '</table>';
        }

        // clears the variable if left blank
        //var url = $('#example').data('ajaxUrl');
        table = $('#example').DataTable({
           "pageLength": <?php echo data_table_config('pageLength');?>,
           "ajax": {
                    url: "<?php echo site_url('api/stock/all');?>",
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
                {"data": "branchs_name"},
                {"data": "product_name"},
                {"data": "stock_qty_ori"},
                {"data": "stock_qty_remaining"},
                {"data": "updated_at"},
                {"data": "active"},
                {"data": "action"}
            ]
        });
        /* END COLUMN FILTER */

    });
//    $("#example thead th input[type=text]").on('keyup change', function () {
//
//       
//    });

</script>