<div id="content">

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-colorbutton="false">
                   
                    <header>
                        <span class="widget-icon"> <i class="fa fa-barcode"></i> </span>
                        <h2>Item </h2>

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

                            <div class="widget-body-toolbar">

                                <div class="row">

                                    <div class="col-sm-4">
                                        <?php echo form_open(current_url());?>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Type invoice number or date..." name="trans_no" value="<?php echo $trans_no;?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                    <i class="fa fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                        <?php echo form_close();?>
                                    </div>

                                    <div class="col-sm-8 text-align-right">

<!--                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit </a>
                                        </div>

                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Create New </a>
                                        </div>-->

                                    </div>

                                </div>

                            </div>
                            <?php if (sizeof($transJob) > 0 ):?>
                            <div class="padding-10">
                                <br>
<!--                                <div class="pull-left">
                                    <img src="img/logo-blacknwhite.png" width="150" height="32" alt="invoice icon">

                                    <address>
                                        <br>
                                        <strong>SmartAdmin, Inc.</strong>
                                        <br>
                                        231 Ajax Rd,
                                        <br>
                                        Detroit MI - 48212, USA
                                        <br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>-->
                                <div class="pull-right">
                                    <h1 class="font-400">TRANSFER</h1>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
<!--                                        
                                        <h4 class="semi-bold">Rogers, Inc.</h4>
                                        <address>
                                            <strong>Mr. Simon Hedger</strong>
                                            <br>
                                            342 Mirlington Road,
                                            <br>
                                            Calfornia, CA 431464
                                            <br>
                                            <abbr title="Phone">P:</abbr> (467) 143-4317
                                        </address>-->
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <div>
                                                <strong>TRANSFER NO :</strong>
                                                <span class="pull-right"> #<?php echo $trans_no?></span>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="font-md">
                                                <strong>TRANSFER DATE :</strong>
                                                <span class="pull-right"> <i class="fa fa-calendar"></i> <?php echo date(config_item('date_format'),strtotime($transJob[0]->regis_date));?></span>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="well well-sm  bg-color-darken txt-color-white no-border">
                                            <div class="fa-lg">
                                                STATUS :
                                                <span class="pull-right"> <?php echo $transJob[0]->status?> </span>
                                            </div>

                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                         <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Product Name</th>
                                            <th>Product No.</th>
                                            <th class="text-center" width="100">Qty.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;?>
                                        <?php foreach($transJob as $j):?>
                                        <?php $total += $j->quantity?>
                                        <tr>
                                            <td><?php echo $j->branch_from_name;?></td>
                                            <td><?php echo $j->branch_to_name;?></td>
                                            <td><?php echo $j->product_name;?></td>
                                            <td><?php echo $j->product_number;?></td>
                                            <td class="text-center"><?php echo $j->quantity;?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>

                                <div class="invoice-footer">

                                    <div class="row">

                                        <div class="col-sm-7">
<!--                                            <div class="payment-methods">
                                                <h5>Payment Methods</h5>
                                                <img src="img/invoice/paypal.png" width="64" height="64" alt="paypal">
                                                <img src="img/invoice/americanexpress.png" width="64" height="64" alt="american express">
                                                <img src="img/invoice/mastercard.png" width="64" height="64" alt="mastercard">
                                                <img src="img/invoice/visa.png" width="64" height="64" alt="visa">
                                            </div>-->
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="invoice-sum-total pull-right">
                                                <h3><strong>Total: <span class="text-success"><?php echo $total?></span></strong> units</h3>
                                            </div>
                                        </div>

                                    </div>
<!--
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="note">**To avoid any excess penalty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
                                        </div>
                                    </div>-->

                                </div>
                            </div>
                            <?php endif;?>
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

    </section>
    <!-- end widget grid -->

</div>
<!-- END MAIN CONTENT -->