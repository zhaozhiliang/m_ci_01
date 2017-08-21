<input type="hidden" name="area_code" id="area_code" value="<?=  isset($area_code)?$area_code:"" ?>" >
<input type="text" name="area_name" id="area_name" value="<?=  isset($area_name)?$area_name:"" ?>" readonly="readonly" ><br /><br />
<select id="province_code" onchange="sele_province()">
    <option>--请选择省--</option>
</select>
<select id="city_code" onchange="sele_city()">
    <option>--请选择市--</option>
</select>
<select id="county_code" onchange="sele_county()">
    <option>--请选择区县--</option>
</select>
<script src="<?php echo base_url();?>static/js/region.js"></script>