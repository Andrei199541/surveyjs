<div class="sidebar">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="main-manu-item" id="user_menu">
                    <a href="#user">
                        <i class="iconsmind-Administrator"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="main-manu-item" id="question_menu">
                    <a href="#questions">
                        <i class="iconsmind-Project"></i> Questionnaire
                    </a>
                </li>
                <li class="main-manu-item" id="document_menu">
                    <a href="#documents">
                        <i class="iconsmind-File-Favorite"></i> Document
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="user">
                <li class="sub-menu-item" id="user_account">
                    <a href="<?php echo site_url("home");?>">
                        <i class="simple-icon-user"></i> Account
                    </a>
                </li>
                <?php if ($this->session->userdata("role") == 1) { ?>
                <li class="sub-menu-item" id="user_customer">
                    <a href="<?php echo site_url("user/customers");?>">
                        <i class="simple-icon-people"></i>Customers
                    </a>
                </li>
                <?php }?>
            </ul>

            <ul class="list-unstyled" data-link="questions">
                <?php if ($this->session->userdata("role") == 1) { ?>
                <li class="sub-menu-item" id="question_management">
                    <a href="<?php echo site_url("questions/management");?>">
                        <i class="simple-icon-note"></i> Questionnaire Management
                    </a>
                </li>
                <li class="sub-menu-item" id="access_management">
                    <a href="<?php echo site_url("questions/accessManage");?>">
                        <i class="iconsmind-Computer-Secure"></i> Access Management
                    </a>
                </li>
                <?php } ?>
                <li class="sub-menu-item" id="survey">
                    <a href="<?php echo site_url("questions/survey");?>">
                        <i class="simple-icon-calculator"></i> Survey
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="documents">
                <?php if ($this->session->userdata("role") == 1) { ?> 
                <li class="sub-menu-item" id="uploads">
                    <a href="<?php echo site_url("document/uploads");?>">
                        <i class="simple-icon-cloud-upload"></i> Uploads
                    </a>
                </li>
                <?php }?>
                <li class="sub-menu-item" id="management_report">
                    <a href="<?php echo site_url("document/manageReport");?>">
                        <i class="simple-icon-diamond"></i> Management Report
                    </a>
                </li>
                <li class="sub-menu-item" id="authority_report">
                    <a href="<?php echo site_url("document/authReport");?>">
                        <i class="simple-icon-bag"></i> Authority Report
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
