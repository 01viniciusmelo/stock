<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-lg fa-fw fa-file-excel-o"></i>
                Export Review
            </h1>
        </div>

    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <div class="well well-sm">
                    <div class="row">
                        <!--Criteria-->

                        <div class="form-group">
                            <label class="col-lg-2 col-md-2 control-label">File Excel </label>
                            
                                <div class="col-md-7 col-lg-7">
                                    <p><?php echo !empty($filename) ? $filename[0]->filename : "";?></p>
                                </div>
                            
                            <div class="col-md-3 col-lg-3">
                                <a class="btn btn-primary" href="<?php echo site_url("stock/import/approved/{$code}");?>" >
                                    <i class="fa fa-save"></i> 
                                    Approve
                                </a>
                                &nbsp;&nbsp;
                                <a class="btn btn-default" href="<?php echo site_url("stock/import/reject/{$code}");?>">
                                    Reject
                                </a>
                            </div>

                        </div>
                    </div>
                    
                </div>
                
            </article>


        </div>

        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="font-md">Record <span class="semi-bold">Imported</span><small class="text-danger" > &nbsp;&nbsp;(<span id="countRows"><?php echo !empty($total) ? $total[0]->cnt : 0;?></span> record)</small></h1>
                <p class="small">Example record</p>
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
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Part Name</th>
                                            <th>Part No</th>
                                            
                                            <th>QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($examples)):?>
                                        <?php foreach($examples as $row):?>
                                        <tr>
                                            <td><?php echo $row->category;?></td>
                                            <td><?php echo $row->location;?></td>
                                            <td>
                                                <?php echo $row->part_name;?>
                                                <?php if($row->exists == 0 ): ;?>
                                                <span class="label label-success pull-right" >NEW</span>
                                                <?php endif?>
                                            </td>
                                            <td><?php echo $row->part_no;?></td>                                            
                                            <td><?php echo $row->qty?></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <?php endif?>
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
