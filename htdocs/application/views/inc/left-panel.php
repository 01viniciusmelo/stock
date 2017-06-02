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
                    <?php echo nav_active_link('user/display', "All User"); ?>
                    <?php echo nav_active_link('user/add', "Add"); ?>
                </ul>
            </li>
            <li>
                <a href="#setting"> <i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Setting</span> </a>
            </li>
        </ul>

    </nav>

    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
