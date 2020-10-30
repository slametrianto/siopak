            <div class="row">
            <?php echo back_button() ?>

                <div class="col-md-8 col-md-offset-2">
                   
                    <div class="account-box">
                         
                        <div>
                        </div>
                        <form method="post" action="<?php echo base_url('backend/user/proses') ?>" enctype="multipart/form-data">
                            <div class="<?php echo form_error('nip') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="nik">NIP</label>
                                <input type="text" name="nip" value="<?php echo set_value('nip') ?>" class="form-control">
                                <span style="color: red;"><?php echo form_error('nip'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('nik') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" required="required" value="<?php echo set_value('nik') ?>" class="form-control">
                                <span style="color: red;"><?php echo form_error('nik'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" required="required" value="<?php echo set_value('nama_lengkap') ?>"  class="form-control">
                                 <span style="color: red;"><?php echo form_error('nama_lengkap'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" required="required" value="<?php echo set_value('tempat_lahir') ?>" class="form-control">
                                <span style="color: red;"><?php echo form_error('tempat_lahir'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tanggal lahir</label>
                                <input type="date" name="tanggal_lahir" required="required" value="<?php echo set_value('tanggal_lahir') ?>" class="form-control" style="line-height: 16px;">
                                <span style="color: red;"><?php echo form_error('tanggal_lahir'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required="required"><?php echo set_value('alamat');?>
                                </textarea>
                                 <span style="color: red;"><?php echo form_error('alamat'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo set_value('email') ?>" required="required" class="form-control">
                                 <span style="color: red;"><?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>No telepon</label>
                                <input type="text" name="no_telepon" value="<?php echo set_value('no_telepon') ?>" required="required" class="form-control">
                                <span style="color: red;"><?php echo form_error('no_telepon'); ?></span>
                            </div>
                            
                            <div class="form-group <?php echo form_error('fungsional') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Fungsional</label>
                                <select name="id_tipefungsional" class="form-control" onchange="get_jenjang(this.value)" required="required">
                                <option value="">-- Pilih --</option>
                                 <?php foreach ($fungsional as  $k => $val) { ?>
                                    <option value="<?php echo $val->id_tipefungsional; ?>"> <?php echo $val->tipe_fungsional; ?> </option>
                                    <?php } ?>
                                </select>
                                <span style="color: red;"><?php echo form_error('id_tipefungsional'); ?></span>
                            </div>

                            <div class="form-group <?php echo form_error('jenjang') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="jenjang">Jabatan</label>
                                <select name="id_jenjang" class="form-control" id="jenjang" required="required" onchange="get_golongan(this.value)">
                                </select>
                                <span style="color: red;"><?php echo form_error('jenjang'); ?></span>
                            </div>

                            
                            <div class="form-group <?php echo form_error('golongan') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="jenjang">Golongan</label>
                                <select name="id_golongan" class="form-control" id="golongan" required="required">
                                </select>
                                <span style="color: red;"><?php echo form_error('golongan'); ?></span>
                            </div>
                            
                             <hr>
                             <input type='checkbox' name='is_user' value='1'> Daftarkan sebagai User Jabfung 

                           <input type="submit" class="btn btn btn-primary pull-right" value="Simpan">
                        </form>                     
                        <br />
                         <br />
                </div>
            </div>
        </div>


        <script>   
        var base_url = '<?php echo base_url() ?>';

        let dropdown_golongan = $("#golongan");
        dropdown_golongan.empty();
        dropdown_golongan.append("<option select='true' value=''  disabled'> Pilih Jenjang Dahulu </option>");
        dropdown_golongan.prop('selectedIndex',0);

        let dropdown_jenjang = $("#jenjang");
        dropdown_jenjang.empty();
        dropdown_jenjang.append("<option select='true' value=''  disabled'> Pilih Tipe Fungsional Dahulu </option>");
        dropdown_jenjang.prop('selectedIndex',0);

            function get_jenjang(a){
               // alert(a);
                if(a == ''){
                    dropdown_jenjang.empty();
                    dropdown_jenjang.append("<option select='true' value='' disabled'> Pilih Tipe Fungsional Dahulu </option>");
                    dropdown_jenjang.prop('selectedIndex',0);
                    dropdown_golongan.empty();
                    dropdown_golongan.append("<option select='true'  value=''  disabled'> Pilih Jenjang Dahulu </option>");
                    dropdown_golongan.prop('selectedIndex',0);
                }else{
                    $.ajax({
                        type:"POST",
                        data:"id_tipefungsional="+a,
                        dataType:"json",
                        url:base_url+"ajax/get_jenjang",
                        success:function(dt){
                            console.log(dt);
                            if(dt.status == 'TRUE'){
                            // dropdown.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
                            $.each(dt.data, function (key, entry) {
                                dropdown_jenjang.append($('<option></option>').attr('value', entry.id_jenjang).text(entry.nama_jenjang));
  });
                            }


                        }
                    })
                }
                
            }



            function get_golongan(a){
               // alert(a);
                if(a == ''){
                    dropdown_golongan.empty();
                    dropdown_golongan.append("<option select='true'  value='' disabled'> Pilih Jenjang Dahulu </option>");
                    dropdown_golongan.prop('selectedIndex',0);
                }else{
                    $.ajax({
                        type:"POST",
                        data:"id_golongan="+a,
                        dataType:"json",
                        url:base_url+"ajax/get_golongan",
                        success:function(dt){
                            console.log(dt);
                            if(dt.status == 'TRUE'){
                                dropdown_golongan.empty();
                    dropdown_golongan.append("<option select='true' value=''  disabled'> Pilih Golongan </option>");
                   
                            // dropdown.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
                            $.each(dt.data, function (key, entry) {
                                dropdown_golongan.append($('<option></option>').attr('value', entry.id_golongan).text(entry.golongan+" - "+entry.nama_golongan));
  });
                            }


                        }
                    })
                }
                
            }

            </script>