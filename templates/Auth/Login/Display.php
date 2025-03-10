<div class="d-flex align-items-center justify-content-between m-b-30">
    <img class="img-fluid" alt="" src="../logo-SMK9-2.png" style="width:50px;">
    <h2 class="m-b-0">Login</h2>
</div>
<form method="post" id="form-data">
    <div class="form-group">
        <label class="font-weight-semibold" for="userName">Username:</label>
        <div class="input-affix">
            <i class="prefix-icon anticon anticon-user"></i>
            <input type="text" class="form-control" id="userName" placeholder="Username" required name="username">
        </div>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold" for="password">Password:</label>
        <a class="float-right font-size-13 text-muted" href="<?= $this->Url->build('/auth/forget-password') ?>">Forget
            Password?</a>
        <div class="input-affix m-b-10">
            <i class="prefix-icon anticon anticon-lock"></i>
            <input type="password" class="form-control" name="password" required id="password" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
    </div>
</form>