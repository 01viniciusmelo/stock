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
                <?php echo form_hidden($csrf);?>
                <?php echo form_hidden('time', time());?>
                <?php //echo form_open('report/search', 'id="frm-search"') ?>
                <div class="well well-sm">
                    <div class="row">
                        <!--Criteria-->

                        <div class="form-group">
                            <label class="col-lg-2 col-md-2 control-label">File Excel </label>
                            
                                <div class="col-md-8 col-lg-8">
                                    <input type="file" class="btn btn-default" id="upload_excle_file" name="upload_excle_file">
                                    <p class="help-block">
                                        ไฟล์ excel
                                    </p>
                                </div>
                            
                            <div class="col-md-2 col-lg-2"><a href="#template"><i class="fa fa-lg fa-fw fa-file-excel-o"></i> Template</a> </div>

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

        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="font-md"> Example Record <span class="semi-bold">Imported</span><small class="text-danger" > &nbsp;&nbsp;(<span id="countRows">0</span> record)</small></h1>
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
                            <div class="table-responsive">

                                <table id="dt-table-basic" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th data-class="expand">No.</th>
<!--                                            <th data-hide="phone">Arrival Start date</th>
                                            <th data-hide="phone">Finished Date</th>
                                            <th >Truck License</th>
                                            <th data-hide="phone">Truck No.</th>
                                            <th data-hide="phone">Description/รายการ</th>
                                            <th data-hide="phone">Engine Hr</th>
                                            <th data-hide="phone">Electric Hr</th>
                                            <th data-hide="phone">Type of Repair </th>
                                            <th data-hide="phone">Fleet </th>
                                            <th data-hide="phone">Base Repair Site</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>

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

        <!-- end row -->

    </section>
    <!-- end widget grid -->
</div>
