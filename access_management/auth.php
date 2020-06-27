<?php
	function auth($login, $passwd)
	{
		$hashpass = hash("whirlpool",$passwd);
		$unserfile = unserialize(file_get_contents("../htdocs/private/passwd"));
		foreach ($unserfile as $user)
		{
			if ($user["login"] === $login)
			{
				if($user["passwd"] === $hashpass)
					return(TRUE);
			}
		}
		return(FALSE);
	}
?>