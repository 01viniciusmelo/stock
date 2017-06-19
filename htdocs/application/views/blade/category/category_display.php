<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">

            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-table"></i> 
            All Category

        </h1>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
         <ul id="sparks">
            <li class="sparks-info">
                <?php echo anchor('category/add', "<i class='fa-fw fa fa-plus-square-o'></i> Add new category", "class='btn btn-default'") ?>
            </li> 
        </ul>
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
                    <h2>Category </h2>	
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

                        <?php echo $table_data ?>

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