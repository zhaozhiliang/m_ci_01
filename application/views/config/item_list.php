<?php $this->load->view('include/header.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="javascript:;">配置管理</a></div>
        <h1>配置管理</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>列表</h5>
                        <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href = '/config/add?config_code=<?=$config_code ?>'">添加配置</button></span>
                        <span class="buttons"><button class="btn btn-success btn-mini" onClick="window.location.href = '/config/adds?config_code=<?=$config_code ?>'">批量添加配置</button></span>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>配置编号</th>
                                    <th>配置项</th>
                                    <th>配置索引</th>
                                    <th>配置值</th>
                                    <th>排序</th>
                                    <th>是否显示</th>
                                    <th width="70">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list AS $configKey => $configVal): ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $configVal['config_id']; ?></td>
                                        <td style="text-align: center;"><?php echo $configVal['config_code']; ?></td>
                                        <td style="text-align: center;"><?php echo $configVal['config_key']; ?></td>
                                        <td style="text-align: center;"><?php echo $configVal['config_value']; ?></td>
                                        <td style="text-align: center;"><?php echo $configVal['config_rank']; ?></td>
                                        <td style="text-align: center;"><?php
                                            if ($configVal['is_delete'] == 0) {
                                                echo '是';
                                            } else {
                                                echo '否';
                                            }
                                            ?></td>
                                        <td>
                                            <a href="/config/edit?config_id=<?php echo $configVal['config_id']; ?>" class="tip" data-original-title="编辑" style="margin-left: 8px;">编辑</a>
                                            <a href="javascript:;" id="del_config_<?php echo $configVal['config_id']; ?>" class="tip" data-original-title="删除" style="margin-left: 5px;">删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
        $("a[id^='del_config_']").click(function () {
            if (confirm("确定要删除数据吗？")) {
                var thisID = $(this).attr('id').substring(11);
                $.getJSON("/config/do_del", {id: thisID}, function (jsonData) {
                    alert(jsonData.callbackMsg);
                    if (jsonData.callbackCode == 1) {
                        location.href = '/config/item_list?config_code=<?php echo $configVal['config_code']; ?>';
                    }
                });
            }
        });
    });
</script>
<?php $this->load->view('include/footer.php'); ?>