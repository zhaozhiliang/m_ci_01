<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="/role">角色管理</a> <a href="javascript:;">编辑角色</a></div>
    <h1>编辑角色</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
            <h5>角色信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="/role/do_edit" name="roleEditForm" id="roleEditForm" onSubmit="return Validator.Validate(this, 3)">
            <input type="hidden" name="id" value="<?php echo $info['id'];?>">
              <div class="control-group">
                <label class="control-label">角色名称</label>
                <div class="controls">
                  <input type="text" name="name" value="<?php echo $info['name'];?>" dataType="Require" msg=" 角色名称不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">是否超级管理员</label>
                <div class="controls">
                  <label>
                    <input type="radio" name="is_super" value="1"<?php if($info['is_super'] == 1):?> checked="checked"<?php endif;?> />是
                  </label>
                  <label>
                    <input type="radio" name="is_super" value="0"<?php if($info['is_super'] <> 1):?> checked="checked"<?php endif;?> />否
                  </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">角色描述</label>
                <div class="controls">
                  <textarea rows="6" class="span8" name="description" placeholder="关于角色的简单描述。" dataType="Require" msg=" 角色描述不能为空！"><?php echo $info['description'];?></textarea>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">保存</button> <button class="btn" onclick="window.location.href='/role/add'">取消</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
  $("#roleEditForm").ajaxForm(options);
});
</script>
<?php $this->load->view('include/footer.php');?>