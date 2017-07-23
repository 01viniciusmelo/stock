<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-lg fa-fw fa-file-excel-o"></i>
                Report 
            </h1>
        </div>

    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo form_open(current_url(), 'id="frm-report-branch" class="form-horizontal"') ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('download_hash',$download_hash); ?>                
                <?php echo form_hidden('fields', json_encode($fields)); ?>
                <?php echo form_hidden('time', time()); ?>

                <div class="well">
                    <div class="row">
                        <!--Criteria-->

                        <fieldset >

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Branch/Site</label>
                                <div class="col-lg-5">

                                    <select class="form-control" name="branch"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="The Branch is required and cannot be empty">
                                        <option value="0">ALL</option>
                                        <?php foreach ($branchs as $bRow): ?>
                                            <option <?php echo (set_value('branch') == $bRow->id ? "selected" : "") ?>  value="<?php echo $bRow->id; ?>"><?php echo $bRow->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--<p class="note"> สาขา</p>-->
                                </div>
                            </div>
                        </fieldset>

                        <fieldset >

                            <div class="form-group">
                                <label class="col-md-2 control-label">Group by</label>
                                <div class="col-md-10">
                                    <label class="checkbox-inline">
                                        <input name="is_group_product" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_group_product') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Product</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input name="is_group_branch" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_group_branch') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Branch/Site</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input name="is_group_category" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_group_category') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Category</span>
                                    </label>
                                    <!--<p class="note"> สาขา</p>-->
                                </div>

                            </div>

                        </fieldset>
                        <!--
                        <fieldset >

                            <div class="form-group">
                                <label class="col-md-2 control-label">Summary</label>
                                <div class="col-md-10">
                                    <label class="checkbox-inline">
                                        <input name="is_sum_product" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_sum_product') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Product</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input name="is_sum_price" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_sum_price') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Price</span>
                                    </label>
                                    <label class="checkbox-inline">
                                        <input name="is_sum_category" type="checkbox" class="checkbox style-0" <?php echo (set_value('is_sum_category') == "1" ? "checked" : "") ?>  value="1" >
                                        <span>Category</span>
                                    </label>                                  
                                </div>

                            </div>

                        </fieldset>

                        -->

                    </div>


                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-"></i>
                            Submit
                        </button>
                    </div>


                </div>
                <?php form_close() ?>
            </article>


        </div>


        <!-- row -->
        <div class="row">


            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >


                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well" id="wid-table-area" <?php echo jarviswidget_table_config(); ?> >
                    <!--
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Jobs / PO</h2>
                    </header>
                    -->
                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->                            
                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <p>
                                <a id="lnkExcel" href="<?php echo site_url("report/download/excel/".$download_hash );?>"><i class="fa fa-lg fa-fw fa-file-excel-o"></i> Download Excel </a>
                            </p>
                            <div class="table-responsive">

                                <table id="dt-table-basic" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>                     
                                            <?php foreach($fields as $k=> $field):?>
                                            <th data-name="<?php echo $k ?>"><?php echo $field; ?></th>
                                            <?php endforeach;?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($reportData)): ?>
                                        
                                            <?php foreach ($reportData as $row): ?>
                                                <tr>                                            
                                                    <?php foreach($fields as $key=>$name):?>
                                                    <td><?php echo $row->{$key}; ?></td>
                                                    <?php endforeach;?>
                                                </tr>
                                            <?php endforeach; ?>     
                                        
                                        <?php endif ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>

            <!-- NEW WIDGET START -->


        </div>


    </section>
    <!-- end widget grid -->
</div>
