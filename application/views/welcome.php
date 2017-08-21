<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">欢迎页</a></div>
    <h1></h1>
  </div>
  <div class="container-fluid">
    <hr>

      <div>Welcome!</div>

  </div>
</div>
<script src="<?php echo base_url();?>static/js/jquery.form.js"></script>
<script type="text/javascript">
$(function () {
  var options = {
    dataType : "json",
    success: function (jsonData) {
      alert(jsonData.callbackMsg);
      if(jsonData.callbackCode == 1){
        location.href = '/role';
      }
    }
  };
  $("#roleAddForm").ajaxForm(options);
});
</script>
<?php $this->load->view('include/footer.php');?>