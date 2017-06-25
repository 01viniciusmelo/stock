<!-- PAGE RELATED PLUGIN(S) -->
<style type="text/css">
    .ui-datepicker{
        z-index: 99 !important;
    }
    </style>

<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>
<script type="text/javascript">
    $(function () {
        pageSetUp();


        var dateFormat = "<?php echo config_item('date_format_js');?>";
        
        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
        
        $(".spinner-both").spinner({
            min: 0,
            max:$(".spinner-both").data('max')
          });
        
        // START AND FINISH DATE
        var actionDate = $("input[name='actiondate']").datepicker({
            defaultDate: 0,
            dateFormat:dateFormat,
            changeMonth: false,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
        })


        $("[data-product='add']").on('click',function(){
            alert('xx');
        });
        /*
         * SmartAlerts
         */
        // With Callback
        $("[data-confirm]").click(function (e) {
            var $this = $(this);
            var title = $this.data('msg') || "Smart Alert!";
            var content = $this.data('content') || "This is a confirmation box. Can be programmed for button callback";


            $.SmartMessageBox({
                title: title,
                content: content,
                buttons: '[No][Yes]'
            }, function (ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    $this.closest('tr').addClass('animated fadeOutUp');
                    setTimeout(callHref, 500);
                }

            });

            function callHref() {
                window.location = $this.attr('href');
            }

            e.preventDefault();

        });
        
        
        
        $("#frmAction").on('submit',function(e){
           // e.preventDefault();
        });
        
    });
</script>