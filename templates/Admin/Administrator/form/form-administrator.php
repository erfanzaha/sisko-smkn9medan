<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_auth" name="id_auth">
        <div class="form-group ">
            <label for="nama_admin">Nama Admin</label>
            <input type="text" class="form-control" id="nama_admin" name="nama_admin" required placeholder="Nama Admin">
        </div>
        <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
        </div>
        <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
        </div>
        <hr>
        <div id="">
            <div class="alert alert-danger bg-danger" style='display:none;' id="msg-pass">
                <span></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input required class="form-control" name="password" type="password" id="password"
                    placeholder="Password" onkeyup="checkPass();">
            </div>

            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <input required class="form-control" name="confirm" type="password" id="confirm"
                    placeholder="Confirm Password" onkeyup="checkPass();">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>