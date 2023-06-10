<?php $this->load->view("userbase/component/js_settings"); ?>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><?php echo $title[0]; ?></li>
        <li class="breadcrumb-item active"><?php echo $title[1]; ?></li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[0]; ?>
        <small><?php echo $title[1]; ?></small>
    </h1>
    <div class="row">
        <div class="col-12 col-md-6">
            <ul class="nav nav-tabs nav-tabs-inverse mat-shadow">
                <li class="nav-items" style="width:50%">
                    <a href="#profile" data-toggle="tab" class="nav-link m-r-0 active">
                        <span class="d-sm-block d-none"><b>Profile</b></span>
                    </a>
                </li>
                <li class="nav-items" style="width:50%">
                    <a href="#security" data-toggle="tab" class="nav-link m-r-0">
                        <span class="d-sm-block d-none"><b>Security</b></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content mat-shadow">
                <div class="tab-pane fade active show" id="profile">
                    <form id="form_edit" role="form" action="<?php echo base_url("users/save_profile"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
                        <?php echo form_hidden("last_username", ""); ?>
                        <?php echo form_hidden("last_email", ""); ?>
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "name",
                                    "class" => "form-control",
                                    "placeholder" => "Nama",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "username",
                                    "class" => "form-control",
                                    "placeholder" => "Username",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "email",
                                    "class" => "form-control",
                                    "placeholder" => "Email",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_email($data);
                            ?>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-md btn-primary">Save Profile</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="security">
                    <form id="form_password" role="form" action="<?php echo base_url("users/save_password"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "prev_password",
                                    "class" => "form-control",
                                    "placeholder" => "Password Sebelumnya",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_password($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "new_password",
                                    "class" => "form-control",
                                    "placeholder" => "Password Baru",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_password($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array(
                                    "name" => "confirm_password",
                                    "class" => "form-control",
                                    "placeholder" => "Ketik Ulang Password Baru",
                                    "required" => "required"
                                );
                                echo form_label($data["placeholder"], $data["name"]);
                                echo form_password($data);
                            ?>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-md btn-primary">Save Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
