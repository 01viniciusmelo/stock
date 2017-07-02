<div id="content">

    <?php
    if (validation_errors()):
        echo "<div class='alert alert-danger fade in'>" . validation_errors() . "</div>";
    endif;
    ?>




    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">


            <article class="col-sm-5 col-md-5 col-md-5 sortable-grid ui-sortable">

                <form class="form-horizontal" id="item_search_form" action=""  autocomplete="off">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <input type="text" id="item_search_input" class="form-control" autofocus="autofocus" autocomplete="off" placeholder="Search item...">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-default" type="button">Search!</button>
                                </span>
                            </div><!-- /input-group -->


                        </div>
                    </div>
                </form>
                <?php echo $search_item ?>

            </article>
            <article class="col-sm-7 col-md-7 col-md-7 sortable-grid ui-sortable">
                <form class="form-horizontal smart-form" action="<?php echo current_url() ?>" method="post"  autocomplete="off">
                    <div class="form-group">

                        <div class="col-lg-12 col-lg-offset-12">
                            <section class="col col-6">

                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                    <input type="text" name="order_no"  value="<?php echo $order_no ?>">
                                </label>

                            </section>

                        </div>
                    </div>

                    <fieldset class="cart_info">
                        <?php echo $cart_item ?>
                    </fieldset>

                    <legend>Order Summary</legend>
                    <br>



                    <fieldset>
                        <div class="row">
                            <section class="col col-3">
                                <label class="label">Sub Total</label>
                                <label class="input"> <i class="icon-append fa fa-money"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'sub_total',
                                        'class' => '',
                                        'value' => isset($order['sub_total']) ? $order['sub_total'] : 0,
                                        'readonly' => 'readonly',
                                        'type' => 'number'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>
                            </section>
                            <section class="col col-3">
                                <label class="label">Discount (Amount)</label>
                                <label class="input"> <i class="icon-append fa fa-money"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'discount',
                                        'class' => 'number',
                                        'value' => isset($order['discount']) ? $order['discount'] : null,
                                        'type' => 'number'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>
                            </section>
                            <section class="col col-2">
                                <label class="label">Taxs (7%)</label>
                                <label class="input"> <i class="icon-append fa fa-money"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'tax',
                                        'class' => 'form-control',
                                        'value' => isset($order['tax']) ? $order['tax'] : null,
                                        'type' => 'number'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>
                            </section>

                            <section class="col col-4">
                                <label class="label">Grand Total</label>
                                <label class="input state-success"> <i class="icon-append fa fa-money"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'total',
                                        'class' => 'number input-lg',
                                        'value' => isset($order['total']) ? $order['total'] : 0,
                                        'readonly' => 'readonly',
                                        'type' => 'number'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>
                            </section>
                        </div>

                        <section>

                            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                <?php
                                $data = array(
                                    'name' => 'order_remark',
                                    'class' => 'summernote',
                                    'value' => isset($order['order_remark']) ? $order['order_remark'] : "",
                                    'rows' => 2, 'placeholder' => 'Remark'
                                );
                                echo form_textarea($data);
                                ?>
                            </label>
                            <div class="note">
                                กรุณาระบุเหตุผลทุกครั้ง
                            </div>
                        </section>
                    </fieldset>



                    <fieldset>
                        <?php if ($action_type == 'TR') { ?>
                            <div class="row">
                                <section class="col col-12">
                                    <label class="label">Transfer to</label>
                                    <label>
                                        <?php
                                        $data = array(
                                            'class' => 'form-control'
                                        );
                                        echo form_dropdown('branchs_id_to', $branch, isset($order['branchs_id_to']) ? $order['branchs_id_to'] : "", $data);
                                        ?>
                                    </label>
                                </section>
                            </div>
                        <?php }else{ ?>
                        <div class="row">
                            <section class="col col-6">
                                <label class="label">Billing Info</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'order_billing_name',
                                        'value' => isset($order['order_billing_name']) ? $order['order_billing_name'] : "",
                                        'placeholder' => 'Billing name'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>

                                <label class="textarea"> <i class="icon-append fa fa-send"></i> 										
                                    <?php
                                    $data = array(
                                        'name' => 'order_billing_address',
                                        'value' => isset($order['order_billing_address']) ? $order['order_billing_address'] : "",
                                        'rows' => 2,
                                        'placeholder' => 'Billing address'
                                    );
                                    echo form_textarea($data);
                                    ?>
                                </label>
                            </section>
                            <section class="col col-6">   
                                <label class="label">Shippig Info</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <?php
                                    $data = array(
                                        'name' => 'order_ship_name',
                                        'value' => isset($order['order_ship_name']) ? $order['order_ship_name'] : "",
                                        'placeholder' => 'Shipping name'
                                    );
                                    echo form_input($data);
                                    ?>
                                </label>

                                <label class="textarea"> <i class="icon-append fa fa-send"></i> 										
                                    <?php
                                    $data = array(
                                        'name' => 'order_ship_address',
                                        'value' => isset($order['order_ship_address']) ? $order['order_ship_address'] : "",
                                        'rows' => 2,
                                        'placeholder' => 'Shipping address'
                                    );
                                    echo form_textarea($data);
                                    ?>
                                </label>
                            </section>
                              <?php } ?>
                    </fieldset>

                    <footer>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <?php echo anchor('/order/clear', 'Clear', "class='btn btn-default'") ?>
                    </footer>
                </form>

            </article>

        </div>

</div>

