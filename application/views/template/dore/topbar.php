<body id="app-container" class="menu-default show-spinner">
<nav class="navbar fixed-top">
    <a href="#" class="menu-button d-none d-md-block">
        <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
            <rect x="0.48" y="0.5" width="7" height="1" />
            <rect x="0.48" y="7.5" width="7" height="1" />
            <rect x="0.48" y="15.5" width="7" height="1" />
        </svg>
        <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
            <rect x="1.56" y="0.5" width="16" height="1" />
            <rect x="1.56" y="7.5" width="16" height="1" />
            <rect x="1.56" y="15.5" width="16" height="1" />
        </svg>
    </a>

    <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
            <rect x="0.5" y="0.5" width="25" height="1" />
            <rect x="0.5" y="7.5" width="25" height="1" />
            <rect x="0.5" y="15.5" width="25" height="1" />
        </svg>
    </a>
<!-- 
    <div class="search" data-search-path="Layouts.Search.html?q=">
        <input placeholder="Search...">
        <span class="search-icon">
            <i class="simple-icon-magnifier"></i>
        </span>
    </div> -->

    <a class="navbar-logo" href="<?php echo site_url('main');?>">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="ml-auto">
        <div class="header-icons d-inline-block align-middle">

            <?php if (isAdmin()) { ?>
            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                    <a href="<?php echo site_url("user/customers");?>" class="icon-menu-item">
                        <i class="iconsmind-MaleFemale d-block"></i>
                        <span>Customers</span>
                    </a>

                    <a href="<?php echo site_url("questions/management");?>" class="icon-menu-item">
                        <i class="iconsmind-Project d-block"></i>
                        <span>Questionnaire</span>
                    </a>

                    <a href="<?php echo site_url("document/uploads");?>" class="icon-menu-item">
                        <i class="iconsmind-Data-Upload d-block"></i>
                        <span>Uploads</span>
                    </a>

                </div>
            </div>
            <?php }?>

            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>

        </div>

        <div class="user d-inline-block">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="name"><?php echo $info->name; ?></span>
                <span>
                    <?php
                        $photo = 'assets/img/users/' . $info->id . ".jpg";
                        if (!file_exists($photo)) {
                            $photo = 'assets/img/users/anonymous.jpg';
                        }
                    ?>
                    <img alt="Profile Picture" src="<?php echo base_url($photo);?>" />
                </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="<?php echo site_url("home");?>"><i class="iconsmind-Checked-User"></i> Account</a>
                <a class="dropdown-item" href="<?php echo site_url("user/logout"); ?>"><i class="iconsmind-Lock padding-5"></i> Sign out</a>
            </div>
        </div>
    </div>
</nav>
