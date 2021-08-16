<?php

$output = shell_exec('composer dump-autoload --optimize');
echo $output;