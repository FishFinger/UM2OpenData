<?php
require_once 'defines.php';

$repo = escapeshellcmd(urldecode($_GET['repo']));
$input_type = escapeshellcmd(urldecode($_GET['input_type']));


$output_type = "jpg";
$mime_type = "image/jpeg";

$rapper_cmd = "rapper -o dot -i $input_type $repo";

$dot_cmd = DOTCMD." -T$output_type";

$cmd = $rapper_cmd . ' | ' . $dot_cmd;

header("Content-type: $mime_type");
header("Content-Disposition: attachment; filename=\"graph.$output_type\"");

print shell_exec($cmd);