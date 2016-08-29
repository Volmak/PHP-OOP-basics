<?php

namespace e03;

class Task
{
	private $name;
	private $workingHours;
	private $hoursLeft;
	
	public function __construct(string$name, float$hours)
	{
		$this->name = $name;
		$this->workingHours = $hours;
		$this->hoursLeft = $hours;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName(string$name)
	{
		$this->name = $name;
	}
	
	public function getWorkingHours()
	{
		return $this->workingHours;
	}
	
	public function setWorkingHours(float$workingHours)
	{
		$this->workingHours = $workingHours;
	}
	
	public function getHoursLeft()
	{
		return $this->hoursLeft;
	}
	
	public function work(float$hours)
	{
		if($this->hoursLeft > $hours){
			$this->hoursLeft -= $hours;
			return 0;
		}
		$result = $hours - $this->hoursLeft;
		$this->hoursLeft = 0;
		return $result;
	}
	
	public function showReport()
	{
		echo "Current task: "  . $this->getName() . PHP_EOL;
		echo "Complete task in: " . $tis->getHoursLeft() . PHP_EOL;
	}
}