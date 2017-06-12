<div id="content">

    <div class="row">

    </div>


    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">


            <article class="col-sm-12 col-md-12 col-lg-12">
                
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well" id="wid-id-0">
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
                                data-ajax-url="<?php echo site_url('stock/filter')?>"
                                id="example" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No.</th>
                                        <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i>Date</th>
                                        <th>Order Reason</th>
                                        <th>Desc.</th>
                                        <th>Product Name</th>
                                        <th>Qty.</th>
                                        <th>Remaining Stock</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Branch</th>
                                        <th>user login</th>
<!--                                        <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Last Update</th>-->
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