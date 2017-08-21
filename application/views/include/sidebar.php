<!--sidebar-menu-->
<div id="sidebar">
  <ul>
  <?php foreach($leftMenu AS $leftKey => $leftVal):?>
    <?php if(isset($leftVal['list']) && !empty($leftVal['list'])):?>
    <li class="submenu<?php if($leftVal['left_open'] == 1):?> open<?php endif;?>"><a href="javascript:;"><i class="icon<?php if(!empty($leftVal['icon'])):?><?php echo ' ' . $leftVal['icon'];?><?php else:?> icon-tint<?php endif;?>"></i> <span><?php echo $leftVal['name'];?></span></a>
        <ul>
            <?php foreach($leftVal['list'] AS $listKey => $listVal):?>
            <li<?php if($listVal['is_active'] == 1):?> class="active"<?php endif;?>><a href="/<?php echo $listVal['requestPath'];?>"><?php echo $listVal['name'];?></a></li>
            <?php endforeach;?>
        </ul>
    </li>
    <?php else:?>
    <li<?php if($leftVal['left_open'] == 1):?> class="active"<?php endif;?>><a href="/<?php echo $leftVal['requestPath'];?>"><i class="icon<?php if(!empty($leftVal['icon'])):?><?php echo ' ' . $leftVal['icon'];?><?php else:?> icon-tint<?php endif;?>"></i> <span><?php echo $leftVal['name'];?></span></a></li>
    <?php endif;?>
  <?php endforeach;?>
  </ul>
</div>