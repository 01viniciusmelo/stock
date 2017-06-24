<!-- PAGE RELATED PLUGIN(S)  -->
<script src="<?php echo asset_url("js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo asset_url("js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">



    pageSetUp();


    var dt = $('.search_item').dataTable({
        "pageLength": <?php echo data_table_config('pageLength'); ?>,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "<?php echo site_url('api/item/all'); ?>",
            type: 'GET',
            cache: false,
            data: function (d) {
                d.search = $('#item_search_input').val();
                d.uniq_param = (new Date()).getTime();
            },
            "dataSrc": function (json) {
                //IF found 1 item
                if (Object.keys(json.data).length == 1) {
                    add_cart(json.data[0].product_id, 1);
                }
                return json.data;
            }

        },
        "autoWidth": true,
        "paging": false,
        "bOrdering": false,
        "info": false,
        "bDestroy": true,
        "destroy": true,
        "searching": false,
        "columns": [
            {"data": "product_name", "width": "60%"},
            {"data": "product_price_selling", "sClass": "numericCol", "width": "20%", render: $.fn.dataTable.render.number(',', '.', 2, '')},
            {"data": "action", "width": "20%"}
        ],
        "bFilter": false,
        "bLengthChange": false
    }).api();



    var dt_cart = $('.cart_item').dataTable({
        "pageLength": <?php echo data_table_config('pageLength'); ?>,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "<?php echo site_url('api/item/cart'); ?>",
            type: 'GET',
            cache: false,
            data: function (d) {
                d.uniq_param = (new Date()).getTime();
            },
            "dataSrc": function (json) {
                //Make your callback here.
                var objdata = $.parseJSON(json.sub_total);
                $('input[name=sub_total]').val(objdata);
                cal();
                return json.data;
            }
        },
        "autoWidth": false,
        "paging": false,
        "bOrdering": false,
        "info": false,
        "bDestroy": true,
        "destroy": true,
        "searching": false,
        "columns": [
            {"data": "product_name", "width": "35%"},
            {"data": "product_price_selling", "width": "15%", "sClass": "numericCol", render: $.fn.dataTable.render.number(',', '.', 2, '')},
            {"data": "quantity", "width": "15%", "sClass": "numericCol"},
            {"data": "amount", "width": "15%", "sClass": "numericCol"},
            {"data": "action", "width": "20%"}
        ],
        "bFilter": false,
        "bLengthChange": false,
        order: [[1, 'des']]
    }).api();


    //Cart edit;
    $(".cart_item").on("keyup", 'input', function () {
        var product_id = $(this).attr('product_id');
        var qty = $(this).val();
        var n_qty = $('.quantity_' + product_id + '_p').val();
        //alert(qty+" : "+n_qty);
        add_cart(product_id, qty - n_qty);
    });

    cal();


    $("#item_search_form").submit(function (e) {
        e.preventDefault();
        dt.search($("#item_search_input").val()).draw();
    });



    $('input[type=number]').keyup(function () {
        cal();
    });



    function cal() {
        var sub_total = $('input[name=sub_total]').val();
        var discount = $('input[name=discount]').val();
        var total = sub_total - discount;

        if ($('input[name=tax]').val() != '' && $('input[name=tax]').val() > 0) {
            var tax = $('input[name=tax]').val();
            total = total - (total * tax * 0.01);
        }
        $('input[name=total]').val(total);
    }

    function add_cart(v_product_id, v_quantity) {
        //alert(v_prodoct_id+","+v_quantity);
        $.ajax({
            method: "GET",
            url: "<?php echo site_url('api/item/cart'); ?>",
            data: {product_id: v_product_id, quantity: v_quantity}
        }).success(function (msg) {
            //alert("Data Saved: " + msg);
            dt_cart.draw();
            $("#item_search_input").val("")
            cal();
        });
    }

</script>

<style type="text/css">
    div.dt-toolbar{
        display: none;
    }

    fieldset.cart_info{
        padding-top: 0;
        background: none;
    }
    fieldset.cart_info .row{
        margin: -7px -13px 0;
    }

    .form-horizontal{
        margin-bottom: -7px;
    }

    input[type=number]{
        text-align: right;
    }
    .numericCol{text-align: right}

    table.cart_item input{
        width:100%;
    }
</style>