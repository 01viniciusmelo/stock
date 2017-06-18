<?php //var_dump($user);?>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class="fa fa-lg fa-fw fa-user"></i>
                User
                <span>>
                    <?php echo (isset($user) ? "Update" : "Add")?> User
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <!--<a class="btn btn-success pull-right" href="<?php echo site_url('user/add') ?>">Add User</a>-->
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

                        <form id="frmUserAction"  class="form-horizontal" action="<?php echo current_url()?>" method="post"
                              data-bv-message="This value is not valid"
                              data-bv-live="disabled"
                              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                            <fieldset>
                                <?php echo form_hidden($csrf); ?>
                                <?php echo form_hidden('id', isset($user) ? $user->id : "");?>
                                <legend>
                                    user and add them to this site.
                                    <p class="note"> ผู้ใช้งาน ระบบ</p>
                                </legend>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Full name</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="firstName" placeholder="First name" value="<?php echo set_value('firstName',$firstName)?>"
                                               data-bv-notempty="true"
                                               <?php echo (isset($user) ? "readonly" : "")?>
                                               data-bv-notempty-message="The first name is required and cannot be empty" />
                                                <p class="note"> ชื่อ</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="lastName" placeholder="Last name" value="<?php echo set_value('lastName',$lastName)?>"
                                               data-bv-notempty="true"
                                               <?php echo (isset($user) ? "readonly" : "")?>
                                               data-bv-notempty-message="The last name is required and cannot be empty" />
                                        <p class="note"> นามสกุล</p>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email address</label>
                                    <div class="col-lg-5">
                                        <input class="form-control" name="email" type="email" value="<?php echo set_value('email',$email)?>"
                                               <?php echo (isset($user) ? "readonly=\"readonly\"" : "")?>
                                               data-bv-notempty="true"
                                               data-bv-notempty-message="The password is required and cannot be empty"

                                               data-bv-emailaddress="true"
                                               data-bv-emailaddress-message="The input is not a valid email address" />
                                            <p class="note"> อีเมล</p>
                                    </div>
                                </div>
                            </fieldset>


                             <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Phone</label>
                                    <div class="col-lg-5">
                                        <input class="form-control" name="phone" type="text" value="<?php echo set_value('phone',$phone)?>"/>
                                            <p class="note"> เบอร์โทรศัพท์</p>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Password</label>
                                    <div class="col-lg-5">
                                        <input type="password" class="form-control" name="password"
                                               <?php echo (isset($user) ? "disabled=\"disabled\"" : "")?>

                                               data-bv-notempty="true"
                                               data-bv-notempty-message="The password is required and cannot be empty"

                                               data-bv-identical="true"
                                               data-bv-identical-field="confirmPassword"
                                               data-bv-identical-message="The password and its confirm are not the same"

                                                data-bv-stringlength="true"
                                                data-bv-stringlength-min="<?php echo $this->config->item('min_password_length', 'ion_auth')?>"
                                                data-bv-stringlength-max="<?php echo $this->config->item('max_password_length', 'ion_auth')?>"
                                                data-bv-stringlength-message="The password must be more than <?php echo config_item('min_password_length')?> and less than <?php echo $this->config->item('min_password_length', 'ion_auth')?> characters long"

                                               data-bv-different="true"
                                               data-bv-different-field="username"
                                               data-bv-different-message="The password cannot be the same as username" />
                                        <p class="note"> กรอกรหัสผ่าน สำหรับเข้าใช้งาน</p>
                                    </div>
                                    <?php if(isset($user) && $this->session->userdata('user_id')  == $user->user_id ) :?>
                                    <button type="button" id="updatePWD" class="btn btn-default">Update password</button>
                                    <?php endif?>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Retype password</label>
                                    <div class="col-lg-5">
                                        <input type="password" class="form-control" name="confirmPassword" <?php echo (isset($user) ? "disabled=\"disabled\"" : "")?> data-bv-notempty="true" data-bv-notempty-message="The confirm password is required and cannot be empty" data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="The password and its confirm are not the same" data-bv-different="true" data-bv-different-field="username" data-bv-different-message="The password cannot be the same as username" data-bv-field="confirmPassword"><i class="form-control-feedback" data-bv-icon-for="confirmPassword" style="display: none;"></i>
                                        <small class="help-block" data-bv-validator="different" data-bv-for="confirmPassword" data-bv-result="NOT_VALIDATED" style="display: none;">The password cannot be the same as username</small><small class="help-block" data-bv-validator="identical" data-bv-for="confirmPassword" data-bv-result="NOT_VALIDATED" style="display: none;">The password and its confirm are not the same</small><small class="help-block" data-bv-validator="notEmpty" data-bv-for="confirmPassword" data-bv-result="NOT_VALIDATED" style="display: none;">The confirm password is required and cannot be empty</small>
                                        <p class="note"> กรอกรหัสผ่าน สำหรับเข้าใช้งาน อีกครั้ง</p>
                                    </div>

                                </div>
                            </fieldset>
                            <?php if ($this->ion_auth->is_admin()): ?>
                             <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Role</label>
                                    <div class="col-lg-5">
                                        <select name="group" class="form-control"
                                            data-control-toggle="#customer-panel"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="The Role is required and cannot be empty">
                                        <option value="">Choose a role</option>
                                        <?php foreach($groups as $group):?>
                                        <option <?php echo (isset($currentGroups) && $currentGroups[0]->id == $group['id'] ? "selected" :"") ;?> value="<?php echo $group['id']?>"><?php echo ucfirst($group['name'])?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="note"> สิทธิการเข้าใช้ระบบ</p>
                                    </div>

                                </div>
                            </fieldset>
                            <?php endif;?>

                            <fieldset  id="customer-panel">
                                <hr>
                                <div class="form-group">
                                <label class="col-lg-3 control-label">Branch/Site</label>
                                <div class="col-lg-5">
                                    
                                    <select class="form-control" name="branch"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="The Branch is required and cannot be empty">
                                        <option value="">Choose a Customer</option>
                                        <?php foreach($branchs as $branch ):?>
                                        <option <?php echo (isset($user) && $user->branch == $branch->id ? "selected":"")?>  value="<?php echo $branch->id;?>"><?php echo $branch->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <p class="note"> สาขา</p>
                                </div>
                                </div>
                            </fieldset>




                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" type="submit">
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

        <!-- row -->
        <div class="row">

        </div>

        <!-- end row -->

    </section>
    <!-- end widget grid -->
</div>
