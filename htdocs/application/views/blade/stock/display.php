<div id="content">

    <div class="row">

    </div>


    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">


            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert alert-info">
                    <strong>NOTE:</strong> All the data is loaded from a seperate JSON file
                </div>

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
                                data-ajax-url="<?php echo site_url('stock/filter')?>"
                                id="example" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th><th>Projects</th><th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> EST</th>
                                        <th>Contacts</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-circle txt-color-darken font-xs"></i> Target/ <i class="fa fa-circle text-danger font-xs"></i> Actual</th>
                                        <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Starts</th>
                                        <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Ends</th>
                                        <th>Tracker</th>
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