<div class="row">
    <?php echo back_button() ?>
    <?php echo $this->session->flashdata('message') ?>
    
    <div class="col-md-3">
                <div class="text-center">
                  <?php if ($user->photo != null) { ?>
                      <img class="profile-user-img img-fluid img-rensponsive"
                       src="<?php echo base_url('assets/foto_user/'.$user->photo) ?>"
                       alt="User profile picture" style="width: 60%; height: 60%;">
                  <?php }else{ ?>
                     <img class="profile-user-img img-fluid img-rensponsive"
                       src="<?php echo base_url('assets/img/images.png') ?>"
                       alt="User profile picture" style="width: 60%; height: 60%;">
                  <?php } ?>
                </div>

                <br>
                
                <p class="text-muted text-center" style="font-size: 15px;"><strong><?php echo $data->nama_lengkap ?></strong></p>

                <p class="text-muted text-center"><?php echo $data->tipe_fungsional ?></p>
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><b>Ganti Foto Profil</b></button>
    </div>

    <div class="col-md-9">
    <form action="<?php echo base_url('biodata/update') ?>" method="post">
    


    <div class="col-md-4">

    <div class="form-group">
    <label> NIK  <span style='color:red'> (*) </span> </label>
    <input type="text" name="nik" value="<?php echo $data->nik ?>" class="form-control" readonly> 

    </div>


    <div class="form-group">
    <label> Nama Lengkap  <span style='color:red'> (*) </span> </label>
    <input type="text" name="nama_lengkap" value="<?php echo $data->nama_lengkap ?>" required="required" class="form-control"> 

    </div>


    <div class="form-group">
    <label> Tempat Lahir  <span style='color:red'> (*) </span> </label>
    <input type="text" name="tempat_lahir" value="<?php echo $data->tempat_lahir ?>"  required="required" class="form-control"> 

    </div>


    <div class="form-group">
    <label> Tanggal Lahir  <span style='color:red'> (*) </span> </label>
    <input type="date" name="tanggal_lahir" value="<?php echo $data->tanggal_lahir ?>" class="form-control" style="line-height: 16px;"> 

    </div>


    <div class="form-group">
    <label> Jenis Kelamin  <span style='color:red'> (*) </span> </label>
    <br />

    <input type="radio" name="jenis_kelamin" value="L" <?php if($data->jenis_kelamin == 'L'){ echo 'checked'; } ?>> Laki Laki 
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <input type="radio" name="jenis_kelamin" value="P"  <?php if($data->jenis_kelamin == 'P'){ echo 'checked'; } ?>>Perempuan


    </div>

    <div class="form-group">
        <label> Pendidikan  <span style='color:red'> (*) </span> </label>
        <select name="pendidikan_terakhir" class="form-control"  required="required" onchange="get_jenjang(this.value)" required="required">
                                <option value="">-- Pilih --</option>
                                 <?php foreach ($pendidikan as  $k => $val) { 
                                        if($val->nama_pendidikan == $data->pendidikan_terakhir){
                                            $selected = 'selected="selected"';
                                        }else{
                                            $selected = '';
                                        }
                                     ?>
                                    <option value="<?php echo $val->nama_pendidikan; ?>" <?php echo $selected ?>> <?php echo $val->nama_pendidikan; ?> </option>
                                    <?php } ?>
                                </select>
                                <span style="color: red;"><?php echo form_error('fungsional'); ?></span>
        </div>
    


</div>


<div class="col-md-4">
    <div class="form-group">
        <label> NIP  <span style='color:red'> (*) </span> </label>
        <input type="text" name="nip" value="<?php echo $data->nip ?>" class="form-control" readonly> 

        </div>

        <div class="form-group">
    <label> Nomor Seri Karpeg  <span style='color:red'> (*) </span> </label>
    <input type="text" name="no_seri_karpeg" value="<?php echo $data->no_seri_karpeg ?>" required="required" class="form-control"> 
    </div>


    <div class="form-group">
    <label> Alamat  <span style='color:red'> (*) </span> </label>
    <input type="text" name="alamat" value="<?php echo $data->alamat ?>" required="required" class="form-control"> 
    </div>

    <div class="form-group">
    <label> E-mail  <span style='color:red'> (*) </span> </label>
    <input type="text" name="email" value="<?php echo $data->email ?>"  required="required" class="form-control"> 

    </div>

    <div class="form-group">
    <label> Nomor HP  <span style='color:red'> (*) </span> </label>
    <input type="text" name="no_telp" value="<?php echo $data->no_telp ?>"  required="required" class="form-control" > 

    </div>

    <div class="form-group <?php echo form_error('fungsional') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Fungsional <span style='color:red'> (*) </span> </label>
                                <select name="fungsional" class="form-control" onchange="get_jenjang(this.value)" required="required">
                                <option value="">-- Pilih --</option>
                                 <?php foreach ($fungsional as  $k => $val) { 
                                        if($val->id_tipefungsional == $data->id_tipefungsional){
                                            $selected = 'selected="selected"';
                                        }else{
                                            $selected = '';
                                        }
                                     ?>
                                    <option value="<?php echo $val->id_tipefungsional; ?>" <?php echo $selected ?>> <?php echo $val->tipe_fungsional; ?> </option>
                                    <?php } ?>
                                </select>
                                <span style="color: red;"><?php echo form_error('fungsional'); ?></span>
                            </div>



</div>


<div class="col-md-4">

                            <div class="form-group <?php echo form_error('jenjang') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="jenjang">Jabatan <span style='color:red'> (*) </span> </label>
                                <select name="id_jenjang" class="form-control" id="jenjang" required="required" onchange="get_golongan(this.value)">
                                </select>
                                <span style="color: red;"><?php echo form_error('jenjang'); ?></span>
                            </div>

                            
                            <div class="form-group <?php echo form_error('golongan') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="jenjang">Golongan <span style='color:red'> (*) </span> </label>
                                <select name="id_golongan" class="form-control" id="golongan" required="required">
                                </select>
                                <span style="color: red;"><?php echo form_error('golongan'); ?></span>
                            </div>

    <div class="form-group">
    <label> Unit Kerja  <span style='color:red'> (*) </span> </label>
    <select class="form-control" name="id_instansi"  required="required">
    <?php foreach($unitkerja as $k => $v): ?>
    <option value="<?php echo $v->id_instansi ?>"> <?php echo $v->nama_instansi ?> </option>

    <?php endforeach ?>

    </select>
    </div>

    <div class="form-group">
    <label> TMT Lama  <span style='color:red'> (*) </span> </label>
    <input type="date" name="masa_kerja_lama" value="<?php echo $data->masa_kerja_lama ?>"  required="required" class="form-control" > 

    </div>

    <div class="form-group">
    <label> TMT Baru  <span style='color:red'> (*) </span> </label>
    <input type="date" name="masa_kerja_baru" value="<?php echo $data->masa_kerja_baru ?>"  required="required" class="form-control" > 

    </div>


    <div class="form-group">
    <label> TMT Jabatan  <span style='color:red'> (*) </span> </label>
    <input type="text" name="tmt_jabatan" value="<?php echo $data->tmt_jabatan ?>"  required="required" class="form-control" > 

    </div>

    <div class="form-group">
    <label> A.K. Lama  <span style='color:red'> (*) </span> </label>
    <input type="text" name="ak_lama0" value="<?php echo $data->ak_lama0 ?>"  required="required" class="form-control" > 

    </div>

</div>

<br />

<button type="submit" class="btn btn-primary btn-lg pull-right"> Simpan </button>

</form>
    </div>

</div>
<hr />
<div class="row">
    <h3 class="text-center"> Lampiran Biodata Jabfung </h3>
<div class="col-md-6">
    <form method="POST" action="<?php echo base_url() ?>biodata/upload" enctype="multipart/form-data">
<?php foreach($dokumen as $kk => $val_dok): ?>
<div class="form-group">
<label> <?php echo $val_dok->nama_dokumen ?>  <span style='color:red'> (*) </span> </label>
<input type="file" class="form-control" name="<?php echo $val_dok->id_dokumen ?>">
</div>
<?php endforeach ?>
<button type="submit" class="btn btn-primary"> Simpan </button>

    </form>

                                    </div>

<div class="col-md-6">

<table class="table table-striped">
<thead>
    <tr>
        <th> No </th>
        <th> Tipe Dokumen </th>
        <th> File </th>
    </tr>
</thead>
<tbody>
    <?php foreach($dokumenjabfung as $k => $v): ?>
    <tr>
        <td> <?php echo $k+1; ?> </td>
        <td> <?php echo $v->nama_dokumen ?> </td>
        <td>
            <a class="btn btn-primary" onclick="preview_data('dokumenjabfung/<?php echo $v->file_dokumen ?>')"> Preview </a>
            
    </td>
    </tr>
    <?php endforeach ?>


</tbody>
</table>

</div>

</div>


<!-- Modal -->
<div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <h5> File Akan terdownload otomatis ke PC Anda apabila tidak muncul </h5>
        <iframe src="" width="100%" height="400" id="iframedata"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
                <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
                    
                </div>

                <div class="modal-body">
                <?php echo form_open_multipart('biodata/update_photo') ?>

                <?php foreach ($user as $row) {
                
                } ?>
                    <div class="form-group">
                      <?php if($user->photo != null){?>
                        <div>
                           <img class="profile-user-img img-fluid img-rensponsive"
                       src="<?php echo base_url('assets/foto_user/'.$user->photo) ?>"
                       alt="User profile picture" style="width: 30%; height: 30%;">
                        </div><br>
                     <?php } ?>
                        <label>Upload Foto</label>
                        <br>
                        <input type="hidden" value="<?php echo $user->nip ?>" name="nip" style="color: #CCCC">
                        <input type="file" name="photo" required>
                    </div>


                    <button type="reset" class="btn btn-danger" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    
              <?php echo form_close(); ?>
                </div>

                
                </div>


            </div>
        </div>




<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
function preview_data(url){
    $("#modal_file").modal('show');
    $("#iframedata").attr('src',base_url+url);

}

</script>


<script>   
        var base_url = '<?php echo base_url() ?>';
        let dropdown_golongan = $("#golongan");
        // dropdown_golongan.empty();
        // dropdown_golongan.append("<option select='true' value=''  disabled'> Pilih Jenjang Dahulu </option>");
        // dropdown_golongan.prop('selectedIndex',0);

        let dropdown_jenjang = $("#jenjang");

        get_golongan(<?php echo $data->id_jenjang ?>);
        get_jenjang(<?php echo $data->id_tipefungsional ?>);
        var id_jenjang = '<?php echo $data->id_jenjang ?>';
        var id_golongan = '<?php echo $data->id_golongan ?>';

      
            function get_jenjang(a){
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
                               // dropdown_jenjang.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
                            $.each(dt.data, function (key, entry) {
                                if(entry.id_jenjang == id_jenjang){
                                    dropdown_jenjang.append($('<option></option>').attr('value', entry.id_jenjang).attr('selected','selected').text(entry.nama_jenjang));

                                }else{
                                dropdown_jenjang.append($('<option></option>').attr('value', entry.id_jenjang).text(entry.nama_jenjang));
                                }
                                    });   
                            }
                            


                        }
                    })
                }
                
            }



            function get_golongan(a){
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
                    //dropdown_golongan.append("<option select='true' value=''  disabled'> Pilih Golongan </option>");
                   
                            // dropdown.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
                            $.each(dt.data, function (key, entry) {
                                if(entry.id_golongan == id_golongan){
                                    dropdown_golongan.append($('<option></option>').attr('value', entry.id_golongan).attr('selected','selected').text(entry.golongan+" - "+entry.nama_golongan));

                                }else{
                        dropdown_golongan.append($('<option></option>').attr('value', entry.id_golongan).text(entry.golongan+" - "+entry.nama_golongan));
                            }
                            });
                            }


                        }
                    })
                }
                
            }

            </script>