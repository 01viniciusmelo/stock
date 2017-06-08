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
            <li>
                <a href="#user"> <i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">User</span> </a>
                <ul>
                    <li><?php echo nav_active_link('user/display', "All User"); ?></li>
                    <li><?php echo nav_active_link('user/create', "Add"); ?></li>
                </ul>
            </li>
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Setting</span> </a>
                <ul>
                    <li><?php echo nav_active_link('category/display', "Caterogy"); ?></li>
                    <li><?php echo nav_active_link('branchs/display', "Branchs"); ?></li>
                    <li><?php echo nav_active_link('reason/display', "Reason Type"); ?></li>
                </ul>
            </li>
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-suitcase"></i>  <span class="menu-item-parent">Inventory</span> </a>
                <ul>
                    <li><?php echo nav_active_link('product/display', "Product (Goods)"); ?></li>
                    <li><?php echo nav_active_link('stock/display', "Stock"); ?></li>
                </ul>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
