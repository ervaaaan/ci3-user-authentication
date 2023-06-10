<div id="header" class="header navbar-default">
    <div class="navbar-header" style="max-width:250px">
        <a href="<?php echo base_url(); ?>" class="navbar-brand" style="padding-left:10px">
            <span class="wide-logo">
                <img src="<?php echo base_url(); ?>assets/img/logo-text.png" style="max-width:230px;height:30px;margin-top:-3px;">
            </span>
            <span class="small-logo">
                <img src="<?php echo base_url(); ?>assets/img/logo-text.png" style="max-height:30px;margin-top:-4px;">
            </span>
        </a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <ul class="navbar-nav navbar-right">
        <li>
            <a href="javascript:;" class="f-s-14" rel="tooltip" title="History">
                <i class="fas fa-history text-inverse"></i>
            </a>
        </li>
        <li class="dropdown navbar-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                $image = 'assets/img/users/' . $this->session->userdata("id") . '.jpg';
                if (file_exists(FCPATH . $image)) {
                    echo '<img src="' . base_url($image) . '?' . time() . '" class="user_img_msg" alt="'.$this->session->userdata("name").'" />';
                } else {
                    echo '<img src="' . base_url("assets/img/users/default.jpg") . '" class="user_img_msg" alt="'.$this->session->userdata("name").'" />';
                }
                ?>
                <span class="d-none d-md-inline"><?php echo $this->session->userdata("name"); ?></span> <b class="caret" style="margin-top:-2px"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo base_url('account-settings'); ?>" class="dropdown-item">
                    <button class="btn btn-info btn-icon btn-circle btn-xs"><i class="fa fa-pencil-alt"></i></button> Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url("logout"); ?>" class="dropdown-item">
                    <button class="btn btn-danger btn-icon btn-circle btn-xs"><i class="fa fa-power-off"></i></button> Log Out
                </a>
            </div>
        </li>
    </ul>
</div>