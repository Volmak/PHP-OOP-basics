<?php

require_once 'e01/Computer.php';
use e01\Computer;

$koshnica = new Computer(1999, 120, false, 40, 4, 'Windows XP SP2');
$duska = new Computer(2014, 1200, true, 1000, 280, 'Windows 7');

print $koshnica->useMemory(100);
//$koshnica->useMemory(100);

$duska->changeOperationSystem(["Windows 10", "Linux Ubuntu"]);

$koshnica->getInfo();
$duska->getInfo();