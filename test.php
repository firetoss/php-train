<?php
$arr = array(
    'default' => array(1),
    1111 => array(1),
    3333 => array(1),
);

$keys = array_keys($arr);
rsort($keys);
print_r($keys);
