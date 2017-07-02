<div id="content">
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-cube"></i> 
                All Product Type

            </h1>
        </div>


    </div>


    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well" id="wid-id-0">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Product </h2>	
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
                            <div class="product-content product-wrap clearfix product-deatil">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12 ">
                                        <div class="product-image"> 
                                            <div id="myCarousel-3" class="carousel fade">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#myCarousel-3" data-slide-to="0" class=""></li>
                                                    <li data-target="#myCarousel-3" data-slide-to="1" class="active"></li>
                                                    <li data-target="#myCarousel-3" data-slide-to="2" class=""></li>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <!-- Slide 1 -->
                                                    <div class="item active">
                                                        <img src="img/demo/e-comm/detail-1.png" alt="">
                                                    </div>
                                                    <!-- Slide 2 -->
                                                    <div class="item">
                                                        <img src="img/demo/e-comm/detail-2.png" alt="">
                                                    </div>
                                                    <!-- Slide 3 -->
                                                    <div class="item">
                                                        <img src="img/demo/e-comm/detail-3.png" alt="">
                                                    </div>
                                                </div>
                                                <a class="left carousel-control" href="#myCarousel-3" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                                                <a class="right carousel-control" href="#myCarousel-3" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">

                                        <h2 class="name">
                                            <?php echo $product->product_name; ?>
<!--                                            <small>Product by <a href="javascript:void(0);">Adeline</a></small>
                                            <i class="fa fa-star fa-2x text-primary"></i>
                                            <i class="fa fa-star fa-2x text-primary"></i>
                                            <i class="fa fa-star fa-2x text-primary"></i>
                                            <i class="fa fa-star fa-2x text-primary"></i>
                                            <i class="fa fa-star fa-2x text-muted"></i>
                                            <span class="fa fa-2x"><h5>(109) Votes</h5></span>	

                                            <a href="javascript:void(0);">109 customer reviews</a>-->

                                        </h2>
                                        <hr>
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <h3 class="price-container">
                                                    $129.54
                                                    <small>*includes tax</small>
                                                </h3>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <a href="javascript:void(0);" class="btn btn-primary">Add to cart ($129.54)</a>
                                            </div>
                                        </div>





                                        <hr>
                                        <div class="description description-tabs">


                                            <ul id="myTab2" class="nav nav-tabs">
                                                <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin" aria-expanded="true">Product Description </a></li>
                                                <li class=""><a href="#stock" data-toggle="tab" aria-expanded="false">Stock</a></li>

                                            </ul>
                                            <div id="myTabContent2" class="tab-content">
                                                <div class="tab-pane fade active in" id="more-information">
                                                    <br>
                                                    <strong>Description</strong>
                                                    <p><?php echo $product->product_desc; ?></p>
                                                </div>
                                                <div class="tab-pane fade" id="stock">
                                                    <br>
                                                    <?php echo $stock; ?>
                                                </div>

                                            </div>
                                        </div>
<!--                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="btn-group">
                                                    <button class="btn btn-white btn-default"><i class="fa fa-star"></i> Add to wishlist </button>
                                                    <button class="btn btn-white btn-default"><i class="fa fa-envelope"></i> Contact Seller</button>
                                                </div>
                                            </div>
                                        </div>-->

                                    </div>
                                </div>
                            </div>

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

        <!-- row -->

        <div class="row">

            <!-- a blank row to get started -->
            <div class="col-sm-12">
                <!-- your contents here -->
            </div>

        </div>

        <!-- end row -->

    </section>
    <!-- end widget grid -->
</div>