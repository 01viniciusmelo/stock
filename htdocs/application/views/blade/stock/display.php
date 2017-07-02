<div id="content">

    <div class="row">
        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-cube"></i> 
                All Product in Stock

            </h1>
        </div>

        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul id="sparks">
                <li class="sparks-info">
                    <?php echo anchor('stock/add', "<i class='fa-fw fa fa-plus'></i> Add new product to stock", "class='btn btn-primary'") ?>
                </li> 
            </ul>
        </div>
    </div>


    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">


            <article class="col-sm-12 col-md-12 col-lg-12">
                <!--
                <div class="alert alert-info">
                    <strong>NOTE:</strong> All the data is loaded from a seperate JSON file
                </div>
                -->
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well" id="wid-id-0">
                    <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                            
                            data-widget-colorbutton="false"	
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true" 
                            data-widget-sortable="false"
                            
                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Widget Title </h2>				

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

                            <table 
                                data-ajax-url="<?php echo site_url('stock/filter') ?>"
                                id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <!--
                                    <tr>
                                        <th class="hasinput" style="width:20%">
                                            <input type="text" class="form-control" placeholder="Find Branch" />
                                        </th>
                                        <th class="hasinput" style="width:30%">
                                            <input type="text" class="form-control" placeholder="Filter Product Number" />
                                        </th>

                                        <th class="hasinput">
                                            <input type="text" class="form-control" placeholder="Qty" />
                                        </th>
                                        <th class="hasinput">
                                            <input type="text" class="form-control" placeholder="Qty Remaining" />
                                        </th>
                                        <th class="hasinput icon-addon">
                                            <input id="dateselect_filter" type="text" placeholder="Date" class="form-control datepicker" data-dateformat="yy/mm/dd">
                                            <label for="dateselect_filter" class="glyphicon glyphicon-calendar no-margin padding-top-15" rel="tooltip" title="" data-original-title="Purchase Date"></label>
                                        </th>
                                        <th class="hasinput" style="width:12%">
                                            <input type="text" class="form-control" placeholder="Active" />
                                        </th>
                                        <th width="100"></th>

                                    </tr>
                                    -->

                                    <tr>

                                        <th>Branch</th>
                                        <th>Product Number</th>
                                        <th>Qty</th>
                                        <th>Qty Remaining</th>
                                        <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Last Update</th>
                                        <th>Active</th>
                                        <th>Action</th>
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

</div>
</div>