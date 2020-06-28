<?php
$s = 'a:1,b:2,c:3';
$s = explode(',',$s);
foreach($s as $t) {
	$v = explode(':',$t);
	print_r($v);
}
?>
