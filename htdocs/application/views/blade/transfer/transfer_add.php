<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-truck'></i> 
                Add Transfer Request
            </h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <ul id="sparks">
                <li class="sparks-info">
                    <?php //echo anchor('transfer/create_transfer', "<i class='fa-fw fa fa-plus'></i> Add new transfer request", "class='btn btn-primary'") ?>
                </li> 
            </ul>
        </div>
    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-11 col-md-11 col-lg-11 sortable-grid ui-sortable">
                <div class="jarviswidget jarviswidget-sortable">
                    <div class="widget-body">
                        <form id="frmAction"  class="form-horizontal" action="<?php echo current_url() ?>" method="post"
                              data-bv-message="This value is not valid"
                              data-bv-live="disabled"
                              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                            <fieldset>
                                <legend>
                                    Transfer product 
                                    <p class="note"> โอนย้ายสินค้า</p>
                                </legend>
                            </fieldset>

                            <fieldset>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ID</label>

                                    <div class="col-lg-5">
                                        <input class="form-control" readonly="" name="id" type="text" value="<?php echo set_value('id', $id) ?>"/>
                                        <p class="note"> รายการ</p>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Form</label>
                                    <div class="col-lg-5">
                                        <?php
                                        $attr = array(
                                            'class' => 'form-control select2'
                                        );
                                        echo form_dropdown('branch_from', $branchs, isset($branch_from) ? $branch_from : "", $attr);
                                        ?>
                                        <p class="note"> โอนสินค้าจาก</p>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">To</label>
                                    <div class="col-lg-5">
                                        <?php
                                        $attr = array(
                                            'class' => 'form-control select2'
                                        );
                                        echo form_dropdown('branch_to', $branchs, isset($branch_to) ? $branch_to : "", $attr);
                                        ?>
                                        <p class="note"> สินค้าเข้าที่</p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Date</label>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="actiondate" placeholder="Select a date" class="form-control datepicker" data-dateformat="<?php echo config_item('date_format_js'); ?>"
                                                   value="<?php echo set_value('actiondate', $actiondate == "" ? format_date_time(date('Y-m-d')) : format_date_time($actiondate)) ?>"
                                                   data-bv-notempty="true"
                                                   data-bv-notempty-message="The Date start is required and cannot be empty">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <p class="note">วันที่ </p>

                                    </div>
                                </div>
                            </fieldset>
                            <hr/>
                            <fieldset>
                                <p>
                                    <button class="btn btn-default" type="button" data-product="add"><i class="fa fa-fw fa-plus"></i> </button>
                                </p>
                                <table id="dt-table-ajax" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" >
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Product No.</th>
                                            <th>Qty.</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php foreach($products as $product):?>
                                        <tr>
                                            <td>
                                                <?php echo $product->product_id;?>
                                                <?php
                                                $data = array(
                                                    'data-max'=> isset($product->product_id) ? $product->product_id : NULL,
                                                    'name' => 'product_id',
                                                    'value' => isset($product->product_id) ? $product->product_id : "",
                                                );
                                                echo form_hidden($data);
                                                ?>
                                            </td>
                                            <td><?php echo $product->product_name;?></td>
                                            <td><?php echo $product->product_number;?></td>
                                            <td width="200">
                                                <?php
                                                $data = array(
                                                    'data-max'=> isset($product->stock_qty_remaining) ? $product->stock_qty_remaining : 0,
                                                    'name' => 'stock',
                                                    'class' => 'form-control spinner-both',
                                                    'value' => isset($product->stock_qty_remaining) ? $product->stock_qty_remaining : "",
                                                    'data-bv-notempty-message' => 'The title is required and cannot be empty',
                                                    'required' => 'required'
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </fieldset>
                            
                            
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit">
                                            <?php echo (isset($user) ? "Update" : "Save")?>
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


