<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="/role">角色管理</a> <a href="javascript:;">角色权限配置</a></div>
    <h1>角色权限配置</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><?php echo $info['name'];?> - 权限配置</h5>
          </div>
          <form class="form-horizontal" method="post" action="/role/do_authorization_config" name="authorizationConfigForm" id="authorizationConfigForm">
          <input type="hidden" name="id" value="<?php echo $info['id'];?>">
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>一级菜单</th>
                  <th>二级菜单</th>
                  <th width="70%">所有权限</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($list AS $levelOneKey => $levelOneVal):?>
                <?php if(isset($levelOneVal['list']) && !empty($levelOneVal['list'])):?>
                  <?php
                    $levelTwoNo = 0;
                    foreach($levelOneVal['list'] AS $levelTwoKey => $levelTwoVal):
                  ?>
                    <?php if(isset($levelTwoVal['list']) && !empty($levelTwoVal['list'])):?>
                    <tr>
                      <td>
                        <?php if($levelTwoNo == 0):?>
                        <input type="checkbox" id="authorization_path_<?php echo $levelOneVal['path'];?>" name="authorization_<?php echo $levelOneVal['id'];?>" value="<?php echo $levelOneVal['id'];?>"<?php if(in_array($levelOneVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?> />
                        <?php echo $levelOneVal['name'];?>
                        <?php endif;?>
                      </td>
                      <td>
                        <input type="checkbox" id="authorization_path_<?php echo $levelTwoVal['path'];?>" name="authorization_<?php echo $levelTwoVal['id'];?>" value="<?php echo $levelTwoVal['id'];?>"<?php if(in_array($levelTwoVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?>/>
                        <?php echo $levelTwoVal['name'];?>
                      </td>
                      <td>
                      <?php
                        $levelThreeNo = 1;
                        foreach($levelTwoVal['list'] AS $levelThreeKey => $levelThreeVal):
                      ?>
                      <input type="checkbox" id="authorization_path_<?php echo $levelThreeVal['path'];?>" name="authorization_<?php echo $levelThreeVal['id'];?>" value="<?php echo $levelThreeVal['id'];?>"<?php if(in_array($levelThreeVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?> />
                      <?php
                        echo $levelThreeVal['name'];
                        if($levelThreeNo%6 == 0){
                          echo '<br>';
                        }
                      ?>
                      <?php
                        $levelThreeNo++;
                        endforeach;
                      ?>
                      </td>
                    </tr>
                    <?php else:?>
                      <tr>
                        <td>
                          <?php if($levelTwoNo == 0):?>
                            <input type="checkbox" id="authorization_path_<?php echo $levelOneVal['path'];?>" name="authorization_<?php echo $levelOneVal['id'];?>" value="<?php echo $levelOneVal['id'];?>"<?php if(in_array($levelOneVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?> />
                            <?php echo $levelOneVal['name'];?>
                          <?php endif;?>
                        </td>
                        <td>
                          <input type="checkbox" id="authorization_path_<?php echo $levelTwoVal['path'];?>" name="authorization_<?php echo $levelTwoVal['id'];?>" value="<?php echo $levelTwoVal['id'];?>"<?php if(in_array($levelTwoVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?> />
                          <?php echo $levelTwoVal['name'];?>
                        </td>
                        <td></td>
                      </tr>
                    <?php endif;?>
                  <?php
                    $levelTwoNo++;
                    endforeach;
                  ?>
                <?php else:?>
                  <tr>
                    <td>
                      <input type="checkbox" id="authorization_path_<?php echo $levelOneVal['path'];?>" name="authorization_<?php echo $levelOneVal['id'];?>" value="<?php echo $levelOneVal['id'];?>"<?php if(in_array($levelOneVal['id'], $info['authorization_array'])):?> checked="checked"<?php endif;?> />
                      <?php echo $levelOneVal['name'];?>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                <?php endif;?>
              <?php endforeach;?>
              </tbody>
            </table>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">保存</button> <button class="btn" onclick="window.location.href='/role/authorization_config'">取消</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>static/js/jquery.form.js"></script>
<script type="text/javascript">
$(function () {
  $(":checkbox[id^='authorization_path_']").click(function(){
    var thisID = $(this).attr('id').substring(19);
    var thisChecked = $(this).prop('checked');
    $(":checkbox[id^='authorization_path_"+thisID+"_']").prop('checked', thisChecked);
    if(thisChecked){
      var exThisIds = thisID.split("_");
      while(exThisIds.length > 0){
        exThisIds.pop();
        var joinID = exThisIds.join("_");
        $(":checkbox[id='authorization_path_"+exThisIds+"']").prop('checked', thisChecked);
      }
    }
    $.uniform.update();
  });

  var submitOptions = {
    dataType : "json",
    success: function (jsonData) {
      alert(jsonData.callbackMsg);
      if(jsonData.callbackCode == 1){
        location.href = '/role';
      }
    }
  };
  $("#authorizationConfigForm").ajaxForm(submitOptions);
});
</script>
<?php $this->load->view('include/footer.php');?>