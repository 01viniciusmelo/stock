<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-plus-square-o'></i> 
                Category
                <span>>
                    <?php echo (isset($cat) ? "Update" : "Add") ?>
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
                              data-bv-message="This value is not valid"
                              data-bv-live="disabled"
                              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                            <fieldset>
                                <?php echo form_hidden('cat_id', isset($cat->cat_id) ? $cat->cat_id : ""); ?>
                                <legend>
                                    เพิ่มเติม/แก้ไขประเภทหรือหมวดหมู่สินค้า
                                </legend>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Category name</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $data = array(
                                            'name' => 'cat_name',
                                            'class' => 'form-control"',
                                            'value' => isset($cat->cat_name) ? $cat->cat_name : "",
                                            'data-bv-notempty-message' => 'The name is required and cannot be empty'
                                        );
                                        echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Category Description</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $data = array(
                                            'name' => 'cat_desc',
                                            'class' => 'form-control"',
                                            'value' => isset($cat->cat_desc) ? $cat->cat_desc : ""
                                        );
                                        echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $data = array(
                                            'class' => 'form-control"'
                                        );
                                        $options = array(
                                            1 => 'ใช้งาน',
                                            0 => 'ไม่ใช้งาน'
                                        );
                                        echo form_dropdown('active', $options, isset($cat->active) ? $cat->active : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
                                            <?php echo (isset($cat->cat_id) ? "Update" : "Save") ?>
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
