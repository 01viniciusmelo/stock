<?php //var_dump($user); ?>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class="fa fa-lg fa-fw fa-user"></i>
                User
                <span>>
                    <?php echo (isset($user) ? "Update" : "Add") ?> Role
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
                <div class="jarviswidget jarviswidget-sortable">

                    <!--                    <header>
                                                                                                    <h2>User </h2>
                                                                                            </header>-->

                    <div class="widget-body form-no-head" >

                        <form id="frmUserAction"  class="form-horizontal" action="<?php echo current_url() ?>" method="post"
                              data-bv-message="This value is not valid"
                              data-bv-live="disabled"
                              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                            <fieldset>
                                <?php //echo form_hidden($csrf); ?>
                                <?php echo form_hidden('id', isset($user) ? $user->id : ""); ?>
                                <legend>
                                    user and add them to this site.
                                    <p class="note"> ผู้ใช้งาน ระบบ</p>
                                </legend>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Role name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="group_name" placeholder="Role Name" value="<?php echo set_value('group_name', $group_name) ?>"
                                               data-bv-notempty="true"
                                               data-bv-notempty-message="The role name is required and cannot be empty" />
                                        <p class="note"> ชื่อ</p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Role Description</label>

                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="description" placeholder="Description" value="<?php echo set_value('description', $description) ?>"
                                               data-bv-notempty="true"

                                               data-bv-notempty-message="The description role is required and cannot be empty" />
                                        <p class="note"> คำอธิบาย</p>
                                    </div>
                                </div>
                            </fieldset>




                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
                                            <?php echo (isset($user) ? "Update" : "Save") ?>
                                        </button>
                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>

            </article>

        </div>

        <!-- row -->
        <div class="row">

        </div>

        <!-- end row -->

    </section>
    <!-- end widget grid -->
</div>
