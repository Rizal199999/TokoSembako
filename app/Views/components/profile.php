<div class="d-flex align-items-center ms-4 mb-4">
    <div class="position-relative">
        <img class="rounded-circle" src="<?php echo base_url() ?>assets/img/user.jpg" alt=""
            style="width: 40px; height: 40px;">
        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
        </div>
    </div>
    <div class="ms-3">
        <h6 class="mb-0">
            <?= ucfirst(session()->get('username')) ?></h6>
        <span>
            <?= ucfirst(session()->get('role')) ?></span>
    </div>
</div>