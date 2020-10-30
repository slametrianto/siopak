
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
table{
clear: both;
    text-align: left;
    border-collapse: collapse;
margin: 0px 0px 0px 0px;
background:#fff;
border:none;
width:100%;
    font-family: "Open Sans", Arial, sans-serif !important;
}

td{
padding: 3px 10px;
    
    font-size:11px;
    
    border-collapse: collapse;
    vertical-align: center;
    
    
    
}
</style>
</head>
<body>
<center>
<img src="./assets/img/logopancasila.png">
</center>
<table width="100%" border="0">
<tr>
<td align="center" style="font-size: 17px;" colspan="2"><strong>KEMENTERIAN DALAM NEGERI <BR/ >
REPUBLIK INDONESIA <BR />
</stong></td>
</tr>

<tr>
<td align="center" style="font-size: 17px;" colspan="2"><strong><u>PENETAPAN ANGKA KREDIT JABATAN FUNGSIONAL <?php echo strtoupper($data->tipe_fungsional) ?>
</u>
</stong></td>
</tr>
<tr>
<td align="right" width="41%" style="font-size: 15px;"><strong>NOMOR :</strong></td><td>&nbsp;</td>
</tr>
</table>
<table width="100%">
<tr>
<td style="width: 35%;">Instansi: <?php echo @$data->nama_instansi ?> </td>
<td style='width:65%;float:right'> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masa penilaian tanggal: <?php echo "01 Januari ".date('Y') ?> s.d <?php echo "31 Desember ".date('Y') ?> <td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td> I </td>
<td colspan="8" align="left"><strong>KETERANGAN PERORANGAN</strong></td>
</tr>
<tr>
<td> </td>
<td style="width: 3%;">1</td>
<td style="width: 46%;" colspan="4">Nama</td>
<!--    <td>:</td> -->
<td style="width: 58%;"  colspan="3"><?php echo $data->nama_lengkap ?>    </td>
</tr>
<tr>
<td> </td>
<td style="width: 3%;">2</td><td style="width: 46%;" colspan="4">NIP</td>
<!-- <td>:</td> -->
<td style="width: 58%;" colspan="3">
<?php echo $data->nip ?>
</td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">3</td>
<td style="width: 46%;" colspan="4">Nomor Seri KARPEG</td>
<!--    <td>:</td> -->
<td style="width: 46%;" colspan="3"><?php echo $data->nip ?></td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">4</td>
<td style="width: 46%;" colspan="4">Pangkat/Golongan Ruang/TMT </td>
<!--    <td>:</td> --><td style="width: 46%;" colspan="3"><?php echo $data->nama_golongan."/".$data->golongan."/".$data->tmt_jabatan ?></td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">5</td>
<td style="width: 46%;" colspan="4">Tempat Tanggal Lahir</td>
<!--    <td>:</td> -->
<td style="width: 46%;" colspan="3"><?php echo $data->tempat_lahir.",".tgl_indo($data->tanggal_lahir) ?></td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">6</td>
<td style="width: 46%;" colspan="4">Jenis Kelamin</td>
<!--    <td>:</td> -->
<td style="width: 46%;" colspan="3">
<?php echo jk($data->jenis_kelamin) ?>
</td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">7</td>
<td style="width: 46%;" colspan="4">Pendidikan Tertinggi </td>
<!-- <td>: </td> -->
<td style="width: 46%;" colspan="3">
<?php echo @$data->pendidikan_terakhir ?>
</td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">8</td>
<td style="width: 46%;" colspan="4"><?php echo @$data->tipe_fungsional ?>/TMT </td>
<!-- <td> : </td> -->
<td style="width: 46%;" colspan="3"><?php echo @$data->tipe_fungsional." ".@$data->nama_jenjang." / ".$data->tmt_jabatan; ?></td>
</tr>
<tr>
<td rowspan="2"></td>
<td style="width: 3%;" rowspan="2">9</td>
<td style="width: 46%;" rowspan="2" colspan="3" >Masa Kerja Golongan</td>
<td style="width: 4%;">Lama</td>
<!-- <td colspan="1">:</td> -->
<td style="width: 46%;" colspan="3"><?php echo @$data->masa_kerja_lama ?></td>
</tr>
<tr>
<td style="width: 4%;">Baru</td>
<!-- <td colspan="1">:</td> -->
<td style="width: 46%;" colspan="3">
<?php echo @$data->masa_kerja_baru ?></td>
</tr>
<tr>
<td></td>
<td style="width: 3%;">10</td>
<td style="width: 46%;" colspan="4">Unit kerja</td>
<!-- <td colspan="1">:</td> -->
<td style="width: 46%;" colspan="3"> <?php echo @$data->nama_instansi ?> </td>
</tr>
<tr>
<td>II</td>
<td colspan="5" style="width: 47%;">PENETAPAN ANGKA KREDIT</td>
<td>LAMA</td>
<td>BARU</td>
<td>JUMLAH</td>
</tr>
<?php
    $nama_utama ='';
    $nama_unsur = '';
    $total_lama_utama =0;
    $total_baru_utama = 0;
    $total_utama = 0;
    $total_lama_penunjang = 0;
    $total_baru_penunjang = 0;
    $total_penunjang = 0;
    foreach($utama as $k => $v){
        if($v->nama_utama != $nama_utama){
            $nama_utama = $v->nama_utama;
            ?>
<tr>
<td> </td>
<td> <?php echo $k+1; ?> </td>
<td colspan="4"> <strong> <?php echo $v->nama_utama ?> </strong> </td>
<td> </td>
<td> </td>
<td> </td>
</tr>

<tr>
<td> </td>
<td></td>
<td></td>
<td colspan="3"><?php echo $v->nama_unsur ?> </td>
<td><?php echo $v->ak_lama_admin ?> </td>
<td><?php echo $v->angka_kredit ?> </td>
<td> <?php echo $v->ak_lama_admin + $v->angka_kredit ?> </td>
</tr>

<?php }else{
    if($v->nama_utama = $nama_utama){
        $total_lama_utama = $total_lama_utama + $v->ak_lama_admin;
        $total_baru_utama = $total_baru_utama + $v->angka_kredit;
        $total_utama =  $total_lama_utama + $total_baru_utama;

        ?>
<tr>
<td> </td>
<td></td>
<td></td>
<td colspan="3"><?php echo $v->nama_unsur ?> </td>
<td><?php echo $v->ak_lama_admin ?> </td>
<td><?php echo $v->angka_kredit ?> </td>
<td> <?php echo $v->ak_lama_admin + $v->angka_kredit ?> </td>
</tr>

<?php
    }
    } ?>



<?php } ?>

<tr>
<td></td>
<td></td>
<td colspan="4"> <strong> Jumlah Unsur Utama </strong> </td>
<td><strong><?php echo $total_lama_utama ?></strong></td>
<td><strong><?php echo $total_baru_utama ?></strong></td>
<td><strong><?php echo $total_utama ?></strong></td>
</tr>


<?php
    $nama_utama ='';
    $nama_unsur = '';
    $total_lama_utama = $total_lama_utama + $v->ak_lama_admin;
        $total_baru_utama = $total_baru_utama + $v->angka_kredit;
        $total_utama =  $total_lama_utama + $total_baru_utama;
        $total_lama_penunjang = $total_lama_penunjang + $v->ak_lama_admin;
        $total_baru_penunjang = $total_baru_penunjang + $v->angka_kredit;
        $total_penunjang =  $total_lama_penunjang + $total_baru_penunjang;



        $total_lama_utama_dan_penunjang = $total_lama_utama;
        $total_baru_utama_dan_penunjang = $total_baru_utama ;
        $total_utama_dan_penunjang =  $total_lama_utama_dan_penunjang + $total_baru_utama_dan_penunjang;
    foreach($penunjang as $k => $v){
        if($v->nama_utama != $nama_utama){
            $nama_utama = $v->nama_utama;
            ?>
<tr>
<td> </td>
<td>2 </td>
<td colspan="4"> <strong> <?php echo $v->nama_utama ?> </strong> </td>
<td> </td>
<td> </td>
<td> </td>
</tr>

<tr>
<td> </td>
<td></td>
<td></td>
<td colspan="3"><?php echo $v->nama_unsur ?> </td>
<td><?php echo $v->ak_lama_admin ?> </td>
<td><?php echo $v->angka_kredit ?> </td>
<td> <?php echo $v->ak_lama_admin + $v->angka_kredit ?> </td>
</tr>


<?php }else{
    if($v->nama_utama = $nama_utama){
        
  
        ?>
<tr>
<td> </td>
<td></td>
<td></td>
<td colspan="3"><?php echo $v->nama_unsur ?> </td>
<td><?php echo $v->ak_lama_admin ?> </td>
<td><?php echo $v->angka_kredit ?> </td>
<td> <?php echo $v->ak_lama_admin + $v->angka_kredit ?> </td>
</tr>

<?php
    }
    } ?>



<?php } ?>

<tr>
<td></td>
<td></td>
<td colspan="4"> <strong> Jumlah Unsur Penunjang </strong> </td>
<td><strong><?php echo $total_lama_penunjang ?></strong></td>
<td><strong><?php echo $total_baru_penunjang ?></strong></td>
<td><strong><?php echo $total_penunjang ?></strong></td>
</tr>


<tr>
<td> </td>
<Td colspan="5"> <strong> Jumlah Unsur Utama dan Unsur Penunjang  </td>
<td> <strong><?php echo $total_lama_utama_dan_penunjang ?></strong></td>
<td> <strong><?php echo $total_baru_utama_dan_penunjang ?></strong></td>
<td> <strong><?php echo $total_utama_dan_penunjang ?></strong></td>
</tr>

<tr>
<td>  III </td>
<td colspan="8">
<?php 
foreach($status_layak as $data){
if($data["layak"] == 1){
    echo '<strong>Layak</strong>';
}    elseif($data["layak"] == 2){
     echo "<strong>Belum Layak</strong>";
}   else{
     echo "Layak/Belum Layak";
}
}
    ?> dipertimbangkan untuk dinaikkan dalam pangkat <strong><?php foreach($footer as $footer){
    if($footer->id_golongan == 1){
        echo "III.c";
    }elseif($footer->id_golongan == 2){
         echo "III.d";
    }elseif($footer->id_golongan == 3){
         echo "IV.a";
    }elseif($footer->id_golongan == 4){
         echo "IV.b";
    }elseif($footer->id_golongan == 5){
         echo "IV.c";
    }elseif($footer->id_golongan == 6){
         echo "IV.d";
    }elseif($footer->id_golongan == 8){
         echo "IV.e";
    }elseif($footer->id_golongan == 9){
         echo "IV.e";
    }
    }
    ?> </strong></td>
</tr>




</table>
<table width="100">
<tr>
<td> <strong> <u> ASLI </u> </strong>  dengan hormat kepada, <Br />
Kepala BKN Up. Deputi Bidang Informasi Kepegawaian BKN
</td>
<td> Ditetapkan di Jakarta <br />
Pada Tanggal : <?php echo tgl_indo(date('Y-m-d')) ?> </td>
</tr>
</table>

<br />
<table>
<tr>
<td>
Tembusan :  <br />
1. Pengawas Pemerintahan yang bersangkutan; <br />
2. Pimpinan unit kerja yang bersangkutan;<br />
3. Sekretaris Tim Penilai yang bersangkutan;<br />
4. Pejabat yang berwenang menetapkan angka kredit<br />

</td>
<td>
<table style="font-size:11px;">
<tr>
<td colspan="2">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
A.n Menteri Dalam Negeri </td>
</tr>
<tr>
<td> </td>
<td> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pejabat->jabatan ?>
<br /><br /><br /><br /> <br /><br /> <br /><br /> <br /><br /> <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u><?php echo $pejabat->nama_pejabat ?></u> </strong>
<br />
<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pejabat->pangkat ?> </strong>
<br />

</TD>
</TR>
<tr>
<td> </td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. <?php echo $pejabat->nip_pejabat ?> </td>
</tr>
</table>
</div>

</div>


<br><br><br><br>



</body>
</html>
