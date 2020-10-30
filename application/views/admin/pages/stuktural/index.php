<?php echo $this->session->flashdata('message') ?>
<a class="btn btn-primary pull-left" href="<?php echo base_url() ?>backend/struktural/add"> Tambah Data </a>

<table class="table table-striped">
<thead>
<tr>
    <th> No </th>
    <th> Struktural/Fungsional </th>
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
    <td> <?php echo $v->tipe_fungsional ?></td>
    <td>
    <a href="<?php echo base_url() ?>backend/struktural/edit/<?php echo $v->id_tipefungsional ?>" class="btn btn-success"> Edit </a>    
    <a href="<?php echo base_url() ?>backend/struktural/delete/<?php echo $v->id_tipefungsional ?>" class="btn btn-danger"> Hapus </a>    
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