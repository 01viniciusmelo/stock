<div id="content">
    <?php
    if (validation_errors()):
        echo "<div class='alert alert-danger fade in'>" . validation_errors() . "</div>";
    endif;
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-shopping-basket'></i> 
                CANCEL TRANSFER NO. =  <?php echo $order_no; ?>

            </h1>
        </div>

    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                <div class="jarviswidget well jarvis widget-sortable">
                    <div class="widget-body">

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
                            <div class="payment-methods">
                                <hr>
                                <form class="form-horizontal smart-form" action="<?php echo current_url() ?>" method="post"  autocomplete="off">
                                    <fieldset
                                        <section>

                                            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                <?php
                                                $data = array(
                                                    'name' => 'order_cancel_remark',
                                                    'class' => 'summernote',
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
                                    <footer>

                                        <button type="submit" class="btn btn-primary">
                                            Confirm cancel
                                        </button>
                                        <?php echo anchor('/order', 'Back', "class='btn btn-default'") ?>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>


