<div id="content">

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul id="sparks" class="">
                <li class="sparks-info">
                    <h5> Stocks <span class="txt-color-blue">47,171</span></h5>
                    <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm"><canvas width="89" height="26" style="display: inline-block; width: 89px; height: 26px; vertical-align: top;"></canvas></div>
                </li>
                <li class="sparks-info">
                    <h5> Transfer <span class="txt-color-purple">&nbsp;45</span></h5>
                    <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm"><canvas width="82" height="26" style="display: inline-block; width: 82px; height: 26px; vertical-align: top;"></canvas></div>
                </li>
                <li class="sparks-info">
                    <h5> Orders <span class="txt-color-greenDark">&nbsp;2447</span></h5>
                    <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm"><canvas width="82" height="26" style="display: inline-block; width: 82px; height: 26px; vertical-align: top;"></canvas></div>
                </li>
            </ul>
        </div>
    </div>


    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">


            <article class="col-sm-8 col-md-8 col-lg-8 sortable-grid ui-sortable">

                <div class="jarviswidget" id="wid-id-1" <?php echo jarviswidget_table_config() ?> >

                    <header>
                        <span class="widget-icon"> <i class="fa fa-building-o"></i> </span>
                        <h2>Branch</h2>
                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                    </header>

                    <!-- widget div-->
                    <div role="content">
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <div>
                                <label>Title:</label>
                                <input type="text">
                            </div>
                        </div>
                        <!-- end widget edit box -->

                        <div class="widget-body no-padding">

                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Stock</th>
                                        <th class="text-align-center">Transfer</th>
                                        <th class="text-align-center hidden-xs">Order</th>
                                        <th class="text-align-center">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0;$i<6;$i++):?>
                                    <tr>
                                        <td><a href="javascript:void(0);"><?php echo "branch-$i"?></a></td>
                                        <td><?php echo rand(1000, 9000);?></td>
                                        <td class="text-align-center"><?php echo rand(50, 80);?></td>
                                        <td class="text-align-center hidden-xs"><?php echo rand(100, 500)?></td>
                                        <td class="text-align-center"> xxxxxx </td>
                                    </tr>
                                    <?php endfor?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pagination-xs no-margin">
                                                <li class="prev disabled">
                                                    <a href="javascript:void(0);">Previous</a>
                                                </li>
                                                <li class="active">
                                                    <a href="javascript:void(0);">1</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">2</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">3</a>
                                                </li>
                                                <li class="next">
                                                    <a href="javascript:void(0);">Next</a>
                                                </li>
                                            </ul></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- end content -->

                        </div>

                    </div>
                    <!-- end widget div -->
                </div>

            </article>
            
            <article class="col-sm-4 col-md-4 col-lg-4 sortable-grid ui-sortable">
                <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-6" <?php echo jarviswidget_table_config() ?> >
                            <header>
                                    <span class="widget-icon"> <i class="fa fa-pie-chart"></i> </span>
                                    <h2>Pie Chart</h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                            <div id="pie-chart" class="chart"></div>

                                    </div>
                                    <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                    </div>
                    <!-- end widget -->
            </article>

        </div>
        
        
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
                LAYOUT 2.1
            </article>
            <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
                LAYOUT 2.2
            </article>
        </div>

</div>

</div>