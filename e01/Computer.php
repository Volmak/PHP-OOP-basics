<?php

namespace e01;

class Computer
{
	private $year;
	private $price;
	private $isNotebook;
	private $hardDiskMemory;
	private $freeMemory;
	private $operationSystem;
	
	public function __construct
	(int $year,float $price,bool $isNotebook, $hardDiskMemory, $freeMemory, $operationSystem)
	{
		$this->year = $year;
		$this->price = $price;
		$this->isNotebook = $isNotebook;
		$this->hardDiskMemory = $hardDiskMemory;
		$this->freeMemory = $freeMemory;
		$this->operationSystem = $operationSystem;
	}

	public function getInfo ()
	{
print "
Year: $this->year
Price: $this->price
Notebook: " . json_encode($this->isNotebook). "
HDD: $this->hardDiskMemory
Free memory: $this->freeMemory
OS: " . json_encode($this->operationSystem) . PHP_EOL;
	}
	
	public function changeOperationSystem($newOperationSystem)
	{
		$this->operationSystem = $newOperationSystem;
	}
	public function useMemory($memory)
	{
		if($memory < $this->freeMemory){			
			$this->freeMemory = $memory;
// 			return "Operation sucessful";
		} else {
			return "Not enough free memory!";
// 			echo "Not enough free memory!";
		}
	}
}					