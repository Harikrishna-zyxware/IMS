<?php ob_start() ?>
<div id="display">
<h1>LOGIN</h1>
<form action="http://blog/stage-5/index.php/login_action" method="post" >
    <br>
    User Name:<br><input type="text" name="name" id="input_name" placeholder="username" ><br><br>
    Password:<br><input type="password" name="password" placeholder="password" >
    <br><br>
    <input type="submit" value="send">
</form>
</div><!-- /.blog-post -->
<?php $content = ob_get_clean(); 

require "templates/layout.tpl.php" ?>