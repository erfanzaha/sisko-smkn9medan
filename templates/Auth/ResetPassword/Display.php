<div class="d-flex align-items-center justify-content-between m-b-30">
    <img class="img-fluid" alt="" src="../logo.jpg" style="width:50px;">
    <h2 class="m-b-0">Reset Password</h2>
</div>
<div class="alert alert-danger bg-danger" style='display:none;' id="msg-pass">
    <span></span>
</div>
<form method="post" id="form-data">
    <input type="hidden" name="id_reset" id="id" value="0">
    <input type="hidden" name="type" id="type" value="0">
    <div class="form-group">
        <label class="font-weight-semibold" for="userName">New Password:</label>
        <div class="input-affix">
            <i class="prefix-icon anticon anticon-lock"></i>
            <input class="form-control" type="password" name="r_newpass" id="password" placeholder="New Password"
                required onkeyup="checkPass();">
        </div>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold" for="password">Confirm Password:</label>
        <div class="input-affix m-b-10">
            <i class="prefix-icon anticon anticon-lock"></i>
            <input class="form-control" type="password" name="confirm" id="confirm" placeholder="Konfirmasi Password"
                required onkeyup="checkPass();">
        </div>
    </div>
    <div class="form-group">
        <div class="d-flex align-items-center justify-content-between">
            <span class="font-size-13 text-muted">
                <a class="small" href="<?= $this->Url->build('/auth/login') ?>"> Kembali Login ?</a>
            </span>
            <button type="button" class="btn disbled" id="btnSimpan">Reset Password</button>
        </div>
    </div>
</form>