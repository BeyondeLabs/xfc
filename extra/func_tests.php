<?php

$bytes = openssl_random_pseudo_bytes(40, TRUE);
var_dump($bytes);


$hex   = bin2hex($bytes);

var_dump($hex);
