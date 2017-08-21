<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="/menu">菜单管理</a> <a href="javascript:;">编辑菜单</a></div>
    <h1>编辑菜单</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
            <h5>菜单信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="/menu/do_edit" name="menuEditForm" id="menuEditForm" onSubmit="return Validator.Validate(this, 3)">
            <input type="hidden" name="id" value="<?php echo $info['id'];?>">
              <div class="control-group">
                <label class="control-label">所属菜单</label>
                <div class="controls">
                  <select name="parent_id">
                      <option value="0">顶级菜单</option>
                      <?php foreach($list AS $menuKey => $menuVal):?>
                      <?php if($menuVal['depth'] < 3):?>
                      <option value="<?php echo $menuVal['id'];?>"<?php if($menuVal['id'] == $info['parent_id']):?> selected="selected"<?php endif;?>>|<?php echo str_repeat("——", $menuVal['depth']) . $menuVal['name'];?></option>
                      <?php endif;?>
                      <?php endforeach?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">菜单名称</label>
                <div class="controls">
                  <input type="text" name="name" value="<?php echo $info['name'];?>" dataType="Require" msg=" 菜单名称不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">菜单控制器</label>
                <div class="controls">
                  <input type="text" name="controller" value="<?php echo $info['controller'];?>" dataType="Require" msg=" 菜单控制器不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">控制器方法名</label>
                <div class="controls">
                  <input type="text" name="action" value="<?php echo $info['action'];?>" dataType="Require" msg=" 控制器方法名不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">导航图标</label>
                <div class="controls">
                  <input type="text" name="icon" value="<?php echo $info['icon'];?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">排序</label>
                <div class="controls">
                  <input type="text" name="sort" value="<?php echo $info['sort'];?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">是否显示</label>
                <div class="controls">
                  <label>
                    <input type="radio" name="is_show" value="1"<?php if($info['is_show'] == 1):?> checked="checked"<?php endif;?> />是
                  </label>
                  <label>
                    <input type="radio" name="is_show" value="0"<?php if($info['is_show'] <> 1):?> checked="checked"<?php endif;?> />否
                  </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">菜单描述</label>
                <div class="controls">
                  <textarea rows="6" class="span8" name="description" placeholder="关于菜单的简单描述。" dataType="Require" msg=" 菜单描述不能为空！"><?php echo $info['description'];?></textarea>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">保存</button> <a class="btn" href="/menu/edit">取消</a>
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
        location.href = '/menu';
      }
    }
  };
  $("#menuEditForm").ajaxForm(options);
});
</script>
<?php $this->load->view('include/footer.php');?>