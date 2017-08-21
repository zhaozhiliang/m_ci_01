<!DOCTYPE html>
<html lang="en">
<head>
<title>后台管理系统</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--style CSS-->
<link rel="stylesheet" href="<?php echo base_url();?>static/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>static/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>static/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url();?>static/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url();?>static/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>static/css/matrix-media.css" />
<link href="<?php echo base_url();?>static/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!--javascript-->
<script src="<?php echo base_url();?>static/js/jquery.min.js"></script> 
<script src="<?php echo base_url();?>static/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url();?>static/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>static/js/jquery.uniform.js"></script>
<script src="<?php echo base_url();?>static/js/matrix.validator.js"></script>
<script src="<?php echo base_url();?>static/js/select2.min.js"></script> 
<script src="<?php echo base_url();?>static/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>static/js/matrix.js"></script> 
<script src="<?php echo base_url();?>static/js/matrix.tables.js"></script>
</head>
<body>
<!--Header-part-->
<div id="header">
  <h1></h1>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li><a title="<?php echo $this->session->userdata('admin_name');?>" href="javascript:;"><i class="icon icon-user"></i>  <span class="text"><?php echo $this->session->userdata('admin_name');?></span></a>
    </li>
    <li><a title="退出" href="/welcome/logout"><i class="icon icon-signout"></i> <span class="text">退出</span></a></li>
  </ul>
</div>