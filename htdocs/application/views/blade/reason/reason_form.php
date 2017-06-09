<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-plus-square-o'></i> 
                Reason
                <span>>
                    <?php echo (isset($reason) ? "Update" : "Add") ?>
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
                                <?php echo form_hidden('reason_id', isset($reason->reason_id) ? $reason->reason_id : ""); ?>
                                <legend>
                                    เพิ่มเติม/แก้ไขหมายเหตุ
                                </legend>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Reason name</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'name' => 'reason_title',
                                            'class' => 'form-control',
                                            'value' => isset($reason->reason_title) ? $reason->reason_title : "",
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
                                    <label class="col-lg-3 control-label">Reason Description</label>
                                    <div class="col-lg-9">
                                        <?php
                                        $data = array(
                                            'name' => 'reason_desc',
                                            'class' => 'form-control',
                                            'value' => isset($reason->reason_desc) ? $reason->reason_desc : "",
                                            'rows' => 3
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
                                            'class' => 'form-control'
                                        );
                                        $options = array(
                                            1 => 'ใช้งาน',
                                            0 => 'ไม่ใช้งาน'
                                        );
                                        echo form_dropdown('active', $options, isset($reason->active) ? $reason->active : "", $data);
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
                                            <?php echo (isset($reason->reason_id) ? "Update" : "Save") ?>
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
