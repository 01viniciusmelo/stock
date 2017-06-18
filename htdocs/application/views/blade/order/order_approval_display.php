<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title">
                <i class='fa-fw fa fa-plus-square-o'></i> 
                Order List
                <span>>
                    <?php echo (isset($product) ? "Update" : "Add") ?>
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <ul id="sparks">
                <li class="sparks-info">
                    <?php echo anchor('order/create_po', "<i class='fa-fw fa fa-plus-square-o'></i> Add new Sales order", "class='btn btn-default'") ?>
                </li> 
            </ul>
        </div>
    </div>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                <div class="jarviswidget well jarviswidget-sortable">
                    <div class="widget-body">
                        <?php echo $order_list; ?>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>


