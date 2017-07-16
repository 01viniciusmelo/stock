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
                <?php echo form_open(current_url(), 'id="frm-import"') ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('time', time()); ?>
                
                <div class="well well-sm">
                    <div class="row">
                        <!--Criteria-->
                        
                            <fieldset  id="customer-panel">
                                <hr>
                                <div class="form-group">
                                <label class="col-lg-3 control-label">Branch/Site</label>
                                <div class="col-lg-5">
                                    
                                    <select class="form-control" name="branch"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="The Branch is required and cannot be empty">
                                        <option value="0">ALL</option>
                                        <?php foreach($branchs as $bRow ):?>
                                        <option <?php echo (set_value('branch') == $bRow->id ? "selected":"")?>  value="<?php echo $bRow->id;?>"><?php echo $bRow->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <p class="note"> สาขา</p>
                                </div>
                                </div>
                            </fieldset>
                        
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
                            <div class="table-responsive">

                                <table id="dt-table-basic" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>                                            
                                            <th>Product Name</th>
                                            <th>Product Code</th>                                            
                                            <th>Branch Name</th>                                            
                                            <th>Qty (Remain)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($reportData)):?>
                                        <?php foreach($reportData as $row):?>
                                        <tr>                                            
                                            <td><?php echo $row->product_name;?></td>
                                            <td><?php echo $row->product_code;?></td>
                                            <td><?php echo $row->branch_name;?></td>
                                            <td><?php echo $row->stock_qty_remaining;?></td>
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


    </section>
    <!-- end widget grid -->
</div>
