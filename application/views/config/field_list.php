<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="javascript:;">字段管理</a> </div>
    <h1>查询字段</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>列表</h5>
            <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href='/field/add'">添加字段</button></span>
          </div>
          <div class="dataTables_length clearfix" style="width:100%;">
            <form name="search" id="searchbar" action="/field" method="get">
              <div class="fl label-group">
                <label class="fl dataTable-box-label">主表&nbsp;</label>
                  <div class="fl">
                      <select name="field_table">
                          <option value="会员">会员</option>
                      </select>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                <label class="fl dataTable-box-label">字段名称&nbsp;</label>
                  <div class="fl">
                    <input type="text" style="width:130px;" name="field_name" value="<?=$field_name ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                  <th>字段ID</th>
                  <th>主表</th>
                  <th>字段名称</th>
                  <th>字段类型</th>
                  <th>配置项</th>
                  <th>字段排序</th>
                  <th>是否必填</th>
                  <th>是否删除</th>
                  <th width="50">操作</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($list AS $fieldKey => $fieldVal):?>
                <tr>
                  <td style="text-align:center"><?php echo $fieldVal['field_id'];?></td>
                  <td style="text-align:center"><?php echo $fieldVal['field_table'];?></td>
                  <td style="text-align:center"><?php echo $fieldVal['field_name'];?></td>
                  <td style="text-align:center"><?php echo $fieldVal['field_type'];?></td>
                  <td style="text-align:center"><?=$fieldVal['field_code'] ?></td>
                  <td style="text-align:center"><?=$fieldVal['field_rank'] ?></td>
                  <td style="text-align:center"><?=$fieldVal['is_must']==1?"是":"否" ?></td>
                  <td style="text-align:center"><?=$fieldVal['is_delete']==1?"是":"否" ?></td>
                  <td style="text-align:center">
                    <a href="javascript:;" id="del_field_<?php echo $fieldVal['field_id'];?>" class="tip" data-original-title="删除" style="margin-left: 5px;"><i class="icon-remove"></i></a>
                    <!--<a href="/field/edit?field_id=<?php echo $fieldVal['field_id'];?>" class="tip" data-original-title="修改" style="margin-left: 8px;"><i class="icon-edit"></i></a>-->
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
  $("a[id^='del_field_']").click(function(){
    if(confirm("确定要删除数据吗？")){
      var thisID = $(this).attr('id').substring(12);
      $.getJSON("/field/do_del", { field_id: thisID }, function(jsonData){
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