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

                <div class="jarviswidget jarviswidget-sortable" id="wid-id-2" <?php echo jarviswidget_table_config() ?> role="widget">

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

                    <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div>
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
                                        <th>Country</th>
                                        <th>Visits</th>
                                        <th class="text-align-center">User Activity</th>
                                        <th class="text-align-center hidden-xs">Online</th>
                                        <th class="text-align-center">Demographic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0);">USA</a></td>
                                        <td>4,977</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="50" height="22" style="display: inline-block; width: 50px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs">143</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0);">Australia</a></td>
                                        <td>4,873</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="50" height="22" style="display: inline-block; width: 50px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs">247</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0);">India</a></td>
                                        <td>3,671</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="50" height="22" style="display: inline-block; width: 50px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs">373</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0);">Brazil</a></td>
                                        <td>2,476</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="54" height="22" style="display: inline-block; width: 54px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs ">741</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0);">Turkey</a></td>
                                        <td>1,476</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="50" height="22" style="display: inline-block; width: 50px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs">123</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0);">Canada</a></td>
                                        <td>146</td>
                                        <td class="text-align-center">
                                            <div class="sparkline txt-color-orange text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2"><canvas width="50" height="22" style="display: inline-block; width: 50px; height: 22px; vertical-align: top;"></canvas></div></td>
                                        <td class="text-align-center hidden-xs">23</td>
                                        <td class="text-align-center">
                                            <div class="sparkline display-inline" data-sparkline-type="pie" data-sparkline-piecolor="[&quot;#E979BB&quot;, &quot;#57889C&quot;]" data-sparkline-offset="90" data-sparkline-piesize="23px"><canvas width="23" height="23" style="display: inline-block; width: 23px; height: 23px; vertical-align: top;"></canvas></div>
                                            <div class="btn-group display-inline pull-right text-align-left hidden-tablet">
                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-cog fa-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-xs pull-right">
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>P</u>DF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"><i class="fa fa-times fa-lg fa-fw txt-color-red"></i> <u>D</u>elete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li class="text-align-center">
                                                        <a href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div></td>
                                    </tr>
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

        </div>

</div>

</div>