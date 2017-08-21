<?php $this->load->view('include/header.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i> 仪表盘</a> <a href="javascript:;">属性管理</a></div>
        <h1><?=$table_name ?>属性 - <?=$item_name?$item_name:$item_id ?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
                        <h5><?=$table_name ?>属性</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="/attr/do_edit" name="attrEditForm" id="attrEditForm" onSubmit="return Validator.Validate(this, 3)" enctype="multipart/form-data">
                            <input type=hidden name="item_id" value="<?=$item_id ?>">
                            <input type=hidden name="table_name" value="<?=$table_name ?>">
                            <?php foreach($list AS $attrKey => $attrVal){?>
                            <div class="control-group">
                                <label class="control-label"><?=$attrVal["field_name"] ?></label>
                                <div class="controls">
                                    <?php if($attrVal["field_type"] == FIELD_TYPE_TEXT){ ?>
                                    <input type="text" name="field_<?=$attrVal["field_id"] ?>" value="<?=$attrVal["attr_value"] ?>">
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_AREA){ ?>
                                    <textarea rows="6" class="span8" name="field_<?=$attrVal["field_id"] ?>" ><?=$attrVal["attr_value"] ?></textarea>
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_SELECT){ ?>
                                    <select name="field_<?=$attrVal["field_id"] ?>">
                                        <option value="" > -- </option>
                                        <?php foreach($config_list[$attrVal["field_code"]] as $key=>$config){ ?>
                                        <option value="<?=$config['config_value'] ?>"<?php if($attrVal["attr_value"] == $config['config_value']){ ?> selected="selected"<?php } ?> ><?=$config['config_value'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_RADIO){ ?>
                                        <?php foreach($config_list[$attrVal["field_code"]] as $key=>$config){ ?>
                                     <?=$config["config_value"] ?><input type="radio" name="field_<?=$attrVal["field_id"] ?>" value="<?=$config["config_value"] ?>"<?php if($attrVal["attr_value"] == $config['config_value']){ ?> checked="checked"<?php } ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php } ?>
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_CHECKBOX){ ?>
                                        <?php $attr_value_arr = empty($attrVal["attr_value"])?array():explode( ",",$attrVal["attr_value"]); ?>
                                        <?php foreach($config_list[$attrVal["field_code"]] as $key=>$config){ ?>
                                     <input type="checkbox" name="field_<?=$attrVal["field_id"] ?>[]" value="<?=$config["config_value"] ?>"<?php if(in_array($config['config_value'], $attr_value_arr)){ ?> checked="checked"<?php } ?> /><?=$config["config_value"] ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php } ?>
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_NUMBER){ ?>
                                    <input type="text" name="field_<?=$attrVal["field_id"] ?>" value="<?=$attrVal["attr_value"] ?>">
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_IMAGE){ ?>
                                    <span id="preview_<?=$attrVal["field_id"] ?>" style="width:200px;height:200px;display:block;"><img style="width:200px;height:200px; " src="<?=base_url().($attrVal["attr_value"]?$attrVal["attr_value"]:"/static/img/default.jpg") ?>" /></span><br />
                                    <input type="file" name="field_<?=$attrVal["field_id"] ?>" onchange="preview(this,<?=$attrVal["field_id"] ?>)">
                                    <?php }elseif($attrVal["field_type"] == FIELD_TYPE_DATE){ ?>
                                    <input type="text" name="field_<?=$attrVal["field_id"] ?>" value="<?=$attrVal["attr_value"] ?>" dataType="Require">
                                    <?php }else{ ?>
                                    <?=$attrVal["attr_value"] ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">保存</button> 
                                <input class="btn" type="button" name="Submit" value="取消" onclick ="location.href='/member/index'"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>static/js/jquery.form.js"></script>
<script type="text/javascript">
$(function () {
  var options = {
    dataType : "json",
    success: function (jsonData) {
      alert(jsonData.callbackMsg);
      if(jsonData.callbackCode == 1){
        location.href = '/attr/edit?item_id=<?=$item_id ?>&item_name=<?=urlencode($item_name) ?>&table_name=<?=urlencode($table_name) ?>';
      }
    }
  };
  $("#attrEditForm").ajaxForm(options);
});
</script>
<script type="text/javascript">    
    function preview(file,id){  
        var prevDiv = document.getElementById('preview_' + id);  
        prevDiv.innerHTML = "";
        if (file.files && file.files[0]){  
            var reader = new FileReader();  
            reader.onload = function(evt){  
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" style="width:200px;height:200px;" />';  
            }    
            reader.readAsDataURL(file.files[0]);  
        }else{  
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';  
        }  
    }  
 </script>  
<?php $this->load->view('include/footer.php'); ?>