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
        
        
        // columns form PHP
        <?php 
        $tmpCols = array();
        foreach($fields as $k=> $field):
            array_push($tmpCols, "{ \"data\": \"$k\" }");                            
        endforeach;
        ?>        
        var columns = [ <?php echo implode(",", $tmpCols);?> ];;
        var dtTable = $('#dt-table-basic').dataTable({
           "pageLength": <?php echo data_table_config('pageLength');?>,
           "serverSide": true,
           //"processing": true,
           "ajax": {
                url: "<?php echo site_url('api/Report/Branch')?>",
                type:"post",
                data: function ( d ) {                                        
                    var form =$('form').serialize();                    
                    return $.extend({},d,{form:form});
                }
            },           
           "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                   "t" +
                   "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
           "autoWidth": true,
           "searching": false,
           "bDestroy": true,
           "oLanguage": {
               "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'               
           },
           "columns": columns
           ,"order": [[0, 'asc']]

       }).api();
       
       
       // download
//       $("#lnkExcel").on('click',function(e){
//            e.preventDefault();            
//       });
       
       $('form').bootstrapValidator();
//       $('form').bootstrapValidator().on('success.form.bv', function(e) {
//            // Prevent form submission
//            e.preventDefault();
//            
//            var $form = $(e.target),
//                bv    = $(e.target).data('bootstrapValidator');           
//                
//                
//            $('form').find('button').prop('disabled',true)
//            // Data table
//             // Get the column API object
//            var column = dtTable.column( $(this).attr('data-column') );
//            column.visible();
//            dtTable.ajax.reload();
//            // Then submit the form as usual
//            bv.resetForm();
//        });;
    }); // end jquery ready

</script>