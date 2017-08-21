<?php $this->load->view('include/header.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="/config">配置管理</a> <a href="javascript:;">批量添加配置</a></div>
        <h1>批量添加配置</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-plus"></i> </span>
                        <h5>配置信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="/config/do_adds" name="configAddForm" id="configAddForm" onSubmit="return Validator.Validate(this, 3)">
                            <div class="control-group">
                                <label class="control-label">配置项</label>
                                <div class="controls">
                                    <input type="text" name="config_code" id="config_code" dataType="Require" msg=" 配置项不能为空！" value="<?=$config_code ?>" />
                                    <select onchange="document.getElementById('config_code').value = this.value">
                                        <option value=""> -- 新增 -- </option>
                                        <?php foreach ($code_list AS $codeKey => $codeVal): ?>
                                            <option value="<?= $codeKey ?>"><?= $codeKey ?>(<?= count($codeVal) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">配置值</label>
                                <div class="controls">
                                    <textarea rows="6" class="span8" name="config_value" value="" placeholder="配置值。" dataType="Require" msg=" 配置值不能为空！"></textarea>
                                  <!--<input type="text" name="config_value" dataType="Require" msg=" 配置控制器不能为空！">-->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">排序</label>
                                <div class="controls">
                                    <input type="text" name="config_rank">
                                </div>
                            </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">保存</button> <a class="btn" href="/config/adds">取消</a>
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
                                dataType: "json",
                                success: function (jsonData) {
                                    alert(jsonData.callbackMsg);
                                    var config_code = $("#config_code").val();
                                    if (jsonData.callbackCode == 1) {
                                        location.href = '/config/item_list?config_code=' + config_code;
                                    }
                                }
                            };
                            $("#configAddForm").ajaxForm(options);
                        });
</script>
<?php $this->load->view('include/footer.php'); ?>