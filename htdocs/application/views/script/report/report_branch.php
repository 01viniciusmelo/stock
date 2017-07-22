<!-- PAGE RELATED PLUGIN(S)  -->
<script src="<?php echo asset_url('js/plugin/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.colVis.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.tableTools.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatables/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/datatable-responsive/datatables.responsive.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugin/bootstrapvalidator/bootstrapValidator.min.js');?>"></script>

<script type="text/javascript">

    $(document).ready(function () {

        pageSetUp();

        var dtTable = $('#dt-table-basic').dataTable({
           "pageLength": <?php echo data_table_config('pageLength');?>,
           "ajax": {
                url: "<?php echo site_url('api/Report/Branch')?>",
                type:"post",
                data: function ( d ) {                    
                    return $('form').serialize();
                }
            },           
           "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                   "t" +
                   "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
           "autoWidth": true,
           "searching": true,
           "bDestroy": true,
           "oLanguage": {
               "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
           }
//           "columns": function(){
//               $('#dt-table-basic thead th').each(function(i,e){
//                   console.log(i)
//                   console.log(e)
//               });
//               
//               return []
//           }


       }).api();
       
       //
       $('form').bootstrapValidator();
    })

</script>