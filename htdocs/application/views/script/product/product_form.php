<!-- PAGE RELATED PLUGIN(S)  -->
<link href="<?php echo asset_url('js/plugin/bootstrap-fileinput-master/css/fileinput.min.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo asset_url('js/plugin/bootstrap-fileinput-master/js/fileinput.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {
        // upload
        var pImg = $("#product-upload").data('product-images');        
        
        if ( typeof pImg == "object" ){
            var initialPreview = [],initialPreviewConfig = [];
            $.each(pImg,function(i,d){      
                //console.log(d)
                initialPreview.push(d.url);
                initialPreviewConfig.push({
                    caption: d.image_name,
                    width: d.image_data.image_width+"px",
                    url: d.delete_url,
                    key:d.image_id,
                    size:d.image_data.file_size * 1024
                });
            });
            
            $("#product-upload").fileinput({
                initialPreview: initialPreview,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                //deleteUrl: $("#product-upload").data('url-delete'),
                overwriteInitial: false,
                maxFileSize: 1024,
                showUpload: false,
                initialCaption: "Browse images not over 1MB"
            }).on("filepredelete", function(jqXHR) {
                var abort = true;
                if (confirm("Are you sure you want to delete this image?")) {
                    abort = false;
                }
                return abort; // you can also send any data/object that you can receive on `filecustomerror` event
            });
        }else{
             $("#product-upload").fileinput({              
                overwriteInitial: false,
                maxFileSize: 1024,
                showUpload: false,
                initialCaption: "Browse images not over 1MB"
            }).on("filepredelete", function(jqXHR) {         
                return confirm("Are you sure you want to delete this image?"); // you can also send any data/object that you can receive on `filecustomerror` event
            });
        }
        

        
        
        // select
        $("input[name='quantity'],input[name='product_code']").on("click", function () {
            $(this).select();
        });
    });
//     Dropzone.options.myDropzone = {
//    init: function() {
//      this.on("addedfile", function(file) {
//
//        // Create the remove button
//        var removeButton = Dropzone.createElement("<button>Remove file</button>");
//
//
//        // Capture the Dropzone instance as closure.
//        var _this = this;
//
//        // Listen to the click event
//        removeButton.addEventListener("click", function(e) {
//          // Make sure the button click doesn't submit the form:
//          e.preventDefault();
//          e.stopPropagation();
//
//          // Remove the file preview.
//          _this.removeFile(file);
//          // If you want to the delete the file on the server as well,
//          // you can do the AJAX request here.
//        });
//
//        // Add the button to the file preview element.
//        file.previewElement.appendChild(removeButton);
//      });
//    }
//  };
</script>