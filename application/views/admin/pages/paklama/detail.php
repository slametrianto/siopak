
<div class="col-md-12">
<a class="btn btn-warning pull-right" href="javascript:history.back()"> <i class="fa fa-arrow-left"></i>
<span> Kembali </span></a>

</div>



        
<form method="POST" action="<?php echo base_url() ?>backend/paklama/proses" enctype="multipart/form-data">
<input type="hidden" name="nip" value="<?php echo $files->nip ?>">
<div class="form-group">
<label> File Bukti :  <a href="<?php echo  base_url() ?>file_pak/<?php echo $files->file_bukti ?>" target="_blank">  File PAK </a>  </label>
<br />
<label> Tahun Periode Sebelumnya : <?php echo $files->tahun ?></label>
<button type="submit" class="btn btn-primary"> Simpan Data </button>

</div>
<div class="clearfix"></div>
 <h4> Masukan Nilai  Koreksi PAK  </h4>
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
                     <td> <input type="text" name="ak_periode_sebelumnya[]" value="<?php echo @$v->ak_lama_jafung ?>" readonly="readonly" class="form-control">
                  </td>
                  <td> <input type="text" name="ak_lama_admin[]" value="<?php echo @$v->ak_lama_admin ?>" class="form-control">
                     <input type="hidden" name="kode_kegiatan[]" value="<?php echo $v->kode_kegiatan ?>">
                  </td>
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