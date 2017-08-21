<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="javascript:;">系统设置</a> </div>
    <h1>系统管理员</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>列表</h5>
            <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href='/admin/add'">添加管理员</button></span>
          </div>
          <div class="dataTables_length clearfix" style="width:100%;">
            <form name="search" id="searchbar" action="/admin" method="get">
              <div class="fl label-group">
                <label class="fl dataTable-box-label">管理员名称&nbsp;</label>
                  <div class="fl">
                    <input type="text" style="width:130px;" name="name" value="<?php echo $getName;?>">&nbsp;&nbsp;&nbsp;
                  </div>
              </div>
              <div class="fl label-group">
                 <div class="fl">
                      <button class="btn" type="submit">查询</button>
                 </div>
              </div>
            </form>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>管理员ID</th>
                  <th>管理员名称</th>
                  <th>管理员真实姓名</th>
                  <th>管理员手机</th>
                  <th>管理员座机</th>
                  <th>管理员角色</th>
                  <th>管理员描述</th>
                  <th width="50">操作</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($list AS $adminKey => $adminVal):?>
                <tr>
                  <td><?php echo $adminVal['id'];?></td>
                  <td><?php echo $adminVal['name'];?></td>
                  <td><?php echo $adminVal['realname'];?></td>
                  <td><?php echo $adminVal['phone'];?></td>
                  <td><?php echo $adminVal['telphone'];?></td>
                  <td>
                  <?php
                    $role_array = explode(',', $adminVal['role_id']);
                      foreach($role_array AS $roleKey => $roleVal){
                        if(!empty($roleVal)) echo '【' . $roleInfo[$roleVal] . '】';
                      }
                  ?>
                  </td>
                  <td><?php echo $adminVal['detail'];?></td>
                  <td>
                    <a href="/admin/edit?id=<?php echo $adminVal['id'];?>" class="tip" data-original-title="编辑" style="margin-left: 8px;"><i class="icon-edit"></i></a>
                    <a href="javascript:;" id="del_admin_<?php echo $adminVal['id'];?>" class="tip" data-original-title="删除" style="margin-left: 5px;"><i class="icon-remove"></i></a>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <div class="btmoption clearfix">
              <div class="pagination alternate">
                  <ul>
                    <?php echo $Paging[0] . $Paging[1] . $Paging[2];?>
                  </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function () {
  $("a[id^='del_admin_']").click(function(){
    if(confirm("确定要删除数据吗？")){
      var thisID = $(this).attr('id').substring(10);
      $.getJSON("/admin/do_del", { id: thisID }, function(jsonData){
        alert(jsonData.callbackMsg);
        if(jsonData.callbackCode == 1){
          location.href = window.location.href;
        }
      });
    }
  });
});
</script>
<?php $this->load->view('include/footer.php');?>