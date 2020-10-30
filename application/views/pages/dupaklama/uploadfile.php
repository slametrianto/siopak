<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<style>
    .content{
      width: 50%;
      padding: 5px;
      margin: 0 auto;
    }
    .content span{
      width: 250px;
    }
    .dz-message{
      text-align: center;
      font-size: 28px;
    }
    </style>
    <script>
    // Add restrictions
    Dropzone.options.fileupload = {
      maxFilesize: 2 // MB
    };
    </script>
<h4> Upload Dokumen Pendukung Kegiatan </h4>

<p> Detail Kegiatan  : <br />
Unsur : <?php echo $data->nama_unsur ?> <br />
Sub Unsur : <?php echo $data->nama_subunsur ?> <br />
Nama Kegiatan : <?php echo $data->nama_kegiatan ?> <br />
Angka Kredit : <?php echo $data->angka_kredit ?> <br />
Satuan Hasil : <?php echo $data->satuan_hasil ?> <br />
Pelaksanaan : <?php echo $data->pelaksanaan ?> <br />

<br />


<form action="<?php echo base_url() ?>dupak/uploadproses" class="dropzone" id="fileupload">
<input type="hidden" name="id_penilaian" value="<?php echo $data->id_penilaian ?>">
      </form> 

      <br />

  File Upload <br />
  <table class="table table-striped">
    <tr>
        <th> No </th> <th> File </th> <th> Aksi </th>
    </tr>
    <?php foreach($files as $k => $v): ?>
    <tr>
        <td> <?php echo $k+1; ?> </td>
        <td> <a href="<?php echo base_url() ?>files/<?php echo $v->file_upload ?>" target="_blank"> Klik Untuk Detail </a> </td>
        <td> 
            <a href="#" class="btn btn-danger"> Hapus </a>
        </td>
    </tr>

    <?php endforeach ?>
  </table>

<br />
