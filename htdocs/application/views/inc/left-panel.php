<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 

            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="<?php echo asset_url('img/avatars/avatars_none.png'); ?>" alt="me" class="online" /> 
                <span>
                    <?php echo $this->session->userdata('identity'); ?>
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 

        </span>
    </div>

    <nav>
        <ul>
            <?php //echo nav_active_link('dashboard', "Dashboard","fa-area-chart",'dashboard'); ?>
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-cubes"></i>  <span class="menu-item-parent">Inventory</span> </a>
               <ul>
                    <li><?php echo nav_active_link('branchs/display', "Branch",NULL,"branchs"); ?></li>
                    <li><?php echo nav_active_link('stock', "Stock",NULL,"index"); ?></li>
                  <!--  <li><?php echo nav_active_link('stock/transaction', "Transaction",NULL,"transaction"); ?></li> -->
                    <li><?php echo nav_active_link('stock/import', "Import excel",NULL,"import"); ?></li>

                    <li><<?php echo nav_active_link('stock/request', "Request",NULL,"request");?>/li>
                </ul>
            </li>
            
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-truck"></i>  <span class="menu-item-parent">Transfer</span> </a>
               <ul>
                    <li><?php echo nav_active_link('transfer', "Tranfers",NULL,"transfer"); ?></li>
                    <li><?php echo nav_active_link('transfer_approve', "Tranfers Approve",NULL,"transfer_approve"); ?></li>
                    <li><?php echo nav_active_link('reason/display', "Reason Type"); ?></li>
                </ul>
            </li>
            
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-shopping-cart"></i>  <span class="menu-item-parent">Order</span> </a>
               <ul>
                    <li><?php echo nav_active_link('order', "Sales Order",NULL,"order"); ?></li>
                    <li><?php echo nav_active_link('order_approve', "Salses Order Approve",NULL,"order_approve"); ?></li>
                </ul>
            </li>
            
             <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Product</span> </a>
                <ul>
                    <li><?php echo nav_active_link('product', "Product",NULL,"product"); ?></li>
                    <li><?php echo nav_active_link('category/display', "Category",NULL,"display"); ?></li>
                </ul>
            </li>
            
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">User</span> </a>
                <ul>
                    <li><?php echo nav_active_link('user/display', "User",NULL,"display"); ?></li>
                    <li><?php echo nav_active_link('user/role', "Role",NULL,"role"); ?></li>
                    <!--<li><?php echo nav_active_link('user/create', "Add",NULL,"user"); ?></li>-->
                </ul>
            </li>
            
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Reports</span> </a>
                <ul>
                    <li><?php echo nav_active_link('report/branch', "Product",NULL,"branch"); ?></li>
                    <!--<li><?php echo nav_active_link('report/category', "category"); ?></li>-->
                    <!--<li><?php echo nav_active_link('report/transection', "transection"); ?></li>-->
                </ul>
            </li>
            
            
            <!--
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-building-o"></i> <span class="menu-item-parent">Company</span> </a>
                <ul>
                    <li><?php echo nav_active_link('company', "Companny"); ?></li>
                    <li><?php echo nav_active_link('branchs/display', "Branch"); ?></li>
                </ul>
            </li>
            
         
            
            
            <li>
                <a href="#"> <i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Setting</span> </a>
                 <ul>
                    
                    
                    <li><?php echo nav_active_link('setting/format', "Format"); ?></li>
                </ul>
            </li>
           -->
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
