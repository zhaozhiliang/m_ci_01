<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/login-style/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/login-style/css/animate.css" />
<script type="text/javascript" src="<?php echo base_url();?>static/login-style/js/login.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/login-style/js/jquery.min.js"></script>	  
</head>
<body>
<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;" width="1285" height="100%"></canvas>
<script type="text/javascript">
	var snow = function() {
    if(1==1) {
      $("body").append('<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;"></canvas>');
      var b = document.getElementById("christmasCanvas"), a = b.getContext("2d"), d = window.innerWidth, c = window.innerHeight;
      b.width = d;
      b.height = c;
      for(var e = [], b = 0;b < 70;b++) {
        e.push({x:Math.random() * d, y:Math.random() * c, r:Math.random() * 4 + 1, d:Math.random() * 70})
      }
      var h = 0;
      window.intervral4Christmas = setInterval(function() {
        a.clearRect(0, 0, d, c);
        a.fillStyle = "rgba(255, 255, 255, 0.6)";
        a.shadowBlur = 5;
        a.shadowColor = "rgba(255, 255, 255, 0.9)";
        a.beginPath();
        for(var b = 0;b < 70;b++) {
          var f = e[b];
          a.moveTo(f.x, f.y);
          a.arc(f.x, f.y, f.r, 0, Math.PI * 2, !0)
        }
        a.fill();
        h += 0.01;
        for(b = 0;b < 70;b++) {
          if(f = e[b], f.y += Math.cos(h + f.d) + 1 + f.r / 2, f.x += Math.sin(h) * 2, f.x > d + 5 || f.x < -5 || f.y > c) {
            e[b] = b % 3 > 0 ? {x:Math.random() * d, y:-10, r:f.r, d:f.d} : Math.sin(h) > 0 ? {x:-5, y:Math.random() * c, r:f.r, d:f.d} : {x:d + 5, y:Math.random() * c, r:f.r, d:f.d}
          }
        }
      }, 70)
    }
  }
  snow();
</script>
<h2 align="center">PINK后台管理系统</h2>
<div class="login_frame"></div>
<div class="LoginWindow">
  <form method="post" action="/welcome/do_login" name="adminLoginForm" id="adminLoginForm">
	<div>
		<div class="login">
			<p><input type="text" name="username" id="username" placeholder="用户名"></p>
			<p><input type="password" name="password" id="password" placeholder="密码"></p>
			<p class="login-submit"><button type="submit" class="login-button" id="submit">登录</button></p>
		</div>
	</div>
  </form>
</div>
<script src="<?php echo base_url();?>static/js/jquery.form.js"></script>
<script type="text/javascript">
$(function () {
  var options = {
    dataType : "json",
    success: function (jsonData) {
      alert(jsonData.callbackMsg);
      if(jsonData.callbackCode == 1){
        location.href = '/welcome/index';
      }
    }
  };
  $("#adminLoginForm").ajaxForm(options);
});
</script>
</body>
</html>