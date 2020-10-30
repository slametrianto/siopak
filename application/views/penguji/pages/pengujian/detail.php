<?php echo back_button(); ?>
<h3> Detail Pengajuan DUPAK </h3>
<div class="col-md-6">
        <!-- <a class="btn btn-primary"> Kirim ke Penguji </a> -->
<div>
    <?php echo @$this->session->flashdata('item') ?>
</div>
<table class="table table-striped">
    <tr>
<td> NIP  </td>  <td> :</td><td> <?php echo $data->nip ?></td>
    </tr>
    <tr>
        <td>
Nama Karyawan  </td> <td> : </td> <td> <?php echo $data->nama_lengkap ?> </td>
    </tr>
    <tr>
        <td>
Tanggal Pengajuan </td>
<td> : </td>
<td> <?php echo tgl_indo($data->tanggal_pengajuan) ?> </td>
    </tr>
    <tr>
        <td>
Golongan/Pangkat  </td>
<td> : </td>
<td> <?php echo $data->golongan." ".$data->nama_golongan ?> </td>
    </tr>
    <tr>
        <td>
Jabatan </td><td> : </td><td> <?php echo $data->tipe_fungsional." ".$data->nama_jenjang ?> </td>
    </tr>
    <tr>
<td>
Instansi </td> <td>  : </td> <td> <?php echo $data->nama_instansi ?> </td>
    </tr>
</table>

</div>

<div class="col-md-12" style="padding-bottom: 10px;">
<a href="<?php echo base_url() ?>penguji/pengujian/hitung/<?php echo $data->id_penilaian; ?>" class="btn btn-primary btn-2x"> Hitung PAK </a> 
</div>


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
    <th> Status Pengajuan </th>
    <th> Aksi </th>
</tr>

</thead>
<tbody> 
    <?php
        $total_acc = 0;
        $total_data = 0;
        $total_belum_acc = 0;
    foreach($dupak as $k => $v): 
        if($v->id_status == 5){
            $total_acc = $total_acc +1;
        }
        if($v->id_status == 4){
            $total_belum_acc = $total_belum_acc + 1;
        }

        $total_data = $total_data + 1;
    ?>
<tr>
    <td> <?php echo $k+1; ?> </td>
    <td><?php echo $v->nomor_spt ?> </td>
    <td><?php echo tgl_indo($v->tanggal) ?> </td>
    <td> <?php echo $v->lokasi; ?> </td>
    <td> <?php echo $v->subjek_tugas; ?> </td>
    <td> <?php echo $v->kode_kegiatan; ?> </td>
    <td> <?php echo $v->rincian; ?> </td>
    <td> <?php echo $v->angka_kredit; ?> </td>
    <td> <?php echo $v->status; ?>
        <?php if($v->id_status == 98){
            echo  "<Br /><strong> Komentar Anda : ".$v->komentar_penguji."</strong>";
        }
        ?>
</td>
    <td> 
        <?php 
        if($v->id_status == 4){ ?>
    <a href="<?php echo base_url() ?>penguji/pengujian/detaildupak/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        
    <a onclick="approve(<?php echo $v->id_dupak ?>)" href="#" class="btn btn-info"> Approve </a>        
    <a onclick="reject(<?php echo $v->id_dupak ?>)" class="btn btn-danger"> Reject </a>   
        <?php }else{  ?>
    <a href="<?php echo base_url() ?>penguji/pengujian/detaildupak/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        
<?php } ?>     
</td>
</tr>

    <?php endforeach ?>


</tbody>


</table>

<?php if($total_belum_acc == 0){ ?>
<div class="col-md-6">
    <?php if($data->status == 5 OR $data->status == 6){
            echo "<H3> Status : ".$data->status_penilaian."</H3>";
        ?>
        <a href="<?php echo base_url() ?>penguji/pengujian/cetak/<?php echo $data->nip ?>" target="_blank" class="btn btn-primary btn-2x"> Cetak PAK </a> 

            <?php 
    }
    ?>



</div>
<div class="clearfix"></div>

<?php
}else{
    // echo $total_acc;
}
?>

<script>

var nip = "<?php echo $data->nip ?>";

    function kirim(nip){
        alert(nip);
        Swal.fire({
  title: 'Kirim Ke Penguji',
  text: "Kirim Ke Penguji Pengajuan DUPAK ini ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Approve'
}).then((result) => {
  if (result.value) {

    $.ajax({
        type:"POST",
        url:base_url+"penguji/pengujian/kirim",
        data:"type=kirim&nip="+nip,
        dataType:"json",
        success:function(dt){
            Swal.fire(
      'Berhasil!',
      'Data Dupak Berhasil Di Kirim Ke Penguji',
      'success'
    )

    window.location.reload();
        }
    })


   
  }
})


    }


    function approve(id_dupak){
        Swal.fire({
  title: 'Approve SPT Ini ',
  text: "Anda yakin approve SPT ini ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Approve'
}).then((result) => {
  if (result.value) {

    $.ajax({
        type:"POST",
        url:base_url+"penguji/pengujian/approval",
        data:"type=approve&id_dupak="+id_dupak+"&nip="+nip,
        dataType:"json",
        success:function(dt){
            Swal.fire(
      'Berhasil!',
      'Data Dupak Berhasil Di Approve',
      'success'
    )

    window.location.reload();
        }
    })


   
  }
})

    }


//     function reject(id_dupak){

// Swal.fire({
// title: 'Reject SPT Ini ',
// text: "Anda yakin Reject SPT ini ?",
// icon: 'warning',
// showCancelButton: true,
// confirmButtonColor: '#3085d6',
// cancelButtonColor: '#d33',
// confirmButtonText: 'Reject'
// }).then((result) => {
//     if (result.value) {
//       var komentar = result.value;
//     $.ajax({
// type:"POST",
// url:base_url+"penguji/pengujian/approval",
// data:"type=reject&id_dupak="+id_dupak+"&komentar="+komentar,
// dataType:"json",
// success:function(dt){
//     Swal.fire(
// 'Berhasil!',
// 'Data Dupak Berhasil Di Kembalikan',
// 'success'
// )

// window.location.reload();
// }
// })



//   }
// })

// }


function reject(id_dupak){

Swal.fire({
title: 'Tolak SPT Ini ',
text: "Anda yakin Tolak SPT ini ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Reject'
}).then((result) => {
if (result.value) {

    Swal.fire({
  title: 'Masukan Alasan Penolakan',
  input: 'text',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Tolak',
  showLoaderOnConfirm: true,
  preConfirm: (login) => {
  
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.value) {
      var komentar = result.value;
    $.ajax({
type:"POST",
url:base_url+"penguji/pengujian/approval",
data:"type=reject&id_dupak="+id_dupak+"&komentar="+komentar+"&nip="+nip,
dataType:"json",
success:function(dt){
    Swal.fire(
'Berhasil!',
'Data Dupak Berhasil Di Tolak',
'success'
)

window.location.reload();
}
})



  }
})







}
})

}

</script>
