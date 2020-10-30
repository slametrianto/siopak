<style type="text/css">
    textarea.form-control {
        height: 100%;
    }
</style>
<div class="row">
<div class="col-md-8">
    <form role="form" method="POST" action="<?php echo base_url() ?>master_kegiatan/process">
    <div class="form-group">
        <label> UNSUR </label>
        <?php
        echo '<select class="form-control" name="id_unsur" id="id_unsur">';
        echo '<option value="">-- PILIH --</option>';
        foreach ($master_unsur as $data) { 
            echo '<option value="'.$data['id_unsur'].'">'.strtoupper($data['nama_unsur']).'</option>';    
        }
        echo '</select>';
        ?>
    </div>

    <div class="form-group">
        <label> SUB UNSUR </label>
        <?php
        echo '<select class="form-control" name="id_subunsur" id="nama_subunsur">';
        echo '<option value="">-- PILIH --</option>';
        foreach ($master_subunsur as $data) { 
            echo '<option value="'.$data['id_subunsur'].'">'.strtoupper($data['nama_subunsur']).'</option>';    
        }
        echo '</select>';
        ?>
    </div>

    <div class="form-group">
        <label> RINCIAN KEGIATAN </label>
        <textarea name="nama_kegiatan" id="nama_kegiatan" class="form-control" rows="3" style="height:auto !important;"></textarea>
    </div>

    <div class="form-group">
        <label> KODE KEGIATAN </label>
        <input type="text" name="kode_kegiatan" id="kode_kegiatan" value="" class="form-control"> 
    </div>

    <div class="form-group" id="only-number">
        <label> BESARAN ANGKA KREDIT </label>
        <input type="text" name="angka_kredit" id="angka_kredit" value="" class="form-control"> 
    </div>

    <div class="form-group">
        <label> SATUAN HASIL </label>
        <input type="text" name="satuan_hasil" id="satuan_hasil" value="" class="form-control"> 
    </div>

    <div class="form-group">
        <label> PELAKSANA KEGIATAN </label>
        <input type="text" name="pelaksanaan" id="pelaksanaan" value="" class="form-control"> 
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg pull-left"> Simpan </button>
        <input type="text" name="id_kegiatan" id="id_kegiatan" value="" class="form-control"> 
    </div>
    </div>
    </form>
</div>
</div>
<script>
    $(function() {
      $('#only-number').on('keydown', '#angka_kredit', function(e){
          -1!==$
          .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
          .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
          || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
          && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
      });

      
    })
</script>