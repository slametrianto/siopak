
  <?php echo back_button() ?>

 <a class="btn btn-success" data-toggle="modal" data-target="#myModal"> Tambah Pegawai yang akan di Uji </a> 
 <div class="modal fade" id="myModal" tabindex="-1"   data-backdrop="false" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Tambah Jabfung </h4>
      </div>
      <div class="modal-body">
          <div id="hasil"></div>
      <form role="form" method="POST" action="<?php echo base_url() ?>penguji/prosestambahjabfung">
    <input type="hidden" name="nip_penguji" id="nip_penguji" value="<?php echo $penguji->nip ?>">
            <select class="form-control" name="nip[]" id="select2" multiple="multiple" style='width:500px'>

            <option value='0'> Masukan Nama Pegawai </option>
            </select>
            <br /> <Br />
            <button type="button" class="btn btn-primary" id="btnsave" onclick="save()">Simpan</button>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<h3> Data Penguji </h3>
<p> Nama Penguji : <strong> <?php echo $penguji->nama_lengkap ?>  </strong> <br />
    NIP Penguji : <strong> <?php echo $penguji->nip ?> </strong> <br />
    Golongan/Pangkat : <strong> <?php echo $penguji->golongan."  ".$penguji->nama_golongan ?> </strong> <br />
    Jabatan : <strong> <?php echo $penguji->tipe_fungsional." ".$penguji->nama_jenjang ?> </strong> <br />
    <br />
</p>
<h4> Daftar Jabfung yang akan diuji </h4>
<table class="table table-striped">
<thead>
<tr>
    <th> No </th>
    <th> NIP </th>
    <th> NIK </th>
    <th> Nama Lengkap </th>
    <th> Golongan </th>
    <th> Jabatan </th>
    <th> Action </th>
</tr>

</thead>
<tbody>
<?php 
    $no = 1;
    if($this->uri->segment(4) != ''){
        $no = $no + 1;
    }


foreach($data as $k => $v): ?>
<tr>
    <td> <?php echo $k+1; ?> </td>
    <td> <?php echo $v->nip ?></td>
    <td> <?php echo $v->nik ?></td>
    <td> <?php echo $v->nama_lengkap ?></td>
    <td> <?php echo @$v->golongan." ".$v->nama_golongan ?></td>
    <td> <?php echo @$v->tipe_fungsional." ".@$v->nama_jenjang ?></td>
    <td>
    <a href="<?php echo base_url() ?>backend/penguji/hapusjabfung/<?php echo $v->nip ?>/<?php echo $penguji->nip ?>" class="btn btn-danger"> Hapus </a>    
    </td>
</tr>

<?php
$no = $no+1;
endforeach ?>

</tbody>

</table>
<?php 
?>



<script type="text/javascript">

    function save(){

        var nip = $("#select2").val();
        var nip_penguji = $("#nip_penguji").val();

        if(nip == null){
            $("#hasil").html('<div class="alert alert-danger"> Pilih Jabfung dahulu </div>');

        }else{

        $.ajax({
            type:"POST",
            data:"nip="+nip+"&nip_penguji="+nip_penguji,
            url:base_url+'backend/penguji/prosestambahjabfung',
            success:function(dt){
                if(dt == 'berhasil'){
                    $("#myModal").modal('hide');
                    Swal.fire(
      'Berhasil!',
      'Daftar Karyawan yang akan diuji berhasil ditambahkan',
      'success'
    )
                    setTimeout(function(){ window.location.reload() }, 1000);

                }else{
                    $("#btnsave").show();

                    $("#hasil").html('<div class="alert alert-danger"> Gagal Menambahkan Penguji </div>');

                }
            }
        });

    }

    }


   $(document).ready(function(){


       var nip = "<?php echo $penguji->nip ?>";

      $("#select2").select2({
         ajax: { 
           url: '<?= base_url() ?>backend/penguji/getkaryawan',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term,
                nip:nip // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>
