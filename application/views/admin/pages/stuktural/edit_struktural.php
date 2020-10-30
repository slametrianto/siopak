            <div class="row">
            <?php echo back_button() ?>

                <div class="col-md-8 col-md-offset-2">
                   
                    <div class="account-box">
                         
                        <div>
                        </div>
                        <?php foreach($param as $data){ ?>
                        <form method="post" action="<?php echo base_url('backend/struktural/update_struktural') ?>/<?php echo $data['id_tipefungsional']; ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <input type="hidden" name="id_tipefungsional" value="<?php echo $data['id_tipefungsional']; ?>" class="form-control">
                                <label>Fungsional/Struktural</label>
                                <input type="text" name="tipe_fungsional" value="<?php echo $data['tipe_fungsional']; ?>"class="form-control">
                                <span style="color: red;"><?php echo form_error('tipe_fungsional'); ?></span>
                            </div>
                             <hr>
                           <input type="submit" class="btn btn btn-primary pull-right" value="Simpan">
                        </form>       
                         <?php } ?>              
                        <br />
                         <br />
                </div>
            </div>
        </div>
