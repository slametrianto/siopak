<div class="row">
    <?php echo $this->session->flashdata('message') ?>
<div class="col-md-6">

    <form action="<?php echo base_url('biodata/update') ?>" method="post">
    <div class="form-group">
    <label> NIK </label>
    <input type="text" name="nik" value="<?php echo $data->nik ?>" class="form-control" readonly> 

    </div>


    <div class="form-group">
    <label> Nama Lengkap </label>
    <input type="text" name="nama_lengkap" value="<?php echo $data->nama_lengkap ?>" class="form-control"> 

    </div>


    <div class="form-group">
    <label> Tempat Lahir </label>
    <input type="text" name="tempat_lahir" value="<?php echo $data->tempat_lahir ?>" class="form-control"> 

    </div>


    <div class="form-group">
    <label> Tanggal Lahir </label>
    <input type="date" name="tanggal_lahir" value="<?php echo $data->tanggal_lahir ?>" class="form-control" style="line-height: 16px;"> 

    </div>

    


</div>


<div class="col-md-6">

    <div class="form-group">
        <label> NIP </label>
        <input type="text" name="nik" value="<?php echo $data->nip ?>" class="form-control" readonly> 

        </div>


    <div class="form-group">
    <label> Alamat </label>
    <input type="text" name="alamat" value="<?php echo $data->alamat ?>" class="form-control"> 
    </div>

    <div class="form-group">
    <label> E-mail </label>
    <input type="text" name="email" value="<?php echo $data->email ?>" class="form-control"> 

    </div>

    <div class="form-group">
    <label> Nomor HP </label>
    <input type="text" name="no_telp" value="<?php echo $data->no_telp ?>" class="form-control" > 

    </div>



</div>

<br />

<button type="submit" class="btn btn-primary btn-lg pull-right"> Simpan </button>

</form>

</div>
