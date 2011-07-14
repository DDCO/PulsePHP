<form method="post" action="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/register">
	<table>
		<thead>
			<tr>
				<th colspan="2"><h3>Register</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><label>Username:</label></td>
				<td><input type="text" name="username"/></td>
				<?php if(isset($errors["username"])) { ?>
				<td><?php echo($errors["username"]);?></td>
				<?php } ?>
			</tr>
			<tr>
				<td><label>Password:</label></td>
				<td><input type="password" name="password"/></td>
                <?php if(isset($errors["password"])) { ?>
                <td><?php echo($errors["password"]);?></td>
                <?php } ?>
            </tr>
            <tr>
            	<td><label>Confirm Password:</label></td>
                <td><input type="password" name="confirm"/></td>
                <?php if(isset($errors["confirm"])) { ?>
                <td><?php echo($errors["confirm"]);?></td>
                <?php } ?>
            </tr>
			<tr>
				<td><label>Email:</label></td>
				<td><input type="text" name="email"/></td>
				<?php if(isset($errors["email"])) { ?>
				<td><?php echo($errors["email"]);?></td>
				<?php } ?>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right;"><input type="submit"/></td>
			</tr>
		</tbody>
	</table>
</form>