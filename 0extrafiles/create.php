<?php
	function create_user()
	{
		$user = array(
			"login" => $_POST["login"],
			"passwd" => hash("whirlpool",$_POST["passwd"])
		);
		if (file_exists("../htdocs/private/passwd"))
		{
			$unserfile = unserialize(file_get_contents("../htdocs/private/passwd"));
			$users = $unserfile;
		}
		$users[] = $user;
		file_put_contents("../htdocs/private/passwd", serialize($users));
		echo "OK\n";
	}

	function user_exists()
	{
		$unserfile = unserialize(file_get_contents("../htdocs/private/passwd"));
		foreach ($unserfile as $user)
		{
			if ($user["login"] === $_POST["login"])
				exit("ERROR\n");
		}
	}

	if ($_POST["submit"] !== "OK" && (!$_POST["login"]) || !$_POST["passwd"])
	{
		echo "ERROR\n";
		exit ;
	}

	if (!file_exists("../htdocs/private"))
		mkdir("../htdocs/private", 0755, true);

	if (user_exists())
	{
		exit ;
	}
	else
	{
		create_user();
	}
?>