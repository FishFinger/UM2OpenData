<?php
include 'lib/map.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Test</title>
	<link rel="stylesheet" href="style-result.css" type="text/css" media="screen">
        <script type="text/javascript" src="jquery.js" language="Javascript"></script>
        <script type="text/javascript" src="jquery-ui.js" language="Javascript"></script>
        <script type="text/javascript" src="script.js" language="Javascript"></script>
    </head>

    <body>
        <img id="graph" src="lib/graph.php?repo=<?php echo $_GET['repo'] ?>&input_type=<?php echo $_GET['input_type'] ?>" usemap="_anonymous_0"/>
        <?php echo getMap(escapeshellcmd(urldecode($_GET['repo'])), escapeshellcmd(urldecode($_GET['input_type']))) ?>
    </body>
</html>
