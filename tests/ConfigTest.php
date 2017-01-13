<?php

require __DIR__ . '/../App/autoload.php';

$config = \App\Config::instance();

assert('localhost' == $config->data['db']['host']);
assert('php2' == $config->data['db']['dbname']);
assert('danis' == $config->data['db']['user']);
assert('' == $config->data['db']['password']);