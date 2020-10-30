<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Apricot v1.2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <style type="text/css">
    body {
        overflow:hidden!important;
        padding-top: 120px;
    }
    </style>
    <!-- Le styles -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/loader-style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/signin.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/extra-pages.css">






    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/ico/minus.png">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>


    <div class="logo-error"><br />
       <img src="<?php echo base_url() ?>assets/images/logo.png">
    </div>

    <!-- Main content -->
    <section class="page-error">

        <div class="error-page">
            <h2 class="headline text-info">404</h2>
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                <p>
                    We could not find the page you were looking for. Meanwhile, you may <a class="error-link" href='index.html'>return to dashboard</a> or try using the search form.
                </p>
                <a class="btn btn-primary btn-lg" href="#" onclick="goBack()"> Kembali </a>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->

    </section>








    <!--  END OF PAPER WRAP -->




    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/preloader.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/load.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>

    <script>
function goBack() {
  window.history.back();
}
</script>
</body>

</html>