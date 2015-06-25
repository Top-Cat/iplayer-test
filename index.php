<?php

// Set up class loading
spl_autoload_register(function ($classname) {
	include str_replace('_', '/', $classname) . '.php';
});

// Read GET variables determining the API parameters
$letter = isset($_GET['l']) ? $_GET['l'] : 'a';
$page = isset($_GET['p']) ? $_GET['p'] : 1;

// Start our API call
$bbc = new BBC_Api($letter, $page);
$bbc->doCall();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head>
		<title>iPlayer Exercise</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div id="nav">
			<ul><?php foreach(range(1, $bbc->getPageCount()) as $i) { ?><li<?php if ($i == $page) { ?> class="sel"<?php } ?>><a href="http://thomasc.co.uk/bbc/?l=<?=$letter; ?>&p=<?=$i;?>"><?=$i;?></a></li><?php } ?></ul><br />
			<ul><?php foreach(range('a','z') as $i) { ?><li<?php if ($i == $letter) { ?> class="sel"<?php } ?>><a href="http://thomasc.co.uk/bbc/?l=<?=$i;?>"><?=$i;?></a></li><?php } ?></ul>
		</div>
		<ul id="programmes"><?php

$progs = $bbc->getProgrammes();
foreach ($progs as $prog) {

	?><li><img src="<?=$prog->getImageUrl(); ?>" /><?=$prog->getTitle(); ?></li><?php

}

		?></ul>
	</body>
</html>