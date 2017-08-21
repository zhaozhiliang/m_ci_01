<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="/field">字段管理</a> <a href="javascript:;">添加字段</a></div>
    <h1>添加字段</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
            <h5>字段信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="/field/do_add" name="fieldAddForm" id="fieldAddForm" onSubmit="return Validator.Validate(this, 3)" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">主表</label>
                <div class="controls">
                    <select name="field_table">
                          <option value="会员">会员</option>
                      </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">字段名称</label>
                <div class="controls">
                  <input type="text" name="field_name" dataType="Require" msg=" 字段名称不能为空！">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">字段类型</label>
                <div class="controls">
                  <select name="field_type">
                          <option value="单行文字">单行文字</option>
                          <option value="单行文字">日期</option>
                          <option value="数值">数值</option>
                          <option value="多行文字">多行文字</option>
                          <option value="下拉菜单">下拉菜单</option>
                          <option value="单选">单选</option>
                          <option value="复选">复选</option>
                          <option value="图片上传">图片上传</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">配置项</label>
                <div class="controls">
                    <input type="text" name="field_code" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">字段排序</label>
                <div class="controls">
                    <input type="text" name="field_rank" value="1" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">是否必填</label>
                <div class="controls">
                    是<input type="radio" name="is_must" value="1" >
                    否<input type="radio" name="is_must" value="0" >
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">保存</button> 
                <input class="btn" type="button" name="Submit" value="取消" onclick ="location.href='/field/add'"/>
                
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
        location.href = '/field';
      }
    }
  };
  $("#fieldAddForm").ajaxForm(options);
});
</script>
<script type="text/javascript">    
    function preview(file){  
        var prevDiv = document.getElementById('preview');  
        prevDiv.innerHTML = "";
        if (file.files && file.files[0]){  
            var reader = new FileReader();  
            reader.onload = function(evt){  
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" style="width:180px;height:180px;" />';  
            }    
            reader.readAsDataURL(file.files[0]);  
        }else{  
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';  
        }  
    }  
 </script>  
<?php $this->load->view('include/footer.php');?>