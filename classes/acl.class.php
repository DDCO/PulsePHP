<?php
class ACL
{	
	public static function hasAccess($acl,$method)
	{
		if(empty($acl))
			return true;
		$usergroup = isset($_SESSION['user'])?$_SESSION['user']['usergroup']:"Guest";
		foreach($acl as $group => $access)
		{
			if($usergroup != $group) // not the group we are looking for
				continue;
			if(is_array($access))
			{
				if(in_array($method,$access))
					return true;
				else
					self::accessDenied();
			}
			elseif( (strtoupper($access) == "ALL") || ($access == $method))
				return true;
			else
				self::accessDenied();
		}
		self::accessDenied();
	}
	
	// Make this more elegant at another time
	private static function accessDenied()
	{
		die("Access Denied!");
	}
}
?>