
<script src="<?php echo asset_url("js/plugin/bootstrapvalidator/bootstrapValidator.min.js");?>"></script>
<script type="text/javascript">
$(function(){
    function hideTplExample(){
        $("#template-example-download-EXCEL_TEMPLATE_1").hide();
        $("#template-example-download-EXCEL_TEMPLATE_2").hide();
    }
    // template
    hideTplExample();
    $("select[name=template]").on('change',function(){
        hideTplExample();
        $("#template-example-download-"+$(this).val()).show();
    });

    $('#frm-import').bootstrapValidator()
    .on('success.form.bv', function(e) {
        // Prevent submit form
        //e.preventDefault();
        var $form     = $(e.target),
            validator = $form.data('bootstrapValidator');
        $form.find(':submit').html("Uploading...");
    });
        
});
</script>
