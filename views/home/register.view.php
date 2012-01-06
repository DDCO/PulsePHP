<h2 style="margin-bottom:1em">User account</h2>
<?php if(isset($userExists)) { ?>
<p class="error"><?php echo($userExists);?></p>
<?php } ?>
<?php if(isset($success)) { ?>
<p class="success"><?php echo($success);?></p>
<?php } ?>
<form method="post" action="<?php Framework::route('home','register')?>">
    <table>
		<tbody>
			<tr>
				<td>Username: <span class="required">*</span></td>
				<td><input type="text" name="username"/></td>
				<td class="error"><?php if(isset($errors["username"])){echo($errors["username"]);}?></td>
			</tr>
			<tr>
				<td>Password: <span class="required">*</span></td>
				<td><input type="password" name="password"/></td>
				<td class="error"><?php if(isset($errors["password"])){echo($errors["password"]);}?></td>
			</tr>
            <tr>
				<td>Confirm Password: <span class="required">*</span></td>
				<td><input type="password" name="confirm"/></td>
				<td class="error"><?php if(isset($errors["confirm"])){echo($errors["confirm"]);}?></td>
			</tr>
			<tr>
				<td>Email: <span class="required">*</span></td>
				<td><input type="text" name="email"/></td>
				<td class="error"><?php if(isset($errors["email"])){echo($errors["email"]);}?></td>
			</tr>
			<tr><td colspan="2" style="text-align:right;"><input type="submit" value="Register"/></td></tr>
		</tbody>
    </table>
</form>
