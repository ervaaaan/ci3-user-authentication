<?php 
    $this->load->view("userbase/component/js_index");
    $this->load->view("userbase/modal/add");
    $this->load->view("userbase/modal/edit");
    $this->load->view("userbase/modal/delete");
?>
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
        <div class="col-12">
            <div class="panel panel-inverse mat-shadow">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo is_array($title)? implode(" - ", $title) : $title; ?></h4>
                </div>
                <div class="panel-body">
                    <!-- <div class="btn-group pull-left">
                        <button type="button" class="btn btn-md btn-primary data-add"><i class="fa fa-plus"></i> New User</button>
                    </div> -->
                    <table id="data-table-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="1">No</th>
                                <th class="text-nowrap">Nama Pengguna</th>
                                <th class="text-nowrap">Username</th>
                                <th class="text-nowrap">Role</th>
                                <th class="text-nowrap">E-mail</th>
                                <th class="text-nowrap">No. Telp</th>
                                <th width="1" class="all text-center">Options</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
