<?php $this->load->view('partial/head') ?>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <?php $this->load->view('penguji/partial/navbar'); ?>

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <div id="skin-select">
        <div id="logo">
            <h1>SIOPAK
                <span>KEMENDAGRI</span>
            </h1>
        </div>

        <a id="toggle">
            <span class="entypo-menu"></span>
        </a>
        <div class="dark">
            <form action="#">
                <span>
                    <input type="text" name="search" value="" class="search rounded id_search" placeholder="Search Menu..." autofocus />
                </span>
            </form>
        </div>

        <div class="search-hover">
            <form id="demo-2">
                <input type="search" placeholder="Search Menu..." class="id_search">
            </form>
        </div>


        <div class="search-hover">
            <form id="demo-2">
                <input type="search" placeholder="Search Menu..." class="id_search">
            </form>
        </div>




        <?php $this->load->view('penguji/partial/sidebar'); ?>
    </div>
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">





            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <i class="icon-media-record"></i> 
                            <span>Penguji
                            </span>
                        </h2>

                    </div>

                    <div class="col-sm-7">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="tittle-middle-header">

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span class="tittle-alert entypo-info-circled"></span>
                                Welcome back,&nbsp;
                                <strong><?php echo $_SESSION['nama_lengkap'] ?></strong>&nbsp;&nbsp;Your last sig in at  <?php echo $_SESSION['last_login'] ?>
                            </div>



                        </div>

                    </div>
                  
                </div>
            </div>
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <!-- <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Extra Pages</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Blank Page</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul> -->

            <!-- END OF BREADCRUMB -->

            <div class="content-wrap">
                <div class="row">


                    <div class="col-sm-12">
                        <!-- BLANK PAGE-->

                        <div class="nest" id="Blank_PageClose">
                            <div class="title-alt">
                                <h6> <?php echo @$title ?></h6>
                                <div class="titleClose">
                                    <a class="gone" href="#Blank_PageClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Blank_Page_Content">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="Blank_Page_Content">

                                    <?php
                                    if(@$template){
                                        $this->load->view(@$template);
                                    }
                                    ?>

                            </div>
                        </div>
                    </div>
                    <!-- END OF BLANK PAGE -->


                </div>



                <!-- /END OF CONTENT -->



                <!-- FOOTER -->
                <div class="footer-space"></div>
                <div id="footer">
                    <div class="devider-footer-left"></div>
                    <div class="time">
                        <p id="spanDate"></p>
                        <p id="clock"></p>
                    </div>
                    <div class="copyright">Copyright &copy; 2020 <a href="http://gamatechno.com">BPSDM Kementerian Dalam Negeri </a> All Rights Reserved</div>
                    <div class="devider-footer"></div>

                </div>
                <!-- / END OF FOOTER -->


            </div>
        </div>
        <!--  END OF PAPER WRAP -->

        <!-- END OF RIGHT SLIDER CONTENT-->


        <!-- MAIN EFFECT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/preloader.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/load.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>


</body>

</html>
