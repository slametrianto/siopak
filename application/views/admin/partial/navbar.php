    <?php if($this->session->userdata('is_admin') != 1 ){
                             redirect('backend/login');
                        // echo "<script>
                        // alert('Akses ditolak, anda belum login');
                        // exit();
                        // </script>";
                          } ?>
    <nav role="navigation" class="navbar navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              



                <div id="logo-mobile" class="visible-xs">
                    <h1>Siopak
                        <span>Kemendagri</span>
                    </h1>
                </div>

            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <!-- <li class="dropdown">

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i style="font-size:20px;" class="icon-conversation"></i><div class="noft-red">23</div></a>


                        <ul style="margin: 11px 0 0 9px;" role="menu" class="dropdown-menu dropdown-wrap">
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/men/1.jpg">Jhon Doe <b>Just Now</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/women/1.jpg">Jeniffer <b>3 Min Ago</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/men/2.jpg">Dave <b>2 Hours Ago</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/men/3.jpg"><i>Keanu</i>  <b>1 Day Ago</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/men/4.jpg"><i>Masashi</i>  <b>2 Mounth Ago</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div>See All Messege</div>
                            </li>
                        </ul>
                    </li>
                    <li>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i style="font-size:19px;" class="icon-warning tooltitle"></i><div class="noft-green">5</div></a>
                        <ul style="margin: 12px 0 0 0;" role="menu" class="dropdown-menu dropdown-wrap">
                            <li>
                                <a href="#">
                                    <span style="background:#DF2135" class="noft-icon maki-bus"></span><i>From Station</i>  <b>01B</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <span style="background:#AB6DB0" class="noft-icon maki-ferry"></span><i>Departing at</i>  <b>9:00 AM</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <span style="background:#FFA200" class="noft-icon maki-aboveground-rail"></span><i>Delay for</i>  <b>09 Min</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <span style="background:#86C440" class="noft-icon maki-airport"></span><i>Take of</i>  <b>08:30 AM</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <span style="background:#0DB8DF" class="noft-icon maki-bicycle"></span><i>Take of</i>  <b>08:30 AM</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div>See All Notification</div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i data-toggle="tooltip" data-placement="bottom" title="Help" style="font-size:20px;" class="icon-help tooltitle"></i></a>
                    </li> -->

                </ul>
                <!-- <div id="nt-title-container" class="navbar-left running-text visible-lg">
                    <ul class="date-top">
                        <li class="entypo-calendar" style="margin-right:5px"></li>
                        <li id="Date"></li>


                    </ul>

                    <ul id="digital-clock" class="digital">
                        <li class="entypo-clock" style="margin-right:5px"></li>
                        <li class="hour"></li>
                        <li>:</li>
                        <li class="min"></li>
                        <li>:</li>
                        <li class="sec"></li>
                        <li class="meridiem"></li>
                    </ul>
                    <ul id="nt-title">
                        <li><i class="wi-day-lightning"></i>&#160;&#160;Berlin&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 15km/h
                        </li>
                        <li><i class="wi-day-lightning"></i>&#160;&#160;Yogyakarta&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; Tonight- 72 °F (22.2 °C)
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Sttugart&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 15km/h
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Muchen&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 15km/h
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Frankurt&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 15km/h
                        </li>

                    </ul>
                </div> -->
                   <ul style="margin-right:0;" class="nav navbar-nav navbar-right">
                   


                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php 
                            $photo = $this->session->userdata('photo');
                            if($photo == ''){
                                $photo = base_url().'assets/img/images.png';
                            }else{
                                $photo = base_url().'assets/foto_user/'.$photo;
                            }
                            ?>
                            <img alt="" class="admin-pic img-circle" src="<?php echo $photo ?>">

                          <!-- admin  <?php echo $this->session->userdata('is_admin'); ?>
                            penguji <?php echo $this->session->userdata('is_penguji'); ?>
                            dupak  <?php echo $this->session->userdata('is_dupak'); ?>  -->
                            <?php echo $this->session->userdata('nama_lengkap') ?> <b class="caret"></b>
                        </a>
                        <ul style="margin-top:14px;" role="menu" class="dropdown-setting dropdown-menu">
                          
                             <li><a href="<?php echo base_url('backend/login/logout'); ?>" onClick="return confirm('Apakah anda ingin keluar dari aplikasi ?');"><i class="fa fa-key"></i>&nbsp;&nbsp;Log Out</a></li>
                        </ul>
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
