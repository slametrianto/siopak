<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIOPAK - KEMENDAGRI </title>
 <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/kemendagri_new.jpeg"> <meta name="viewport" 
content="width=device-width, initial-scale=1.0">
 <meta name="description" content="SIOPAK: Sistem basis data yang membantu Pejabat Fungsional memproses pengelolaan 
administrasi dan penilaian angka kredit media elektronik."> <meta name="description" content="">
     <meta name="author" content=""> <!-- Google / Search Engine Tags --> <meta itemprop="name" content="SIOPAK | BPSDM 
KEMENDAGRI R.I"> <!-- Le styles --> <meta itemprop="description" content="SIOPAK: Sistem basis data yang membantu Pejabat 
Fungsional memproses pengelolaan administrasi dan penilaian angka kredit media elektronik."> <meta itemprop="image" 
content="<?php echo base_url(); ?>assets/images/kemendagri_new.jpeg"> <!-- <link rel="stylesheet" 
href="assets/css/style.css"> -->
     <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/loader-style.css"> <!-- Facebook Meta Tags --> <link 
rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css"> <meta property="og:url" content="<?php echo 
base_url() ?>assets/images/kemendagri_new.jpeg"> <link rel="stylesheet" href="<?php echo base_url() 
?>assets/css/signin.css"> <meta property="og:type" content="SIOPAK | BPSDM KEMENDAGRI R.I"> <script type="text/javascript" 
src="<?php echo base_url() ?>assets/js/jquery.min.js"></script> <meta property="og:title" content="SIOPAK | BPSDM 
KEMENDAGRI R.I"> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> 
<meta property="og:description" content="SIOPAK: Sistem basis data yang membantu Pejabat Fungsional memproses pengelolaan 
administrasi dan penilaian angka kredit media elektronik."> <meta property="og:image" content="<?php echo base_url(); 
?>assets/images/kemendagri_new.jpeg"> <script 
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
   




    <!-- HTML5 shim, for IE6-8 support of HTML5 elements --> <!-- Twitter Meta Tags --> <!--[if lt IE 9]> <meta 
name="twitter:card" content="SIOPAK | BPSDM KEMENDAGRI R.I"> <script 
src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <meta name="twitter:title" content="PT.SIOPAK | BPSDM 
KEMENDAGRI R.I"> <![endif]--> <meta name="twitter:description" content="SIOPAK | BPSDM KEMENDAGRI R.I"> <!-- Fav and touch 
icons -->
<meta name="twitter:image" content="<?php echo base_url() ?>assets/images/kemendagri_new.jpeg">   
    <style>
        body {
            background: url('<?php echo base_url() ?>assets/img/mp3.jpg') no-repeat;
            background-size:cover;
        }
       label.error{
    color: red;
  }
        input {
            color:black;
            font-weight: bold;
        }
        
        @media screen and (max-width: 768px)
        {
            .h3{
            font-size: 4vw;
            }
            .h4{
            font-size: 2.1vh;
            }
        }
        @media(min-width: 768px)
        {
            .h3{
            font-size: 1.5vw;
            }
            .h4{
            font-size: 1vw;
            }
        }

        textarea { resize:none; }


    </style>
</head>

<body >
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="container">
        <div class="" id="login-wrapper">
            <div class="row">
                
                <div class="col-md-8 col-md-offset-2 img-responsive">
                    
                    <!-- <div id="logo-login" style="background: rgb(168, 10, 2); opacity: 0.9; "> -->
                    <div id="logo-login">
                    <br>
                    <img src="<?php echo base_url() ?>assets/images/logo.png" class="img-responsive" style="max-width: 90%; opacity: 0.8;"> 
                    <div>
                       <h3 class="h3"> Form Pendaftaran SIOPAK </h3>
                        <h4 class="h4">Sistem Informasi Optimalisasi Pengajuan Angka Kredit
                        </h4>
                    </div>
                    </div>
                </div>

            </div>

            <!-- <div class="row" style="opacity: 0.8;"> -->
            <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <div class="account-box">
                        <form role="form" method="POST" id="ajax_form" action="<?php echo base_url() ?>registrasi/prosesregister">
                        <div>
                            <?php echo @$this->session->flashdata('item') ?>
                        <div class="form-group">
                                <label for="nik">NIP <span style="color: red;">*</span></label>
                                <input type="text" name="nip" value="<?php echo set_value('nip') ?>" class="form-control" id="nip" required="required">
                                <span id="nip_error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK <span style="color: red;">*</span></label>
                                <input type="text" name="nik" value="<?php echo set_value('nik') ?>" class="form-control" id="nik" readonly required="required">
                                <span id="nik_error" class="text-danger"></span>
                            </div>
                            
                            <div id='informasi'></div>
                            <div id='detail_data' style="display:none;">
                            <div class="form-group <?php echo form_error('nama_lengkap') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Nama Lengkap <span style="color: red;">*</span></label>
                                <input type="text" name="nama_lengkap" value="<?php echo set_value('nama_lengkap') ?>"  class="form-control" readonly="readonly" id="nama_lengkap" required="required">
                                <span id="nama_error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tempat Lahir<span style="color: red;">*</span></label>
                                <input type="text" name="tempat_lahir" value="<?php echo set_value('tempat_lahir') ?>" class="form-control" readonly="readonly" id="tempat_lahir" required="required">
                                <!-- <span id="nama_error" class="text-danger"></span> -->
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tanggal lahir<span style="color: red;">*</span></label>
                                <input type="date" name="tanggal_lahir" value="<?php echo set_value('tanggal_lahir') ?>" class="form-control" style="line-height: 20px;" readonly="readonly"id="tanggal_lahir"  required="required">
                                <!-- <span class="help-block"></span> -->
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Alamat<span style="color: red;">*</span></label>
                                <textarea name="alamat" class="form-control" readonly="readonly" id="alamat" rows="5"><?php echo set_value('alamat') ?></textarea>
                                <!-- <span class="help-block"></span> -->
                            </div>
                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Email<span style="color: red;">*</span></label>
                                <input type="text" name="email" value="<?php echo set_value('email') ?>" class="form-control" readonly="readonly" required="required" id="email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="form-group ">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>No telepon<span style="color: red;">*</span></label>
                                <input type="text" name="no_telepon" value="<?php echo set_value('no_telepon') ?>" class="form-control" readonly="readonly" required="required" id="no_telepon">
                                <span id="no_telp_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Fungsional</label>
                                <select name="fungsional" class="form-control" onchange="get_jenjang(this.value)" required="required" readonly="readonly">
                                 <?php foreach ($data_fungsional as  $k => $val) { ?>
                                    <option value="<?php echo $val['id_tipefungsional']; ?>"> <?php echo $val['tipe_fungsional']; ?> </option>
                                    <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="jenjang">Jabatan</label>
                                <input type="text" name="id_jenjang" class="form-control" id="jenjang" readonly="readonly">
                                <span class="help-block"></span>
                            </div>

                            
                            <div class="form-group">
                                <label for="jenjang">Golongan</label>
                                <input type="text" name="id_golongan" class="form-control" id="golongan" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                            <hr>
                            <br /> <br />

                            <div class="row">
                                <div class="col-md-12 row-block">
                                <div id="msg"></div>
                                <button type="submit" id="send_form" class="btn btn-primary btn-lg">Daftar</button>
                            </div>
                            </div>
                                    </div>
                           
                        </form>
                     
                       
                        <div class="row-block">
                            <div class="row">
                                <div class="col-md-12 row-block">
                                    
                                    <br /><br />
                                    Sudah Punya Akun ? Login <a href="<?php echo base_url() ?>login"> Disini </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div style="text-align:center;margin:0 auto;">
            
        <h6 style="color:#fff;">&copy SIOPAK 2020 <br> Copyright By BPSDM Kementerian Dalam Negeri Republik Indonesia</h6></div>
    </div>



    <!--  END OF PAPER WRAP -->




    <!-- MAIN EFFECT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/preloader.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/load.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>
    <script type="text/javascript">
        var base_url = '<?php echo base_url() ?>';
        $(function(){
            if ($("#ajax_form").length > 0) {
      $("#ajax_form").validate({
    rules: {
      nip: {
        required: true,
        digits:true,
        minlength:18,
        maxlength:18
      }, 
      nik: {
        required: true,
        digits:true,
        maxlength: 16,
        minlength: 16
      },  
      email: {
        required: true,
        maxlength: 50,
        email: true,
      }, 
      message: {
        required: true,
      },   
    },
    messages: {
        
      nip: {
        required: "Masukan NIP Anda",
        minlength:"Jumlah NIP Tidak Sesuai,NIP Harus 18 Digit",
        maxlength:"Jumlah NIP Tidak Sesuai,NIP Harus 18 Digit",
        digits:"Harap Masukan Hanya Angka"
        },
        nik: {
        required: "Masukan NIK Anda",
        minlength:"Jumlah NIK Tidak Sesuai,  NIK Harus 16 Digit",
        maxlength:"Jumlah NIK Tidak Sesuai, NIK Harus 16 Digit",
        digits:"Harap Masukan Hanya Angka"
        },
      email: {
        required: "Masukan Valid Email",
        email: "Please enter valid email",
        maxlength: "The email name should less than or equal to 50 characters",
        },      
     message: {
        required: "Please enter message",
      },
         
    },
    submitHandler: function(form) {
      $('#informasi').html('Sending..');
      $('#send_form').attr('disabled',true); //set button disable 

      $.ajax({
        url: "<?php echo base_url('registrasi/prosesregisterajax') ?>",
        type: "POST",
        data: $('#ajax_form').serialize(),
        dataType: "json",
        beforeSend:function(){
            $("#msg").html("<img src='"+base_url+"assets/ajax-loader.gif'> Dalam Proses Pendaftaran");
        },
        success: function( response ) {
            $("#send_form").attr('disabled',false);
            $("#msg").html('');
            if(response.success){
                Swal.fire({
                title: 'Berhasil',
                text: "Pendaftaran User Berhasil",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if(result){
                    location.href = base_url+'login';
                }else{
                }

                })
            }

            if(response.error){
                if(response.error.email_error != ''){
                    $("#email_error").html('<label id="data-error" class="error" for="email">Email Telah Digunakan, Silahkan menggunakan Email lain</label>');
                }
            }
        }
      });
    }
  })
}


            $("#nip").on("change",function(){
                var nip = $(this).val();
                $("#nik").removeAttr('readonly');
            });
            $("#nik").on("change",function(){
                $("#informasi").html("");
                var nip = $("#nip").val();
                if(nip == ''){
                   // alert('Isi NIP Dulu woi');
                }else if(nik == ''){
                    //isi nik
                }else{
                    var nik = $("#nik").val();
                        $.ajax({
                            type:"POST",
                            data:"nip="+nip+"&nik="+nik,
                            dataType:"json",
                            url:base_url+"registrasi/cek_karyawan",
                            beforeSend:function(){
                                $("#informasi").html("<img src='"+base_url+"assets/ajax-loader.gif'>");
                            },
                            success:function(dt){

                                if(dt.status == 'FALSE'){
                                    // alert(dt.message);
                                    // if(dt.error == 1){
                                        $("#informasi").html("<div class='alert alert-danger'>"+dt.message+"</div>");
                                        $("#detail_data").hide();
                                   // }                                    
                                }else{
                                    $("#informasi").html('');
                                    $("#nip").attr('readonly');
                                    $("#nik").attr('readonly');
                                    $("#detail_data").show();


                                    $("#nama_lengkap").removeAttr('readonly');
                                    $("#nama_lengkap").val(dt.data.nama_lengkap);

                                    $("#tempat_lahir").removeAttr('readonly');
                                    $("#tempat_lahir").val(dt.data.tempat_lahir);

                                    $("#tanggal_lahir").removeAttr('readonly');
                                    $("#tanggal_lahir").val(dt.data.tanggal_lahir);

                                    $("#alamat").removeAttr('readonly');
                                    $("#alamat").val(dt.data.alamat);


                                    $("#email").removeAttr('readonly');
                                    $("#email").val(dt.data.email);


                                    $("#no_telepon").removeAttr('readonly');
                                    $("#no_telepon").val(dt.data.no_telp);

                                    $("#fungsional").removeAttr('readonly');
                                    $("#fungsional").val(dt.data.id_tipefungsional);
                                


                                    // $("#golongan").removeAttr('readonly');
                                    $("#golongan").val(dt.data.golongan+" - "+dt.data.nama_golongan);
                                    $("#jenjang").val(dt.data.nama_jenjang);
                                    
                               

                                }

                            }
                        })

                }

            });                
            });
    </script>



</body>

</html>
