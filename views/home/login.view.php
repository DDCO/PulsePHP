<h2 style="margin-bottom:1em">User account</h2>
<form method="post" action="<?php Framework::route('home','login')?>" style="width:175px;">
    <label>Username: <span class="required">*</span></label><br/>
    <input type="text" name="username"/><span class="error"><?php if(isset($errors["username"])){echo($errors["username"]);}?></span><br/>
    <p style="margin-bottom:1em">Enter your username.</p>
    <label>Password: <span class="required">*</span></label><br/>
    <input type="password" name="password"/><span class="error"><?php if(isset($errors["password"])){echo($errors["password"]);}?></span><br/>
    <p style="margin-bottom:1em">Enter your password.</p>
    <input type="submit" value="Login"/>
</form>
