<div id="content">

<div class="row">
    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">

            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-user"></i> 
            <?php echo lang('index_heading'); ?>
        </h1>
    </div>
    <!-- end col -->

    <!-- right side of the page with the sparkline graphs -->
    <!-- col -->
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <!-- sparks -->
        <ul id="sparks">
            <li>
                <a class="btn btn-success" href="<?php echo site_url('user/create'); ?>">Create</a>
            </li>
        </ul>
        <!-- end sparks -->
    </div>

</div>


<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">


        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget well" id="wid-id-0">
                <header>
                    <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                    <h2>Users </h2>	
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
                    <div class="widget-body no-padding">

                        <table id="dt-table-basic" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo lang('index_fname_th'); ?></th>
                                    <th><?php echo lang('index_lname_th'); ?></th>
                                    <th><?php echo lang('index_email_th'); ?></th>
                                    <th><?php echo lang('index_groups_th'); ?></th>
                                    <th><?php echo lang('index_status_th'); ?></th>
                                    <th><?php echo lang('index_action_th'); ?></th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>

    </div>

</section>


</div>