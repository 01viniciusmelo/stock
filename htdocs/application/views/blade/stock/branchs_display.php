<div id="content">
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-university "></i> 
                Stock >> <?php echo "{$branch->name}";?>

            </h1>
        </div>

        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul id="sparks">
                <li class="sparks-info">
                    <?php //echo anchor('branchs/add', "<i class='fa-fw fa fa-plus'></i> Add new branchs", "class='btn btn-primary'") ?>
                </li> 
            </ul>
        </div>
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
                        <h2><?php echo "{$branch->name}";?> </h2>	
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

                            <table id="dt-table-ajax" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                                   data-branch-id="<?php echo $branch->id;?>"
                                   >
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Product No.</th>
                                    <th>Price</th>
                                    <th>Qty.</th>
                                    <th>Action</th>
                                </tr>
                                
                            </thead>
                            <tbody></tbody>
                        </table>

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