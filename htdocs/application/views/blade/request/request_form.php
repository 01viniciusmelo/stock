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

                         <fieldset>
                       
                            <section>
                                    <label class="label">Request From</label>
                                    <label>
                                        <?php
                                        $data = array(
                                            'class' => 'form-control request_branch_id'
                                        );
                                        echo form_dropdown('request_branch_id', $branch, isset($request['request_branch_id']) ? $request['request_branch_id'] : "", $data);
                                        ?>
                                    </label>
                                </section>
                        
                            </fieldset>

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
                                    <input type="text" name="request_no"  value="<?php echo $request_no ?>">
                                </label>

                            </section>

                        </div>
                    </div>

                    <fieldset class="cart_info">
                        <?php echo $cart_item ?>
                    </fieldset>

                    <fieldset>
                 
                            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                <?php
                                $data = array(
                                    'name' => 'request_remark',
                                    'class' => 'summernote',
                                    'value' => isset($request['request_remark']) ? $request['request_remark'] : "",
                                    'rows' => 2, 'placeholder' => 'Remark'
                                );
                                echo form_textarea($data);
                                ?>
                            </label>
                            <div class="note">
                                กรุณาระบุเหตุผลทุกครั้ง
                            </div>
                    </fieldset>



                    

                    <footer>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <?php echo anchor('/request/clear', 'Clear', "class='btn btn-default'") ?>
                    </footer>
                </form>

            </article>

        </div>

</div>

