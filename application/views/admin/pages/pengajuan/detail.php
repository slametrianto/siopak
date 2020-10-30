
<div class="col-md-12">
<a class="btn btn-warning pull-right" href="javascript:history.back()"> <i class="fa fa-arrow-left"></i>
<span> Kembali </span></a>

</div>

<p> NIP  : <?php echo $data->nip ?><br />
Nama Karyawan : <?php echo $data->nama_lengkap ?> <br />
Tanggal Pengajuan : <?php echo tgl_indo($data->tanggal_pengajuan) ?> <br />
<!-- <a class="btn btn-primary"> Kirim ke Penguji </a> -->

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
    <th> <center>Aksi </center></th>
</tr>

</thead>
<tbody> 
    <?php
        $total_acc = 0;
        $total_data = 0;
    foreach($dupak as $k => $v): 
        if($v->id_status == 3){
            $total_acc = $total_acc +1;
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
        <?php if($v->id_status == 99){
            echo  "<Br />Komentar Anda : ".$v->komentar;
        }
        ?>
</td>
    <td> 
      <center>
        <?php 
        if($v->id_status == 2){ ?>
    <a href="<?php echo base_url() ?>backend/pengajuan/detaildupak/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        
    <a onclick="approve(<?php echo $v->id_dupak ?>)" href="#" class="btn btn-info"> Approve </a>        
    <a onclick="reject(<?php echo $v->id_dupak ?>)" class="btn btn-danger"> Reject </a>   
        <?php }else{  ?>
            <a href="<?php echo base_url() ?>backend/pengajuan/detaildupak/<?php echo $v->id_dupak ?>" class="btn btn-success"> Detail </a>        


<?php        } ?>    
</center> 
</td>
</tr>

    <?php endforeach ?>


</tbody>


</table>

<?php if($total_acc == $total_data){ ?>

    <a href="#" onclick="kirim('<?php echo $data->nip ?>')" class="btn btn-primary btn-2x"> Kirim ke Penguji </a>

<?php
}else{
    // echo $total_acc;
}
?>

<script>
    function kirim(nip){
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
        url:base_url+"backend/pengajuan/kirim",
        data:"type=kirim&nip="+nip,
        dataType:"json",
        success:function(dt){
           console.log(dt);
            if(dt.status == 'FALSE'){
                Swal.fire(
      'GAGAL!',
      dt.message,
      'warning'
    )
            }else{
            Swal.fire(
      'Berhasil!',
      'Data Dupak Berhasil Di Kirim Ke Penguji',
      'success'
    )

    window.location.reload();
        }
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
        url:base_url+"backend/pengajuan/approval",
        data:"type=approve&id_dupak="+id_dupak,
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


    function reject(id_dupak){

Swal.fire({
title: 'Kembalikan SPT Ini ',
text: "Anda yakin Kembalikan SPT ini ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Reject'
}).then((result) => {
if (result.value) {

    Swal.fire({
  title: 'Masukan Alasan Pengembalian',
  input: 'text',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Proses',
  showLoaderOnConfirm: true,
  preConfirm: (login) => {
  
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.value) {
      var komentar = result.value;
    $.ajax({
type:"POST",
url:base_url+"backend/pengajuan/approval",
data:"type=reject&id_dupak="+id_dupak+"&komentar="+komentar,
dataType:"json",
success:function(dt){
    Swal.fire(
'Berhasil!',
'Data Dupak Berhasil Di Kembalikan',
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
