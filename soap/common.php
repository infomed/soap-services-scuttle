<?php
// Determine the base URL
if (!isset($root)) {
    $pieces = explode('/', $_SERVER['SCRIPT_NAME']);
    $root = '/';
    foreach($pieces as $piece) {
        if ($piece != '' && !strstr($piece, '.php')) {
            $root .= $piece .'/';
        }
    }
    if (($root != '/') && (substr($root, -1, 1) != '/')) {
        $root .= '/';
    }
    $root = 'http://'. $_SERVER['HTTP_HOST'] . $root;
}
?>