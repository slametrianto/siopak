<style type="text/css">
.form-control{

color:black;
}
    textarea.form-control {
        height: 100%;
    }
</style>
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

<div class="row">
<div class="col-md-12">
<a class="btn btn-warning pull-right" href="javascript:history.back()"> <i class="fa fa-arrow-left"></i>
<span> Kembali </span></a>

</div>
<?php echo @$this->session->flashdata('item') ?> 
    <form role="form" method="POST" action="<?php echo base_url() ?>dupaklama/proses" enctype="multipart/form-data">
<div class="col-md-6">

    <div class="form-group">
        <label> Nomor SPT </label>
        <input type="text" name="nomor_spt" class="form-control" required="required" value="<?php echo set_value('nomor_spt'); ?>">
    </div>

    <div class="form-group">
        <label> Tanggal SPT </label>
       <input type="date" name="tanggal_spt" class="form-control" required="required">
    </div>



    <div class="form-group">
        <label> Tahun </label>
       <input type="text" name="tahun" class="form-control" required="required">
    </div>


    <div class="form-group">
        <label> KODE KEGIATAN </label>
        <input type="text" name="kode_kegiatan" class="form-control" id="kode_kegiatan" value="" style='width:80%' readonly>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Pilih Kegiatan
</button>
    </div>

    <div class="form-group" id="only-number">
        <label> Lokasi </label>
        <input type="text" name="lokasi" id="lokasi" value="" class="form-control" required="required"> 
    </div>

    <div class="form-group">
        <label> Subjek </label>
        <input type="text" name="subjek" id="" value="" class="form-control" required="required"> 
    </div>

    

    <div class="form-group">
        <label> Upload File SPT </label>
        <input type="file" name="file_spt" class="form-control" required="required">
    </div>

 

   
</div>
<div class="col-md-6">
<div class="form-group">
        <label> Kode Kegiatan </label>
        <input type="text" name="kode_kegiatan" id="subjek" value="" class="form-control" required="required" disabled> 
    </div>

<div class="form-group">
        <label> Rincian Kegiatan </label>
        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="" class="form-control" required="required"> 
    </div>


<div class="form-group">
        <label> Hasil/Output </label>
        <input type="text" name="satuan_hasil" id="satuan_hasil" value="" class="form-control" required="required"> 
    </div>

    <div class="form-group">
        <label> Tanggal Mulai  </label>
       <input type="date" name="tanggal_mulai" class="form-control" required="required">
    </div>


    <div class="form-group">
        <label> Tanggal Selesai </label>
       <input type="date" name="tanggal_selesai" class="form-control" required="required">
    </div>

    <div class="form-group">
        <label> Jumlah Hasil/Output  </label>
        <input type="text" name="bobot_kredit" id="bobot_kredit" value="0" class="form-control" required="required"> 
    </div>

<div class="form-group">
        <label> Angka Kredit </label>
        <input type="text" name="angka_kredit" id="angka_kredit" value="" class="form-control" required="required" readonly> 
    </div>

    <div class="form-group">
        <label> File Kegiatan </label>
        <a class="btn btn-primary add-row" id="add_row"> Tambah </a>
        <button type="button" class="btn btn-danger delete-row">Delete Row</button>

        <table class="table table-striped" id="tabelupload">
            <thead>
                <tr>
                    <th>  </th>
                    <th> File </th>
                    <th> Keterangan </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


</div>
<br />

<div class="col-md-12">


        <button type="submit" class="btn btn-primary btn-2x pull-left"> Simpan </button>
        </form>

</div>

</div>



<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document"  style="overflow-x:auto;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Daftar Kegiatan </h4>
      </div>
      <div style="overflow-y:auto;height:600px" class="modal-body">
        <table class="table table-striped table-responsive" id="myTable">
                <thead>
                <tr>
                    <th> No </th>
                    <th> Tipe Unsur </th>
                    <th> Unsur </th>
                    <th> Sub Unsur </th>
                    <th> Kode Kegiatan </th>
                    <th> Kegiatan </th>
                    <th> Satuan Hasil </th>
                    <th> Angka Kredit </th>
                    <th> Aksi </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($kegiatan as $k => $v): ?>
                        <?php if($v->angka_kredit == 0){ ?>
                            <tr>

                            <td> <?php echo $k+1; ?> </td>
                        <td></td>
                        <td><?php echo $v->nama_kegiatan ?> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                            </tr>
                        <?php }else{ ?>
                            <tr>
                            <td> <?php echo $k+1; ?> </td>
                            <td> <?php echo $v->nama_utama ?> </td>
                            <td> <?php echo $v->nama_unsur ?> </td>
                            <td> <?php echo $v->nama_subunsur ?> </td>
                            <td> <?php echo $v->kode_kegiatan ?> </td>
                            <td> <?php echo @$v->kegiatan ?> </td>
                            <td> <?php echo $v->satuan_hasil ?> </td>
                            <td> <?php echo $v->angka_kredit ?> </td>
                            <td> <a href="#" class="btn btn-primary" onclick="pilih(<?php echo $v->id_kegiatan ?>)"> Pilih </a> </td>
                            </tr>
                            <?php } ?>

                <?php endforeach ?>

                </tbody>
        
        </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script>
    function pilih(a){
        $("#kode_kegiatan").val(a);
        $.ajax({
            type:"POST",
            data:"id_kegiatan="+a,
			dataType:'json',
            url:base_url+"dupak/detailkegiatan",
            success:function(dt){
                console.log(dt.id_kegiatan);
                $("#angka_kredit").val(dt.angka_kredit);
                $("#satuan_hasil").val(dt.satuan_hasil);
                $("#kode_kegiatan").val(dt.kode_kegiatan);
                $("#subjek").val(dt.kode_kegiatan);
                $("#nama_kegiatan").val(dt.kegiatan);
            }
        })


        $("#myModal").modal('hide');
    }

    $(function() {

        $(".add-row").click(function(){
            var name = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='file' name='file_kegiatan[]'></td><td><input type='text' name='keterangan[]' class='form-control'></td></tr>";
            $("#tabelupload tbody").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });


        $('#myTable').DataTable();

      $('#only-number').on('keydown', '#angka_kredit', function(e){
          -1!==$
          .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
          .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
          || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
          && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
      });
      

      
    })
    $('.js-source-states').select2();

    function pilihunsur(a){
        // alert(a);
        $.ajax({
            type:"POST",
            data:"id_unsur="+a,
            url:base_url+"dupak/getsubunsur",
            success:function(dt){
                $("#sub_unsur").html(dt);
            }
        })
    
    }


    function pilihsubunsur(a){
        // alert(a);
        $.ajax({
            type:"POST",
            data:"id_subunsur="+a,
            url:base_url+"dupak/getkegiatan",
            success:function(dt){
                $("#kegiatan").html(dt);
            }
        })
    
    }



</script>