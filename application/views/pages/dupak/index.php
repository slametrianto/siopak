
<?php if(@$pengajuan->status >= 1){ ?>
Anda Telah Mengajukan DUPAK  <br />
Tanggal Pengajuan : <?php echo tgl_indo($pengajuan->tanggal_pengajuan) ?> <br />
Status Pengajuan : <?php echo $pengajuan->status_penilaian ?> <br  />

<?php if(@$pengajuan->status == 99){ ?>
<a class="btn btn-success" href="#" onclick="ajukan()"> Ajukan </a>
<?php } ?>

<?php }else{ ?>
<a class="btn btn-primary pull-left" href="<?php echo base_url() ?>dupak/add"> Tambah Data </a>
&nbsp;&nbsp;
<?php if(count($data) > 0){ ?>
<a class="btn btn-success" href="#" onclick="ajukan()"> Ajukan </a>
<?php } ?>
<?php } ?>
<br /><br />
<table class="table table-striped table-bordered">
<thead>
<tr>
    <th> No </th>
    <th> Nomor SPT </th>
    <th> Tanggal SPT </th>
    <th> Lokasi </th>
    <th> Subjek Tugas  </th>
    <th> Kode Kegiatan </th>
    <th> Pekerjaan </th>    
    <th> Angka Kredit </th>
    <th> Bobot Kredit </th>
    <th> Jumlah Kredit </th>
    <th> Status Pengajuan </th>
    <th> Aksi </th>
</tr>

</thead>
<tbody> 
    <?php
    $total_data = 0;
    $total_acc = 0;
    foreach($data as $k => $v):
        $total_data = $total_data + 1;
        if($v->id_status == 5){
            $total_acc = $total_acc + 1;
        }
    ?>
<tr>
    <td> <?php echo $k+1; ?> </td>
    <td><?php echo $v->nomor_spt ?> </td>
    <td><?php echo tgl_indo($v->tanggal) ?> </td>
    <td> <?php echo $v->lokasi; ?> </td>
    <td> <?php echo $v->subjek_tugas; ?> </td>
    <td> <?php echo $v->kode_kegiatan; ?> </td>
    <td> <?php echo $v->rincian; ?> </td>
    <td align="center"> <?php echo $v->dupak_ak; ?> </td>
    <td align="center"> <?php echo $v->bobot_kredit; ?> </td>
    <td align="center"> <?php echo ($v->dupak_ak*$v->bobot_kredit); ?> </td>
    <td> <?php echo $v->status;
    if($v->id_status == 99){ 

        echo "<Br />Komentar Dari Admin : ".$v->komentar;
    }else if($v->id_status == 98){ 
        echo " <br ><strong> Alasan Penolakan Tim Penilai : ".$v->komentar_penguji;
    }
    ?>
</td>
    <td> 
        <?php if($v->id_status == 1 OR $v->id_status == 99){ ?>
    <a href="<?php echo base_url() ?>dupak/detail/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        
    <a href="<?php echo base_url() ?>dupak/edit/<?php echo $v->id_dupak ?>" class="btn btn-info"> Edit </a>        
    <a href="#" onclick="hapus(<?php echo $v->id_dupak ?>)" class="btn btn-danger"> Hapus </a>   
        <?php }else{ ?>
            <a href="<?php echo base_url() ?>dupak/detail/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        

        <?php } ?>
</td>
</tr>

    <?php endforeach ?>


</tbody>


</table>



<?php echo $pagination ?>

<?php 
if($total_data != 0){
if($total_acc == $total_data){ ?>

<a href="<?php echo base_url() ?>dupak/cetak/<?php echo $_SESSION['nip'] ?>" target="_blank" class="btn btn-primary btn-2x"> Cetak PAK </a>

<?php

}else{
// echo $total_acc;
}
}
?>


<script>
    function ajukan(){

        Swal.fire({
  title: 'Ajukan DUPAK ini ?',
  html: "<b>Pastikan A.K. Lama sudah diisi.</b><br><br>Anda yakin ajukan dupak ini ?",
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