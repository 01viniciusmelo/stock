<header id="header">
            <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> 
                    <!--<img src="<?php echo asset_url('img/TK_logo.png');?>" alt="<?php echo config_item('theme_title');?>">-->
                </span>
                <!-- END LOGO PLACEHOLDER -->
                <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
                <?php //$this->load->view('inc/notify');?>
                <!-- END AJAX-DROPDOWN -->
            </div>

            <!-- #PROJECTS: projects dropdown 
            <div class="project-context hidden-xs">

                <span class="label">Projects:</span>
                <span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>

                
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Notes on pipeline upgradee</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Assesment Report for merchant account</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
                    </li>
                </ul>
                

            </div>
             end projects dropdown -->

            <!-- #TOGGLE LAYOUT BUTTONS -->
            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                            <img src="<?php echo asset_url('img/avatars/avatars_none.png');?>" alt="<?php echo "dd"?>" class="online" />  
                        </a>
                        <ul class="dropdown-menu pull-right">
                            
                            <li>
                                <a href="<?php echo site_url('user/profile');?>" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url('auth/logout');?>" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?php echo site_url('auth/logout');?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port)
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                 end search mobile button -->

                <!-- #SEARCH -->
                <!-- input: search field 
                <form action="#ajax/search.html" class="header-search pull-right">
                    <input id="search-fld" type="text" name="param" placeholder="Find reports and more">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
                </form>
                 end input: search field -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->

                <!-- multiple lang dropdown : find all flags in the flags page -->
                <?php //$this->load->view('inc/language')?>
                <!-- end multiple lang -->

            </div>
            <!-- end pulled right: nav area -->

        </header>