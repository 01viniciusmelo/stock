<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo asset_url('js/plugin/pace/pace.min.js'); ?>"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->

<script>
    if (!window.jQuery) {
        document.write('<script src="<?php echo asset_url('js/libs/jquery-2.1.1.min.js'); ?>"><\/script>');
    }
</script>


<script>
    if (!window.jQuery.ui) {
        document.write('<script src="<?php echo asset_url('js/libs/jquery-ui-1.10.3.min.js'); ?>"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo asset_url('js/app.config.js'); ?>"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo asset_url('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js'); ?>"></script> 

<!-- BOOTSTRAP JS -->
<script src="<?php echo asset_url('js/bootstrap/bootstrap.min.js'); ?>"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo asset_url('js/notification/SmartNotification.min.js'); ?>"></script>

<!-- JARVIS WIDGETS -->
<script src="<?php echo asset_url('js/smartwidgets/jarvis.widget.min.js'); ?>"></script>

<!-- EASY PIE CHARTS -->
<script src="<?php echo asset_url('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js'); ?>"></script>

<!-- SPARKLINES -->
<script src="<?php echo asset_url('js/plugin/sparkline/jquery.sparkline.min.js'); ?>"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo asset_url('js/plugin/jquery-validate/jquery.validate.min.js'); ?>"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo asset_url('js/plugin/masked-input/jquery.maskedinput.min.js'); ?>"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo asset_url('js/plugin/select2/select2.min.js'); ?>"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?php echo asset_url('js/plugin/bootstrap-slider/bootstrap-slider.min.js'); ?>"></script>

<!-- browser msie issue fix -->
<script src="<?php echo asset_url('js/plugin/msie-fix/jquery.mb.browser.min.js'); ?>"></script>

<!-- FastClick: For mobile devices -->
<script src="<?php echo asset_url('js/plugin/fastclick/fastclick.min.js'); ?>"></script>


<!-- IMPORTANT: AJAX MANAGER -->
<script src="<?php echo asset_url('js/ajaxManager.js'); ?>"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<!--<script src="<?php echo asset_url('js/demo.min.js'); ?>"></script>-->

<!-- MAIN APP JS FILE -->
<script src="<?php echo asset_url('js/app.min.js'); ?>"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="<?php echo asset_url('js/speech/voicecommand.min.js'); ?>"></script>

<!-- SmartChat UI : plugin -->
<script src="<?php echo asset_url('js/smart-chat-ui/smart.chat.ui.min.js'); ?>"></script>
<script src="<?php echo asset_url('js/smart-chat-ui/smart.chat.manager.min.js'); ?>"></script>



<script type="text/javascript">
// DO NOT REMOVE : GLOBAL FUNCTIONS!
    $(document).ready(function () {
        pageSetUp();
        
        
        // global function
        function goBack() {
            window.history.back();
        }
        
        
        $('body').on('click',"button[data-page='back']",function(){
            goBack();
        });
        
    })

</script>
