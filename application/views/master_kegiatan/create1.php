<div class="row">
<div class="col-md-6">

    <div class="form-group">
    <label> Sub Unsur </label>
    <input type="text" name="id_subunsur" value="" class="form-control"> 
    </div>
    <select class="form-control" name="id_subunsur" id="id_subunsur">
        

        <?php
        foreach ($master_unsur as $data) { ?>
        <option value="<?php echo $data['nama_unsur'] ; ?>">
            <?php echo strtoupper($data['nama_unsur']) ; ?>
        </option>
       <?php
    }
    ?>
</select>

</div>


<div class="col-md-6">


    <div class="form-group">
    <label> Nomor HP </label>

    </div>

</div>

<br />

<button type="submit" class="btn btn-primary btn-lg pull-right"> Simpan </button>

</div>
