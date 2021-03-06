<div id="content">
    <?php
    if (validation_errors()):
        echo "<div class='alert alert-danger fade in'>" . validation_errors() . "</div>";
    endif;
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-plus-square-o'></i> 
                Request Form
                <span>>
                    <?php echo (isset($stock) ? "Update" : "Add") ?>
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

        </div>
    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-8 col-md-8 col-lg-8 sortable-grid ui-sortable">
                <div class="jarviswidget well jarviswidget-sortable">
                    <div class="widget-body">
                        <form id="frmUserAction"  class="form-horizontal" action="<?php echo current_url() ?>" method="post"

                              enctype="multipart/form-data">

                              <?php echo form_hidden('stock_id', isset($stock->stock_id) ? $stock->stock_id : ""); ?>

                              <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'class' => 'form-control'
                                        );
                                        echo form_dropdown('product_id', $product, isset($stock->product_id) ? $stock->product_id : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">จำนวน</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'stock_qty_ori',
                                                'class' => 'form-control',
                                                'value' => isset($stock->stock_qty_ori) ? $stock->stock_qty_ori : null,
                                                'data-bv-notempty-message' => 'The Qty is required and cannot be empty',
                                                'type' => 'number'
                                            );
                                           
                                            echo form_input($data);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                        </div>
                                        <p class="note">Original Qty</p>
                                    </div>
                                    
                                </div>
                            </fieldset>

                            <fieldset>
                                
                                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">สาขาที่ต้องการสั่งของ</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'class' => 'form-control'
                                        );
                                        echo form_dropdown('branchs_id', $branchs, isset($stock->branchs_id) ? $stock->branchs_id : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            

                            

                            <fieldset>
                                <legend>
                                </legend>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $data = array(
                                            'class' => 'form-control'
                                        );
                                        $options = array(
                                            1 => 'ใช้งาน',
                                            0 => 'ไม่ใช้งาน'
                                        );
                                        echo form_dropdown('active', $options, isset($stock->active) ? $stock->active : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
                                            <?php echo (isset($stock->stock_id) ? "Update" : "Save") ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
