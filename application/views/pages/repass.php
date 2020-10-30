<?php echo $this->session->flashdata('message') ?>

<div class="row">
<div class="col-md-6 col-md-offset-3">

    <form action="<?php echo base_url('repassword/ganti_pass') ?>" method="post">
    <div class="form-group <?php //echo form_error('passL') ? 'has-error' : null; ?>">
        <label> Password Lama </label>
            <input type="password" name="passL" class="form-control" required="required"> 
        <!--<span style="color: red;"><?php echo form_error('passL'); ?></span>-->
    </div>


    <div class="form-group <?php //echo form_error('passL') ? 'has-error' : null; ?>">
        <label> Password Baru</label>
            <input type="password" name="passB" class="form-control" required="required">
        <!--<span style="color: red;"><?php echo form_error('passL'); ?></span>-->
    </div>
    

    <div class="row">
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary" value="simpan">
        </div>
        
    </div>
    </form>


</div>
</div>
