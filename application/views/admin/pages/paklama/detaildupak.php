<style type="text/css">
.form-control{

color:black;
}
    textarea.form-control {
        height: 100%;
    }
</style>
<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<div class="row">
<div class="col-md-12">
<a class="btn btn-warning pull-right" href="javascript:history.back()"> <i class="fa fa-arrow-left"></i>
<span> Kembali </span></a>

</div>
<?php echo @$this->session->flashdata('item') ?> 

<div class="col-md-6">
<h3> Detail SPT </h3>

<table class="table table-striped">
    <tr>
        <td> Nomor SPT </td> <Td> :</Td> <td> <?php echo $data->nomor_spt ?> </td>
    </tr>
    <tr>
        <td> Tanggal </td> <Td> :</Td> <td> <?php echo tgl_indo($data->tanggal) ?> </td>
    </tr>
    <tr>
        <td> Lokasi </td> <Td> :</Td> <td> <?php echo $data->lokasi ?> </td>
    </tr>
    <tr>
        <td> Subjek Tugas </td> <Td> :</Td> <td> <?php echo $data->subjek_tugas ?> </td>
    </tr>
    <tr>
        <td> Kode Kegiatan </td> <Td> :</Td> <td> <?php echo $data->kode_kegiatan ?> </td>
    </tr>
    <tr>
        <td> File SPT </td> <Td> :</Td> <td> <a onclick="preview_data('file_spt/<?php echo $data->file_spt ?>','File SPT')" class="btn btn-primary" target="_blank"> Klik untuk Preview </a> </td>
    </tr>
    <tr>
        <td> Rincian Kegiatan </td> <Td> :</Td> <td> <?php echo $data->rincian ?> </td>
    </tr>
    <tr>
        <td> Output </td> <Td> :</Td> <td> <?php echo $data->output ?> </td>
    </tr>
    <tr>
        <td> Status </td> <Td> :</Td> <td> <?php echo $data->status ?> </td>
    </tr>
    <tr>
        <td> Tahun </td> <Td> :</Td> <td> <?php echo $data->tahun ?> </td>
    </tr>
</table>

 

   
</div>
<div class="col-md-6">

<h4> File-Kegiatan </h4>
<table class="table table-striped">
<thead>
<tr>
    <th> No </th>
    <th> File </th>
    <th> Keterangan </th>
</tr>
</thead>
<tbody>
<?php foreach($file as $k => $v): ?>
<tr>
    <td> <?php echo $k+1; ?></td>
    <td> <a onclick="preview_data('files/<?php echo $v->file_upload ?>','Bukti Kegiatan')" class="btn btn-primary" target="_blank"> Klik Untuk Detail </a> </td>
    <td> 
    <?php echo $v->keterangan ?>
    </td>
</tr>

<?php endforeach ?>

</tbody>

</table>


<br />

<div class="col-md-12">
</div>

</div>





<!-- Modal -->
<div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <h5> File Akan terdownload otomatis ke PC Anda apabila tidak muncul </h5>
        <iframe src="" width="100%" height="400" id="iframedata"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
function preview_data(url,title){
    $("#myModalLabel").html('');
    $("#myModalLabel").html(title)
    $("#modal_file").modal('show');

    $("#iframedata").attr('src',base_url+url);

}

</script>