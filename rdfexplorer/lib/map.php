<?php

function getMap($repo, $input_type) {

    $rapper_cmd = "rapper -o dot -i $input_type $repo";

    $dot_cmd = "dot -Tcmapx";

    $cmd = $rapper_cmd . ' | ' . $dot_cmd;

    return shell_exec($cmd);
}