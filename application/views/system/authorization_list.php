<?php $this->load->view('include/header.php');?>
<?php $this->load->view('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url();?>" title="返回仪表盘" class="tip-bottom"><i class="icon-home"></i>仪表盘</a> <a href="javascript:;">系统设置</a> <a href="javascript:;">权限列表</a></div>
    <h1>权限列表</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>列表</h5>
          </div>
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
                      <td><?php if($levelTwoNo == 0){echo $levelOneVal['name'];}?></td>
                      <td><?php echo $levelTwoVal['name'];?></td>
                      <td>
                      <?php
                        $levelThreeNo = 1;
                        foreach($levelTwoVal['list'] AS $levelThreeKey => $levelThreeVal):
                      ?>
                      <?php
                        echo '【 ' . $levelThreeVal['name'] . ' 】';
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
                        <td><?php if($levelTwoNo == 0){echo $levelOneVal['name'];}?></td>
                        <td><?php echo $levelTwoVal['name'];?></td>
                        <td></td>
                      </tr>
                    <?php endif;?>
                  <?php
                    $levelTwoNo++;
                    endforeach;
                  ?>
                <?php else:?>
                  <tr>
                    <td><?php echo $levelOneVal['name'];?></td>
                    <td></td>
                    <td></td>
                  </tr>
                <?php endif;?>
              <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer.php');?>