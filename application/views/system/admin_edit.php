<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="javascript:;">系统设置</a> <a href="/admin">系统管理员</a> <a href="javascript:;">编辑管理员</a></div>
    <h1>编辑管理员</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
            <h5>管理员信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="/admin/do_edit" name="adminEditForm" id="adminEditForm" onSubmit="return Validator.Validate(this, 3)">
            <input type="hidden" name="id" value="<?php echo $info['id'];?>"> 
              <div class="control-group">
                <label class="control-label">管理员名称</label>
                <div class="controls">
                  <input type="text" name="name" value="<?php echo $info['name'];?>" dataType="Require" msg=" 管理员名称不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">登录密码</label>
                <div class="controls">
                    <input type="password" name="pwd">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">确认密码</label>
                <div class="controls">
                  <input type="password" name="re_pwd" dataType="Repeat" to="pwd" msg=" 两次密码输入不一致！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">管理员真实姓名</label>
                <div class="controls">
                  <input type="text" name="realname" value="<?php echo $info['realname'];?>" dataType="Require" msg=" 管理员真实姓名不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">移动电话</label>
                <div class="controls">
                  <input type="text" name="phone" value="<?php echo $info['phone'];?>" dataType="Mobile" msg=" 移动电话格式输入不正确！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">座机号码</label>
                <div class="controls">
                  <input type="text" name="telphone" value="<?php echo $info['telphone'];?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">选择角色</label>
                <div class="controls">
                  <div class="controls-row btmmargin-mini">
                    <select multiple name="role_id[]" dataType="Require" msg=" 管理员角色不能为空！">
                      <option value="0">选择角色</option>
                      <?php foreach($role_list AS $roleKey => $roleVal):?>
                      <option value="<?php echo $roleVal['id'];?>"<?php if(in_array($roleVal['id'], $info['role_array'])):?> selected="selected"<?php endif;?>><?php echo $roleVal['name'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">管理员描述</label>
                <div class="controls">
                  <textarea rows="6" class="span8" placeholder="关于管理员的简单描述。" name="detail"><?php echo $info['detail'];?></textarea>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">保存</button> <button class="btn" onclick="window.location.href='/admin/edit?id=<?php echo $info['id'];?>'">取消</button>
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
        location.href = '/admin';
      }
    }
  };
  $("#adminEditForm").ajaxForm(options);
});
</script>
<?php $this->load->view('include/footer.php');?>