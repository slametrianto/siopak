<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIOPAK - KEMENDAGRI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>

   <!--  <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/loader-style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/signin.css">






    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/ico/minus.png">
    <style>
        body {
            background: url('<?php echo base_url() ?>assets/img/mp3.jpg') no-repeat;
            background-size:cover;
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
                    
                    <div id="logo-login" style="background: rgb(168, 10, 2); opacity: 0.6; ">
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

            <div class="row" style="opacity: 0.8;">
                <div class="col-md-8 col-md-offset-2">
                    <div class="account-box">
                        <form role="form" method="POST" action="<?php echo base_url('registrasi/add')?>">
                        <div class="form-group <?php echo form_error('nip') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="nik">NIP <span style="color: red;">*</span></label>
                                <input type="text" name="nip" value="<?php echo set_value('nip') ?>" class="form-control">
                                <span style="color: red;"><?php echo form_error('nip'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('nik') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="nik">NIK <span style="color: red;">*</span></label>
                                <input type="text" name="nik" value="<?php echo set_value('nik') ?>" class="form-control">
                                <span style="color: red;"><?php echo form_error('nik'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('nama_lengkap') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Nama Lengkap <span style="color: red;"><strong>*</span></label>
                                <input type="text" name="nama_lengkap" value="<?php echo set_value('nama_lengkap') ?>"  class="form-control" disabled readonly="readonly">
                                 <span style="color: red;"><?php echo form_error('nama_lengkap'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('tempat_lahir') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tempat Lahir<span style="color: red;">*</span></label>
                                <input type="text" name="tempat_lahir" value="<?php echo set_value('tempat_lahir') ?>" class="form-control" readonly="readonly">
                                <span style="color: red;"><?php echo form_error('tempat_lahir'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('tanggal_lahir') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Tanggal lahir<span style="color: red;">*</span></label>
                                <input type="date" name="tanggal_lahir" value="<?php echo set_value('tanggal_lahir') ?>" class="form-control" style="line-height: 20px;" readonly="readonly">
                                <span style="color: red;"><?php echo form_error('tanggal_lahir'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('alamat') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Alamat<span style="color: red;">*</span></label>
                                <textarea name="alamat" class="form-control"><?php echo set_value('alamat') ?></textarea>
                                 <span style="color: red;"><?php echo form_error('alamat'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('email') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Email<span style="color: red;">*</span></label>
                                <input type="text" name="email" value="<?php echo set_value('email') ?>" class="form-control" readonly="readonly">
                                 <span style="color: red;"><?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group <?php echo form_error('no_telepon') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>No telepon<span style="color: red;">*</span></label>
                                <input type="text" name="no_telepon" value="<?php echo set_value('no_telepon') ?>" class="form-control" readonly="readonly">
                                <span style="color: red;"><?php echo form_error('no_telepon'); ?></span>
                            </div>

                            <div class="form-group <?php echo form_error('fungsional') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label>Fungsional<span style="color: red;">*</span></label>
                                <select name="fungsional" id="fungsional" class="form-control" readonly="readonly">
                               
                                 <?php foreach ($data_fungsional as $data_fungsional) { ?>
                                    <option value="<?php echo $data_fungsional['id_tipefungsional']; ?>" <?php echo set_value('fungsional') == $data_fungsional['id_tipefungsional'] ? "selected" : null ?>><?php echo $data_fungsional['tipe_fungsional']; ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red;"><?php echo form_error('fungsional'); ?></span>
                                
                            </div>

                            <div class="form-group <?php echo form_error('golongan') ? 'has-error' : null; ?>">
                                <!-- <a href="#" class="pull-right label-forgot">Forgot email?</a> -->
                                <label for="golongan">Golongan<span style="color: red;">*</span></label>
                                <select name="golongan" id="gol" class="form-control" readonly="readonly">
                                   
                                    <?php foreach ($data_golongan as $row) { ?>
                                    <option value="<?php echo set_value('golongan')?>" <?php echo set_value('golongan') == $row['id_golongan'] ? "selected" : null ?>> <?php echo $row['golongan'].' - '.$row['pangkat']; ?></option>
                                <?php } ?>
                                   
                                </select>
                                <span style="color: red;"><?php echo form_error('golongan'); ?></span>
                                
                            </div>

                            <hr>
                            <br /> <br />

                            <div class="row">
                                <div class="col-md-12 row-block">
                                    <input type="submit" class="btn btn btn-primary pull-right" value="Simpan">
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
            <h6 style="color:#fff;">Copyright &copy 2020 BPSDM Kemendagri</h6>
        </div>

    </div>
    <div id="test1" class="gmap3"></div>



    <!--  END OF PAPER WRAP -->




    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/preloader.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/load.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/map/gmap3.js"></script>

    <script type="text/javascript">
        $(function(){
            
                $.ajaxSetup({
                    url : "<?php echo site_url('registrasi/get_golongan'); ?>",
                    type : "POST",
                    cache : false,
                    
                });

                $("#fungsional").change(function(){
                    var value = $(this).val();
                    if (value > 0) {
                        $.ajax({
                            data: {modul: 'golongan', id:value},
                            success: function(respon){
                                $("#gol").html(respon);
                            }

                        });
                    }
                });
                
            });
       
    </script>

   <!-- <script type="text/javascript">
        $(document).ready(function(){
            $('#nip_user').blur(function(){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('regristrasi/add'); ?>",
                    data: $(this).serialize(),
                    success: function(data){
                        if (data=="ok") {
                            $('#nip_result').html('<font color="red">tidak tersedia</font>');
                        }
                    }
                });
            });
        });
    </script> -->
    <script type="text/javascript">

        function ceknik(){
        var x = document.getElementById("inputnik");
alert('nik : '+x);1113093000079
        }


    // $(function() {

    //     $("#test1").gmap3({
    //         marker: {
    //             latLng: [-7.782893, 110.402645],
    //             options: {
    //                 draggable: true
    //             },
    //             events: {
    //                 dragend: function(marker) {
    //                     $(this).gmap3({
    //                         getaddress: {
    //                             latLng: marker.getPosition(),
    //                             callback: function(results) {
    //                                 var map = $(this).gmap3("get"),
    //                                     infowindow = $(this).gmap3({
    //                                         get: "infowindow"
    //                                     }),
    //                                     content = results && results[1] ? results && results[1].formatted_address : "no address";
    //                                 if (infowindow) {
    //                                     infowindow.open(map, marker);
    //                                     infowindow.setContent(content);
    //                                 } else {
    //                                     $(this).gmap3({
    //                                         infowindow: {
    //                                             anchor: marker,
    //                                             options: {
    //                                                 content: content
    //                                             }
    //                                         }
    //                                     });
    //                                 }
    //                             }
    //                         }
    //                     });
    //                 }
    //             }
    //         },
    //         map: {
    //             options: {
    //                 zoom: 15
    //             }
    //         }
    //     });

    // });
    </script>




</body>

</html>
