

        
       <form method="POST" action="<?php echo base_url() ?>dupaklama/proses" enctype="multipart/form-data">

     
       <div class="form-group col-md-3">
       <label> Upload File PAK Periode Sebelumnya </label>
       <?php if(isset($file->file_bukti) != ''){ ?>
        <a href="<?php echo  base_url() ?>file_pak/<?php echo $file->file_bukti ?>" target="_blank">  File PAK </a>
    
    <?php } ?>
       <input type="file" name="file_pak" class="form-control" required="required">
       <br />
       <label> Tahun Periode Sebelumnya </label>
       <input type="text" name="tahun" class="form-control"  required="required" value="<?php echo $tahun ?>">
       <button type="submit" class="btn btn-primary"> Simpan </button>

       </div>

       
       <div class="clearfix"></div>
        <h4> Masukan Nilai PAK Periode Sebelumnya </h4>
       <table class="table table-striped" style='height:100px;' id="myTable">
                <thead> 
                <tr>
                    <th> Tipe Unsur </th>
                    <th> Unsur </th>
                    <th> Sub Unsur </th>
                    <th> Kode Kegiatan </th>
                    <th> Kegiatan </th>
                    <!-- <th> Satuan Hasil </th> -->
                    <th> Angka Kredit </th>
                    <th> Angka Kredit Periode Sebelumnya </th>
                    <th> Nilai Admin </th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $nama_utama  = '';
                foreach($kegiatan as $k => $v): ?>
                            <tr>
                                <?php if($nama_utama == ''){ 
                                        $nama_utama = $v->nama_utama;
                                    ?>
                                    <td> <?php echo $v->nama_utama ?> </td>

                                <?php }else{ 
                                        if($v->nama_utama != $nama_utama){
                                            $nama_utama = $v->nama_utama; 
                                            ?>
                                            <td> <?php echo $v->nama_utama ?> </td>
                                        <?php
                                        }else{
                                            echo "<td> </td>";
                                        }
                                    ?>


                                 <?php } ?>
                            <td> <?php echo $v->nama_unsur ?> </td>
                            <td> <?php echo $v->nama_subunsur ?> </td>
                            <td> <?php echo $v->kode_kegiatan ?> </td>
                            <td> <?php echo @$v->kegiatan ?> </td>
                            <td style="display:none"> <?php// echo $v->satuan_hasil ?> </td>
                            <td> <?php echo $v->angka_kredit ?> </td>
                            <td> <input type="text" name="ak_periode_sebelumnya[]" value="<?php echo @$v->ak_lama_jafung ?>" class="form-control">
                            <input type="hidden" name="kode_kegiatan[]" value="<?php echo $v->kode_kegiatan ?>">
                         </td>
                            <td>  </td>
                            </tr>
                <?php endforeach ?>

                </tbody>
        
        </table>



<script>

var table;


        Swal.fire({
  title: 'Ajukan DUPAK ini ?',
  text: "Anda yakin ajukan dupak ini ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ajukan'
}).then((result) => {
  if (result.value) {

    $.ajax({
        type:"POST",
        url:base_url+"dupak/pengajuan",
        dataType:"json",
        success:function(dt){
            Swal.fire(
      'Berhasil!',
      'Pengajuan Berhasil Diajukan',
      'success'
    )

    window.location.reload();
        }
    })


   
  }
})

    }


    function hapus(id_dupak){
Swal.fire({
title: 'Hapus SPT ini ?',
text: "Anda yakin hapus SPT ini ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Hapus'
}).then((result) => {
if (result.value) {

$.ajax({
type:"POST",
url:base_url+"dupak/hapus",
data:"id_dupak="+id_dupak,
dataType:"json",
success:function(dt){
    Swal.fire(
'Berhasil!',
'SPT Berhasil Dihapus',
'success'
)

window.location.reload();
}
})



}
})

}

</script>