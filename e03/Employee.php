<?php

namespace e03;

	$name;
	$currentTask;
	$hoursLeft;

class Employee
{
	public function __construct(string$name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName(string$name)
	{
		$this->name = $name;
	}
	public function getCurrentTask()
	{
		return isset($this->currentTask) ? $this->currentTask : 'No current Task';
	}
	public function setCurrentTask(Task$currentTask)
	{
		$this->currentTask = $currentTask;
	}
	public function getHoursLeft()
	{
		return isset($this->hoursLeft) ? $this->hoursLeft : ".setHoursLeft first.";
	}
	public function setHoursLeft(float$hoursLeft)
	{
		$this->hoursLeft = $hoursLeft;
	}
	public function work()
	{
		if (isset($this->currentTask)){
			$this->setHoursLeft($this->getCurrentTask()->work($this->getHoursLeft()));
		}
		$this->showReport();
	}
	public function showReport()
	{
		$task = $this->getCurrentTask();
		echo 'Name: ' . $this->getName() . PHP_EOL;
		echo 'Work hours: ' . $this->getHoursLeft() . PHP_EOL;
		if (isset($this->currentTask) && $this->getCurrentTask() instanceof  Task){			
		echo "Current task: "  . $this->getCurrentTask()->getName() . PHP_EOL;
		echo "Complete task in: " . $this->getCurrentTask()->getHoursLeft();
		}else{
			echo 'No current task';
		}		
		echo PHP_EOL, PHP_EOL;
	}
}

