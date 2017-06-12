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
            <?php echo nav_active_link('dashboard', "Dashboard","fa-area-chart",'dashboard'); ?>
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-cubes"></i>  <span class="menu-item-parent">Inventory</span> </a>
               <ul>
                    <li><?php echo nav_active_link('stock/display', "Stock"); ?></li>
                </ul>
            </li>
            <li>
                <a href="#user"> <i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Product</span> </a>
                <ul>
                    <li><?php echo nav_active_link('product/display', "Product"); ?></li>
                    <!--<li><?php echo nav_active_link('branchs/display', "Branch"); ?></li>-->
                    <li><?php echo nav_active_link('category/display', "Caterogy"); ?></li>
                    <li><?php echo nav_active_link('product/excel_import', "Excel Import"); ?></li>
                </ul>
            </li>
             
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-truck"></i>  <span class="menu-item-parent">Tranfers</span> </a>
               <ul>
                    <li><?php echo nav_active_link('tranfers/display', "Tranfers"); ?></li>
                </ul>
            </li>
            <li>
                <a href="#user"> <i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">User</span> </a>
                <ul>
                    <li><?php echo nav_active_link('user/display', "User"); ?></li>
                    <li><?php echo nav_active_link('user/role', "Role"); ?></li>
                    <!--<li><?php echo nav_active_link('user/create', "Add"); ?></li>-->
                </ul>
            </li>
            <li>
                <a href="#user"> <i class="fa fa-lg fa-fw fa-building-o"></i> <span class="menu-item-parent">Company</span> </a>
                <ul>
                    <li><?php echo nav_active_link('company/display', "Companny"); ?></li>
                    <li><?php echo nav_active_link('branchs/display', "Branch"); ?></li>
                </ul>
            </li>
            
            
            
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Setting</span> </a>
                 <ul>
<!--                    <li><?php echo nav_active_link('category/display', "Caterogy"); ?></li>-->
                    <!--<li><?php echo nav_active_link('branchs/display', "Branchs"); ?></li> move to menu company-->
                    <li><?php echo nav_active_link('reason/display', "Reason Type"); ?></li>
                    <li><?php echo nav_active_link('setting/format', "Format"); ?></li>
                </ul>
            </li>
           
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
