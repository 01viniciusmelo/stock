<!-- PAGE RELATED PLUGIN(S) 
                <script src="..."></script>-->

<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">

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
        var url = $('#example').data('ajaxUrl');
        var table = $('#example').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "ajax": url,
            "bDestroy": true,
            "iDisplayLength": 15,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "columns": [
                {
                    "class": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "name"},
                {"data": "est"},
                {"data": "contacts"},
                {"data": "status"},
                {"data": "target-actual"},
                {"data": "starts"},
                {"data": "ends"},
                {"data": "tracker"},
            ],
            "order": [[1, 'asc']],
            "fnDrawCallback": function (oSettings) {
                runAllCharts()
            }
        });

    });

</script>