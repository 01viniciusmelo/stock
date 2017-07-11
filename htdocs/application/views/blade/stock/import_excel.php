<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-lg fa-fw fa-file-excel-o"></i>
                Export 
            </h1>
        </div>

    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo form_open_multipart(current_url(), 'id="frm-import"') ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('time', time()); ?>
                <?php //echo form_open('report/search', 'id="frm-search"') ?>
                <div class="well well-sm">
                    <div class="row">
                        <!--Criteria-->
                        
                        
                    <div class="form-group">
                        <label class="col-lg-2 col-md-2 control-label">Excel Template</label>
                        <div class="col-md-5 col-lg-5">                                    
                            <select class="form-control" name="template"
                                    data-bv-notempty="true"
                                    data-bv-notempty-message="The template is required and cannot be empty">
                                <option value="">Choose a Customer</option>
                                <?php foreach ($import_templates as $key => $tpl_name): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $tpl_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="note"> Template</p>
                        </div>
                        <div class="col-md-5 col-lg-5">
                            <?php foreach ($import_templates as $key => $tpl_name): ?>
                                <a style="display:none" id="template-example-download-<?php echo "{$key}" ?>" href="<?php echo site_url("stock/import/download/{$key}.xlsx"); ?>"><i class="fa fa-lg fa-fw fa-file-excel-o"></i><?php echo "$key"; ?></a> 
                            <?php endforeach; ?>
                        </div>
                    </div>
                        
                    </div>
                    <div class="row">

                        <div class="form-group">
                            <label class="col-lg-2 col-md-2 control-label">File Excel </label>

                            <div class="col-md-7 col-lg-7">
                                <input type="file" class="btn btn-default" id="upload_excle_file" name="upload_excle_file">
                                <p class="help-block">
                                    ไฟล์ excel
                                </p>
                            </div>
                        </div>                
                    </div>







                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-"></i>
                            Upload
                        </button>
                    </div>


                </div>
                <?php form_close() ?>
            </article>


        </div>


    </section>
    <!-- end widget grid -->
</div>
