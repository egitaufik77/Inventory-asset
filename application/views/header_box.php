<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christian Rosandhy">

    <title><?php echo isset($title) ? $title." - " : ""; echo get_setting("webname")?> Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.fancybox.css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <?=cms_register("header")?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <style>
.fancybox-content {
    background: #fff;
    border-radius: 8px;
    padding: 15px;
    overflow-y: auto !important;
}
.fancybox-slide--html {
    padding: 10px !important;
}
table.data {
    width: 100% !important;
    table-layout: auto;
}
</style>

<!-- Tambahkan library DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
.fancybox-content {
  width: 90% !important;
  height: 90% !important;
  overflow-y: auto !important;
  background: #fff;
  padding: 15px;
  border-radius: 8px;
}
.fancybox-slide--html {
  padding: 10px !important;
}
.dataTables_wrapper {
  margin-top: 15px;
}
</style>


</head>

<body>

    <div id="wrappers">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?=get_setting("webname")?></a>
            </div>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?=$title?>
                        </h1>
                        <div class="divider"></div>