
 <a class="btn btn-success" data-toggle="modal" data-target="#myModal"> Tambah Penguji </a> </strong><div class="modal fade" id="myModal" tabindex="-1"   data-backdrop="false" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Tambah Data Penguji </h4>
      </div>
      <div class="modal-body">
          <div id="hasil"></div>
      <form role="form" method="POST" action="<?php echo base_url() ?>penguji/prosestambah">

            <select class="form-control" name="nip[]" id="select2" multiple="multiple" style='width:500px'>

            <option value='0'> Masukan Nama Pegawai </option>
            </select>
            <br />
            <button type="button" class="btn btn-primary" id="btnsave" onclick="save()">Simpan</button>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



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
        $no = $no * 10;
        $no = $no + 1;
    }


foreach($data as $k => $v): ?>
<tr>
    <td> <?php echo $no; ?> </td>
    <td> <?php echo $v->nip ?></td>
    <td> <?php echo $v->nik ?></td>
    <td> <?php echo $v->nama_lengkap ?></td>
    <td> <?php echo $v->golongan ?></td>
    <td> <?php echo $v->tipe_fungsional ?></td>
    <td>
    <a href="<?php echo base_url() ?>backend/penguji/tambahjabfung/<?php echo $v->nip ?>" class="btn btn-info"> Daftar Yang Di Uji </a>    
    <a href="<?php echo base_url() ?>backend/penguji/hapus/<?php echo $v->nip ?>" class="btn btn-danger"> Hapus </a>    
    </td>
</tr>

<?php
$no = $no+1;
endforeach ?>

</tbody>

</table>
<?php 
echo $pagination;
?>



<script type="text/javascript">
    function save(){

        var nip = $("#select2").val();

        // alert(nip);

        if(nip == null){
            $("#hasil").html('<div class="alert alert-danger">Pilih Karyawan Dahulu </div>');
   
        }else{
        $.ajax({
            type:"POST",
            data:"nip="+nip,
            url:base_url+'backend/penguji/prosestambah',
            success:function(dt){
                if(dt == 'berhasil'){
                    $("#myModal").modal('hide');
                    Swal.fire(
      'Berhasil!',
      'Data Dupak Berhasil Di Kirim Ke Penguji',
      'success'
    )
                        setTimeout(function(){ window.location.reload() }, 100);

                }else{
                    $("#btnsave").show();

                    $("#hasil").html('<div class="alert alert-danger"> Gagal Menambahkan Penguji </div>');

                }
            }
        })

    }

    }


   $(document).ready(function(){

      $("#select2").select2({
         ajax: { 
           url: '<?= base_url() ?>backend/penguji/getpenguji',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
               console.log(response);
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>