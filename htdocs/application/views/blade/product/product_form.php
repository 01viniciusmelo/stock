<div id="content">
    <?php
    if (validation_errors()):
        echo "<div class='alert alert-danger fade in'>" . validation_errors() . "</div>";
    endif;
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-plus'></i> 
                Product
                <span>>
                    <?php echo (isset($product) ? "Update" : "Add") ?>
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
            <article class="col-sm-10 col-md-10 col-lg-10 sortable-grid ui-sortable">
                <div class="jarviswidget jarviswidget-sortable">
                    <div class="widget-body form-no-head">
                        <form id="frmUserAction"  class="form-horizontal" action="<?php echo current_url() ?>" method="post"
                              data-bv-message="This value is not valid"
                              data-bv-live="disabled"
                              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh"
                              enctype="multipart/form-data">
                            <fieldset>
                                <?php echo form_hidden('product_id', isset($product->product_id) ? $product->product_id : ""); ?>
                                <legend>
                                    เพิ่มเติม/แก้ไขสินค้า
                                </legend>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product name</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'name' => 'product_name',
                                            'class' => 'form-control',
                                            'value' => isset($product->product_name) ? $product->product_name : "",
                                            'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                            'required' => 'required'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product Description</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'name' => 'product_desc',
                                            'class' => 'form-control summernote',
                                            'value' => isset($product->product_desc) ? $product->product_desc : "",
                                            'rows' => 3
                                        );
                                        echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product Category</label>
                                    <div class="col-lg-3">
                                        <?php
                                        $data = array(
                                            'class' => 'form-control select2'
                                        );
                                        echo form_dropdown('cat_id', $category, isset($product->cat_id) ? $product->cat_id : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product price selling</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'product_price_selling',
                                                'class' => 'form-control',
                                                'value' => isset($product->product_price_selling) ? $product->product_price_selling : 0,
                                                'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                                'type' => 'number'
                                            );
                                            echo form_input($data);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        </div>
                                    </div>


                                    <label class="col-lg-3 control-label">Product price purchasing</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'product_price_purchasing',
                                                'class' => 'form-control',
                                                'value' => isset($product->product_price_purchasing) ? $product->product_price_purchasing : 0,
                                                'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                                'type' => 'number'
                                            );
                                            echo form_input($data);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        </div>
                                    </div>
                                </div>


                            </fieldset>
                            <!--
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Units</label>
                                    <div class="col-lg-3">
                            <?php
                            $data = array(
                                'name' => 'unit',
                                'class' => 'form-control',
                                'value' => isset($product->unit) ? $product->unit : "",
                                'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                                    </div>
                                </div>
                            </fieldset>
                            -->
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Quantity</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'quantity',
                                                'class' => 'form-control',
                                                'value' => isset($product->quantity) ? $product->quantity : 0,
                                                'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                                'type' => 'number'
                                            );
                                            echo form_input($data);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-3 control-label">Units</label>
                                    <div class="col-lg-3">
                                        <?php
                                        $data = array(
                                            'name' => 'unit',
                                            'class' => 'form-control',
                                            'value' => isset($product->unit) ? $product->unit : "",
                                            'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                            'required' => 'required'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product Code</label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'product_code',
                                                'class' => 'form-control',
                                                'value' => isset($product->product_code) ? $product->product_code : ""
                                            );
                                            echo form_input($data);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">สินค้าเข้าที่</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $attr = array(
                                            'class' => 'form-control select2'
                                        );
                                        echo form_dropdown('product_branch_origin', $branchs, isset($product->product_branch_origin) ? $product->product_branch_origin : "", $attr);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <!--<hr/>-->
                            <fieldset>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Product Gallery</label>
                                    <div class="col-lg-9">
                                        <label class="control-label">Upload Product images</label>
                                        <input id="product-upload" name="product-upload[]" type="file" accept="image/*"  multiple class="file-loading" data-url-delete="<?php echo site_url('product/image/delete')?>" data-product-images="<?php echo isset($images) && sizeof($images) ? htmlspecialchars(json_encode($images), ENT_QUOTES, 'UTF-8'): null; ?>">                                        
                                    </div>
                                </div>
                            </fieldset>
                            <hr/>
                            <fieldset>

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
                                        echo form_dropdown('active', $options, isset($product->active) ? $product->active : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
                                            <?php echo (isset($product->product_id) ? "Update" : "Save") ?>
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
