

<table class="table table-striped">
<thead>
<tr>
    <th> No </th>
    <th> NIP </th>
    <th> Nama Lengkap </th>
    <th> Tanggal Pengajuan </th>
    <th> Status </th>
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
    <td> <?php echo $v->nama_lengkap ?></td>
    <td> <?php echo tgl_indo($v->tanggal_pengajuan) ?></td>
    <td> <?php echo $v->status_penilaian ?> </td>
    <td>
    <a href="<?php echo base_url() ?>backend/pengajuan/detail/<?php echo $v->nip ?>" class="btn btn-primary"> Detail </a>    
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