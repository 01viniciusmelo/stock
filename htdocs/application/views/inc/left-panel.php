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

        <?php
        $group = 'admin';
        if ($this->ion_auth->in_group($group)) :
            ?>
            <ul>

                <li>

                    <a href="#user"> <i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">User</span> </a>
                    <ul>
                        <?php echo nav_active_link('user/display', "All User"); ?>
                        <?php echo nav_active_link('user/add', "Add"); ?>
                    </ul>
                </li>
                
                <?php echo nav_active_link('customer/all', "Customer / Site", 'fa-group' ,'customer'); ?>
                <?php echo nav_active_link('item', "Item", 'fa-steam','item'); ?>
                <li>
                    <a href="#user"> <i class="fa fa-lg fa-fw fa-truck"></i> <span class="menu-item-parent">Truck</span> </a>
                    <ul>
                        <?php echo nav_active_link('truck/all', "All Truck"); ?>
                        <?php echo nav_active_link('truck/ehr_search', "Search EHR."); ?>
                    </ul>
                </li>
                <?php echo nav_active_link('job/all', "Job/PO", 'fa-tasks','job'); ?>
                <?php echo nav_active_link('report', "Report", 'fa-bar-chart-o"'); ?>
                <?php //echo nav_active_link('history', "History", 'fa fa-lg fa-history"'); ?>
            </ul>

        <?php endif; ?>


        <?php
        $group = 'employee';
        if ($this->ion_auth->in_group($group)) :
            ?>
            <ul>
                <?php echo nav_active_link('customer/all', "Customer / Site", 'fa-group'); ?>
                <?php //echo nav_active_link('truck/all', "Truck", 'fa-truck'); ?>
                <li>
                    <a href="#user"> <i class="fa fa-lg fa-fw fa-truck"></i> <span class="menu-item-parent">Truck</span> </a>
                    <ul>
                        <?php echo nav_active_link('truck/all', "All Truck"); ?>
                        <?php echo nav_active_link('truck/ehr_search', "Search EHR."); ?>
                    </ul>
                </li>
                <?php echo nav_active_link('job/all', "Job/PO", 'fa-tasks'); ?>
                <?php echo nav_active_link('report', "Report", 'fa-bar-chart-o"'); ?>
            </ul>

        <?php endif; ?>


        <?php
        $group = 'technician';
        if ($this->ion_auth->in_group($group)) :
            ?>
            <ul>
                <li>
                    <a href="#user"> <i class="fa fa-lg fa-fw fa-truck"></i> <span class="menu-item-parent">Truck</span> </a>
                    <ul>
                        <?php echo nav_active_link('truck/all', "All Truck"); ?>
                        <?php echo nav_active_link('truck/ehr_search', "Search EHR."); ?>
                    </ul>
                </li>
                <?php //echo nav_active_link('truck/all', "Truck", 'fa-truck'); ?>
                <?php //echo nav_active_link('truck/ehr_search', "Truck", 'fa-truck'); ?>
            </ul>

        <?php endif; ?>

        <?php
        $group = 'customer';
       if ($this->ion_auth->in_group($group)) :
            ?>
            <ul>
                <?php echo nav_active_link('job/all', "Job/PO", 'fa-tasks'); ?>
                <?php echo nav_active_link('report', "Report", 'fa-bar-chart-o"'); ?>
            </ul>

        <?php endif; ?>

    </nav>

    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
