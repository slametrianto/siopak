            <div class="row">
            <?php echo back_button() ?>

                <div class="col-md-8 col-md-offset-2">
                   
                    <div class="account-box">
                         
                        <div>
                        </div>
                        <form method="post" action="<?php echo base_url('backend/struktural/proses') ?>" enctype="multipart/form-data">
                           
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Fungsional/Struktural</label>
                                <input type="text" name="tipe_fungsional" value="<?php echo set_value('tipe_fungsional') ?>" required="required" class="form-control">
                                <span style="color: red;"><?php echo form_error('tipe_fungsional'); ?></span>
                            </div>
                            
                             <hr>

                           <input type="submit" class="btn btn btn-primary pull-right" value="Simpan">
                        </form>                     
                        <br />
                         <br />
                </div>
            </div>
        </div>
