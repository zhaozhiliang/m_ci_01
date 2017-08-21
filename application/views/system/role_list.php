<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="javascript:;">角色管理</a></div>
    <h1>角色管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>列表</h5>
            <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href='/role/add'">添加角色</button></span>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>角色ID</th>
                  <th>角色名称</th>
                  <th>是否超级管理员</th>
                  <th width="50%">角色描述</th>
                  <th width="50">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($list AS $key => $val):?>
                <tr>
                  <td><?php echo $val['id'];?></td>
                  <td><?php echo $val['name'];?></td>
                  <td><?php if($val['is_super'] == 1){echo '是';}else{echo '否';}?></td>
                  <td><?php echo $val['description'];?></td>
                  <td>
                    <?php if($val['is_super'] <> 1):?>
                    <a href="/role/authorization_config?id=<?php echo $val['id'];?>" class="tip" data-original-title="设置权限"><i class="icon-cogs"></i></a>
                    <?php endif;?>
                    <a href="/role/edit?id=<?php echo $val['id'];?>" class="tip" data-original-title="编辑"><i class="icon-edit"></i></a>
                    <a href="javascript:;" id="del_role_<?php echo $val['id'];?>" class="tip" data-original-title="删除"><i class="icon-remove"></i></a>
                  </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function () {
  $("a[id^='del_role_']").click(function(){
    if(confirm("确定要删除数据吗？")){
      var thisID = $(this).attr('id').substring(9);
      $.getJSON("/role/do_del", { id: thisID }, function(jsonData){
        alert(jsonData.callbackMsg);
        if(jsonData.callbackCode == 1){
          location.href = '/role';
        }
      });
    }
  });
});
</script>
<?php $this->load->view('include/footer.php');?>