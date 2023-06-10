<div id="content" class="content">
    <h1 class="page-header">
        <?php echo $title[0]; ?>
        <small><?php echo $title[1]; ?></small>
    </h1>
    <div class="row">
        <div class="col-12 col-md-12">
            <form role="form" action="<?php echo base_url("configuration/update"); ?>" method="POST" enctype="multipart/form-data">
                <div class="panel panel-inverse mat-shadow">
                    <div class="panel-heading">
                        <h4 class="panel-title">Pengaturan Sistem</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <?php
                                        $data = array(
                                            "name" => "email",
                                            "class" => "form-control",
                                            "placeholder" => "E-mail",
                                            "required" => "required",
                                            "value" => config_item('email')
                                        );
                                        echo form_label($data["placeholder"], $data["name"]);
                                        echo form_input($data);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $data = array(
                                            "name" => "phone",
                                            "class" => "form-control input-md",
                                            "placeholder" => "No. Telp",
                                            "required" => "required",
                                            "value" => config_item('phone')
                                        );
                                        echo form_label($data["placeholder"], $data["name"]);
                                        echo form_input($data);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $data = array(
                                            "name" => "fax",
                                            "class" => "form-control",
                                            "placeholder" => "Fax",
                                            "required" => "required",
                                            "value" => config_item('fax')
                                        );
                                        echo form_label($data["placeholder"], $data["name"]);
                                        echo form_input($data);
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $data = array(
                                                    "name" => "kodepos",
                                                    "class" => "form-control input-number-add",
                                                    "placeholder" => "Kode POS",
                                                    "required" => "required",
                                                    "value" => config_item('kodepos')
                                                );
                                                echo form_label($data["placeholder"]);
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div><div class="col-12 col-md-8">
                                        <div class="form-group">
                                            <?php
                                                $data = array(
                                                    "type" => "tel",
                                                    "name" => "whatsapp",
                                                    "class" => "form-control input-number-add",
                                                    "placeholder" => "Whatsapp",
                                                    "pattern" => "^(^\+[0-9]\s?|^62)(\d{3,4}-?){2}\d{3,4}$",
                                                    "required" => "required",
                                                    "value" => config_item('whatsapp')
                                                );
                                                echo form_label($data["placeholder"]." (62xx123456789)");
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label class="control-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-addon text-left" style="font-size:12px;padding:9px 10px 8px;min-width:160px">
                                            https://instagram.com/
                                        </span>
                                        <input type="text" class="form-control input-md" name="instagram" placeholder="Instagram" style="border-radius:0 4px 4px 0" value="<?php echo config_item('instagram'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-addon text-left" style="font-size:12px;padding:9px 10px 8px;min-width:160px">
                                            https://facebook.com/
                                        </span>
                                        <input type="text" class="form-control input-md" name="facebook" placeholder="Facebook" style="border-radius:0 4px 4px 0" value="<?php echo config_item('facebook'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-addon text-left" style="font-size:12px;padding:9px 10px 8px;min-width:160px">
                                            https://twitter.com/
                                        </span>
                                        <input type="text" class="form-control input-md" name="twitter" placeholder="Twitter" style="border-radius:0 4px 4px 0" value="<?php echo config_item('twitter'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Youtube</label>
                                    <div class="input-group">
                                        <span class="input-group-addon text-left" style="font-size:12px;padding:9px 10px 8px;min-width:160px">
                                            https://youtube.com/
                                        </span>
                                        <input type="text" class="form-control input-md" name="youtube" placeholder="Youtube" style="border-radius:0 4px 4px 0" value="<?php echo config_item('youtube'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">SMTP Port</label>
                                            <input type="text" class="form-control input-md" name="smtp_port" placeholder="SMTP Port" style="border-radius:0 4px 4px 0" value="<?php echo config_item('smtp_port'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="form-group">
                                            <label class="control-label">SMTP Host</label>
                                            <input type="text" class="form-control input-md" name="smtp_host" placeholder="SMTP Host" style="border-radius:0 4px 4px 0" value="<?php echo config_item('smtp_host'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">SMTP User</label>
                                            <input type="text" class="form-control input-md" name="smtp_user" placeholder="SMTP User" style="border-radius:0 4px 4px 0" value="<?php echo config_item('smtp_user'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">SMTP Password</label>
                                            <input type="text" class="form-control input-md" name="smtp_password" placeholder="SMTP Password" style="border-radius:0 4px 4px 0" value="<?php echo config_item('smtp_password'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <label class="control-label">Alamat Kampus</label>
                                    <textarea class="form-control" name="address" placeholder="Alamat Kampus" style="resize:none" rows="3" required><?php echo config_item('address'); ?></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-3" style="padding-top:26px">
                                <button type="submit" class="btn btn-md btn-primary full-width" style="height:65px">Simpan Pengaturan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        FormPlugins.init();
    });
</script>