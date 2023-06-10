<div id="sidebar" class="sidebar sidebar-transparent" style="box-shadow:3px 0 10px rgba(0, 0, 0, .25)!important">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="row">
                        <div class="col-12 col-md-3 p-r-0 p-l-0">
                            <div class="image m-b-0" style="width:50px;height:50px">
                                <?php
                                $image = 'assets/img/users/' . $this->session->userdata("id") . '.jpg';
                                if (file_exists(FCPATH . $image)) {
                                    echo '<img src="' . base_url($image) . '?' . time() . '" class="user_img_msg" alt="'.$this->session->userdata("name").'" />';
                                } else {
                                    echo '<img src="' . base_url("assets/img/users/default.jpg") . '" class="user_img_msg" alt="'.$this->session->userdata("name").'" />';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 p-t-5">
                            <div class="info">
                                <?php echo $this->session->userdata("name"); ?>
                                <small>
                                    <?php echo ucfirst($this->session->userdata("role")); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="nav">
            <?php $menu = json_decode(file_get_contents($this->config->item("env_direct", "equipment").$this->config->item("navigation", "equipment")), TRUE); ?>
            <?php foreach ($menu as $key){ ?>
                <?php if(in_array(strtolower($this->session->userdata("role")), explode("|", $key["roles"]))){ ?>
                    <?php if(count($key["sub_menu"]) > 0){ ?>
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret"></b>
                                <i class="<?php echo $key["icon"]; ?>"></i>
                                <span><?php echo lang($key["title"]); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <?php foreach ($key["sub_menu"] as $key2){ ?>
                                    <?php if(in_array(strtolower($this->session->userdata("role")), explode("|", $key2["roles"]))){ ?>
                                        <?php if(count($key2["sub_menu"]) > 0){ ?>
                                            <li class="has-sub">
                                                <a href="javascript:;">
                                                    <b class="caret"></b>
                                                    <?php echo lang($key2["title"]); ?>
                                                </a>
                                                <ul class="sub-menu">
                                                    <?php foreach ($key2["sub_menu"] as $key3){ ?>
                                                        <?php if(in_array(strtolower($this->session->userdata("role")), explode("|", $key3["roles"]))){ ?>
                                                            <li class="has-sub">
                                                                <a href="<?php echo $key3["href"] === "#" ? "#" : (preg_match("/^http.*/", $key3["href"]) ? $key3["href"] : base_url().$key3["href"]."/".($key3["param"] === "user" ? $this->session->userdata("id").md5($this->session->userdata("name")) : "")); ?>" target="<?php echo $key3["target"]; ?>" class="<?php echo $key3["class"]; ?>">
                                                                    <?php echo lang($key3["title"]); ?>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                                <a href="<?php echo $key2["href"] === "#" ? "#" : (preg_match("/^http.*/", $key2["href"]) ? $key2["href"] : base_url().$key2["href"]."/".($key2["param"] === "user" ? $this->session->userdata("id").md5($this->session->userdata("name")) : "")); ?>" target="<?php echo $key2["target"]; ?>" class="<?php echo $key2["class"]; ?>">
                                                    <?php echo lang($key2["title"]); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo $key["href"] === "#" ? "#" : base_url().$key["href"]."/".($key["param"] === "user" ? $this->session->userdata("id").md5($this->session->userdata("name")) : ""); ?>" target="<?php echo $key["target"]; ?>" class="<?php echo $key["class"]; ?>">
                                <i class="<?php echo $key["icon"]; ?>"></i>
                                <span><?php echo lang($key["title"]); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
