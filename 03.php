<?php

use e03\Employee;
use e03\Task;

require_once 'e03/Task.php';
require_once 'e03/Employee.php';

$ivan = new Employee('Ivan');
$homework = new Task('OOP', 8);
$project = new Task('Pokemon', 256);
$ivan->work();

$ivan->setCurrentTask($homework);
$ivan->setHoursLeft(12);
$ivan->setCurrentTask($homework);
$ivan->work();

$ivan->setCurrentTask($project);
$ivan->work();

$ivan->setHoursLeft(8);
$ivan->work();

echo $ivan->getHoursLeft(). PHP_EOL;

$ivan->setHoursLeft(24);
$ivan->setCurrentTask($homework);
$ivan->work();

$ivan->setCurrentTask($project);
$ivan->setName("Mazo");
$ivan->work();

// for ($i = 0; $i < 14; $i++){
// 	$ivan->setHoursLeft(10 + $i);
// 	$ivan->work();
// }
