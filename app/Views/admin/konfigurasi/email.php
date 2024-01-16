


<?php echo form_open(base_url('admin/konfigurasi/email')) ?>
<input type="hidden" name="id_konfigurasi" value="<?php echo $site->id_konfigurasi ?>">
<div class="form-group row">
    <label class="col-md-3">Protocol</label>
    <div class="col-md-9">
        <input type="text" name="protocol" placeholder="Protocol" value="<?php echo $site->protocol ?>" class="form-control">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3">Host</label>
    <div class="col-md-9">
        <input type="text" name="smtp_host" placeholder="Host" value="<?php echo $site->smtp_host ?>" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Port</label>
    <div class="col-md-9">
        <input type="text" name="smtp_port" placeholder="Port" value="<?php echo $site->smtp_port ?>" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">TimeOut</label>
    <div class="col-md-9">
        <input type="text" name="smtp_timeout" placeholder="TimeOut" value="<?php echo $site->smtp_timeout ?>" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">User</label>
    <div class="col-md-9">
        <input type="text" name="smtp_user" placeholder="User" value="<?php echo $site->smtp_user ?>" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Password</label>
    <div class="col-md-9">
        <input type="password" name="smtp_pass" placeholder="Port" value="<?php echo $site->smtp_pass ?>" class="form-control">
    </div>
</div>

<hr>
<div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
        <input type="submit" name="submit" value="Save Configuration" class="btn btn-success btn-lg">
        <input type="reset" name="reset" value="Reset" class="btn btn-primary btn-lg">
    </div>
</div>



</form>

