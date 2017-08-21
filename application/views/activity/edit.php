<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
    <script src="<?php echo base_url();?>static/js/My97Date/WdatePicker.js"></script>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="/activity">活动管理</a> <a href="javascript:;">编辑活动</a></div>
    <h1>编辑活动</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
            <h5>活动信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="/activity/do_edit" name="adminAddForm" id="adminAddForm" onSubmit="return Validator.Validate(this, 3)">
              <div class="control-group">
                <label class="control-label">活动名称</label>
                <div class="controls">
                  <input type="text" name="title" value="<?php echo $info['title']; ?>" dataType="Require" msg=" 活动名称不能为空！">
                </div>
              </div>

                <div class="control-group">
                    <label class="control-label">活动图片</label>
                    <input type="hidden" name="game_img" id="img_url" value="<?php echo $info['img'];?>"  dataType="Require" msg=" 活动图片不能为空！" />
                    <div class="controls" style="float:left; margin-left:22px;" >
                        <img src="<?php echo $info['img'];?>" width="180px" height="180px">
                        <div id="ossfile_img">你的浏览器不支持flash,Silverlight或者HTML5！</div>
                        <br/>
                        <div id="container">
                            <a id="selectImgFiles" href="javascript:void(0);" class='btn'>选择文件</a>
                            <a id="postImgfiles" href="javascript:void(0);" class='btn'>开始上传</a>
                            <span class="validate-error">图片上传支持格式：jpg,gif,png,bmp,jpeg；文件最大支持：10MB</span>
                        </div>
                    </div>
                </div>


                <div class="control-group">
                <label class="control-label">活动内容</label>
                <div class="controls">
                  <textarea rows="6" class="span8" placeholder="活动正文" name="content" dataType="Require" msg=" 活动图片不能为空！" ><?php echo $info['content'];?></textarea>
                </div>
              </div>

                <div class="control-group">
                    <label class="control-label">截止日期</label>
                    <div class="controls">

                        <input type="text" style="width:135px;" id="end_time" class="n_input four_input" name="end_time"
                               value="<?php echo $info['end_time']; ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:'%y-%M-%d %H:%m'})"  dataType="Require" msg=" 截止日期不能为空！" >
                    </div>
                </div>

              <div class="form-actions">
                  <input type="hidden" value="<?php echo $info['id'];?>" name="id" />
                <button type="submit" class="btn btn-success">保存</button> <button class="btn" onclick="window.location.href='/activity/edit'">取消</button>
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

      if(jsonData.status == 1){
        location.href = '/activity/activityList';
      }else{
          alert(jsonData.msg);
      }
    }
  };
  $("#adminAddForm").ajaxForm(options);
});
</script>
    <script src="<?php echo base_url();?>static/js/plupload/plupload.full.min.js"></script>
    <script> var  OSS_URL = '<?php echo OSS_URL;?>';</script>
    <script src="<?php echo base_url();?>static/js/plupload_img.js"></script>
<?php $this->load->view('include/footer.php');?>