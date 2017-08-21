<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Loader = & load_class('Loader', 'core');
$Loader->view('include/header.php');
?>
<!--sidebar-menu-->
<div id="sidebar">
  <ul>
    <li class="active"><a href="javascript:;"><i class="icon icon-home"></i> <span>页面没找到</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;" class="current">Error 404</a> </div>
    <h1>Error 404</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Error 404</h5>
          </div>
          <div class="widget-content">
            <div class="error_ex">
              <h1>404</h1>
              <h3>亲！！没找到你要访问的页面。</h3>
              <p>请您正常访问，请勿违规操作，谢谢合作！</p>
              <a class="btn btn-warning btn-big"  href="javascript:history.go(-1);">返回上一页</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$Loader->view('include/footer.php');
?>