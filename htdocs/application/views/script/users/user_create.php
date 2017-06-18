
<script src="<?php echo asset_url("js/plugin/bootstrapvalidator/bootstrapValidator.min.js");?>"></script>
<script type="text/javascript">
$(function(){
    //attributeForm
//    var flagCustomer    = 1;


    $('#frmUserAction').bootstrapValidator();
//    .find('select[name="group"]').on('change', function() {
//                var $target = $($(this).data('control-toggle')),
//                    value   = $(this).val();
//
//                if( value == flagCustomer){  // customer only
//                     $target.toggle();
//                     $target.find('select').prop('disabled',false);
//                }else{
//                    $target.hide();
//                    $target.find('select').prop('disabled',true);
//                }
//    });
    
    
    $("#updatePWD").on('click',function(){
        $('input[type=password]',$('#frmUserAction')).prop("disabled", !$('input[type=password]',$('#frmUserAction')).prop("disabled") );
    });
    
});
</script>
