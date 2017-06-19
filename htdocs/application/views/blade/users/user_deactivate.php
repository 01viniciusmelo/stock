<div id="content">
<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">

            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-user"></i> 
            <?php echo lang('index_heading'); ?>
<!--            <span>&gt;<?php echo lang('index_subheading'); ?></span>-->
        </h1>
    </div>
    <!-- end col -->

    <!-- right side of the page with the sparkline graphs -->
    <!-- col -->
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
    </div>
    <!-- end col -->

</div>


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget well" id="wid-id-0">
                <header>
                    <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                    <h2>deactivate </h2>	
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                        <input class="form-control" type="text">	
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <h1><?php echo lang('deactivate_heading'); ?></h1>
                        <?php echo form_open("user/deactivate/" . $user->id, "class=\"form-horizontal\""); ?>
                        <?php echo form_hidden($csrf); ?>
                        <?php echo form_hidden(array('id'=>$user->id)); ?>
                        <fieldset>
                            <legend>
                                <?php echo sprintf(lang('deactivate_subheading'), $user->username); ?>
                            </legend>

                            <div class="form-group">

                                <!--<label class="col-md-2 control-label">Inline</label>-->
                                <div class="col-md-5">
                                    <label class="radio radio-inline">
                                        <input type="radio" class="radiobox" name="confirm" value="yes" checked="checked" />
                                        <span> <?php echo lang('deactivate_confirm_y_label'); ?></span> 

                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" class="radiobox" name="confirm" value="no" />
                                        <span> <?php echo lang('deactivate_confirm_n_label'); ?></span>  
                                    </label>
                                    <br/>
                                    <br/>
                                    <p>
                                        <button class="btn btn-danger" type="submit"><?php echo lang('deactivate_submit_btn'); ?></button>
                                    </p>
                                </div>

                            </div>

                        </fieldset>
                        
                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- row -->

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-12">
            <!-- your contents here -->
        </div>

    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->

</div>