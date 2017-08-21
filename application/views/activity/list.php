<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="javascript:;">活动管理</a> </div>
    <h1>活动管理</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>列表</h5>
            <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href='/activity/add'">添加活动</button></span>
          </div>
          <div class="dataTables_length clearfix" style="width:100%;">
            <form name="search" id="searchbar" action="/activity/activityList" method="get">
              <div class="fl label-group">
                <label class="fl dataTable-box-label">活动名称&nbsp;</label>
                  <div class="fl">
                    <input type="text" style="width:130px;" name="title" value="<?php if(isset($select['title'])){ echo $select['title'];}?>">&nbsp;&nbsp;&nbsp;
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
                  <th>活动ID</th>
                  <th>活动名称</th>
                  <th>活动图片</th>
                  <th>截止日期</th>
                  <th>添加时间</th>
                  <th width="150">操作</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(!empty($list) && is_array($list)) {
                  foreach ($list AS $adminKey => $adminVal):?>
                      <tr>
                          <td><?php echo $adminVal['id'];?></td>
                          <td><?php echo $adminVal['title'];?></td>
                          <td><?php if(!empty($adminVal['img'])){ echo '<img src="'.$adminVal['img'].'" width=120 />'; }else{ echo '';}?></td>
                          <td><?php echo $adminVal['end_time'];?></td>
                          <td><?php echo $adminVal['add_time'];?></td>
                          <td>
                              <a href="/activity/edit?id=<?php echo $adminVal['id'];?>" class=""
                                style="margin-left: 8px;">编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;
                              <a href="javascript:;" id="del_admin_<?php echo $adminVal['id'];?>" class=""
                                  style="margin-left: 5px;">删除</a>
                          </td>
                      </tr>
                  <?php endforeach;
              }?>
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
      $.getJSON("/activity/do_del", { id: thisID }, function(jsonData){

        if(jsonData.status == 1){
            alert('操作成功');
          location.href = window.location.href;
        }else{
            alert(jsonData.msg);
        }
      });
    }
  });
});
</script>
<?php $this->load->view('include/footer.php');?>