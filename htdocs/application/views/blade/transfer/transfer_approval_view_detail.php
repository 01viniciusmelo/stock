<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title">
                <i class='fa-fw fa fa-shopping-basket'></i> 
                TRANSFER NO.:  <?php echo $order_no; ?>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <ul id="sparks">
                <li class="sparks-info">
                    <?php echo anchor('transfer_approve/approve/'.$order_no.'/A', "<i class='fa-fw fa fa-check-circle-o'></i> Approve", "class='btn btn-success'") ?>
                </li> 
                <li class="sparks-info">
                    <?php echo anchor('transfer_approve/approve/'.$order_no.'/R', "<i class='fa-fw fa fa-mail-reply '></i> Reject", "class='btn btn-danger'") ?>
                </li> 
                <li class="sparks-info">
                    <?php echo anchor('transfer_approve', "<i class='fa-fw fa fa-arrow-circle-o-left'></i> Back", "class='btn btn-default'") ?>
                </li> 
            </ul>
        </div>
    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                <div class="jarviswidget well jarvis widget-sortable">
                    <div class="widget-body">
                        <div class="text-align-right">
                            <h1 class="font-400">TRANSFER</h1>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <h3>BILLING</h3>
                                <hr>
                                <p><strong><?php echo $order[0]->order_billing_name; ?></strong></p>
                                <p><?php echo $order[0]->order_billing_address; ?></p>
                            </div>  
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <h3>SHIPPING</h3>
                                <hr>
                                <p><strong><?php echo $order[0]->order_ship_name; ?></strong></p>
                                <p><?php echo $order[0]->order_ship_address; ?></p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <div>
                                    <div>
                                        <strong>TRANSFER NO :</strong>
                                        <span class="pull-right"> <?php echo $order_no; ?> </span>
                                    </div>

                                </div>
                                <div>
                                    <div class="font-md">
                                        <strong>TRANSFER DATE :</strong>
                                        <span class="pull-right"> <i class="fa fa-calendar"></i> <?php echo $order[0]->created_at; ?> </span>
                                    </div>

                                </div>
                                <br>
                                <div class="well well-sm  bg-color-darken txt-color-white no-border">
                                    <div class="fa-lg">
                                        Total :
                                        <span class="pull-right"> <?php echo number_format($order[0]->order_total, 2); ?> THB </span>
                                    </div>

                                </div>
                                <br>
                                <br>
                            </div>
                        </div>

                        <?php echo $order_item_list; ?>

                        <div class="invoice-footer">

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="payment-methods">
                                        <hr>
                                        <p class="note">**<?php echo $order[0]->order_remark; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="invoice-sum-total pull-right">
                                        <h3><strong>Total: <span class="text-success"><?php echo number_format($order[0]->order_total, 2); ?> THB</span></strong></h3>
                                    </div>
                                </div>
                            </div>										
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>


