<?php

namespace e02;

class Call
{
	static $priceForAMinute;
	private $caller;
	private $receiver;
	private $duration;
	
	public function __construct(GSM $caller,GSM $receiver,$duration)
	{
		$this->caller = $caller;
		$this->receiver = $receiver;
		$this->duration = $duration;
// 		$this->isValid($this->caller, $this->receiver, $this->duration);
	}
	
	private function isValid($caller, $receiver, $dur)
	{
		if (preg_match("/^\d*[:,.\|\-][1-5]\d/", $dur) ||
			preg_match("/((\+359|0)[\-\s]?8[7-9]\d[\-\/\s\\\s]?\d\d[\-\s]?\d[\-\s]?\d[\-\s]?\d\d)/", $caller)||
			preg_match("/((\+359|0)[\-\s]?8[7-9]\d[\-\/\s\\\s]?\d\d[\-\s]?\d[\-\s]?\d[\-\s]?\d\d)/", $receiver)){
			
			throw new \Exception("Invalid input!");
		}
	}
	
	public function getCaller()
	{
		return $this->caller;
	}
	
	public function setCaller($caller)
	{
		$this->caller = $caller;
	}
	
	public function getReceiver()
	{
		return $this->receiver;
	}
	
	public function setReceiver($receiver)
	{
		$this->receiver = $receiver;
	}
	
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}
	
	public function getDuration()
	{
		return $this->duration;
	}
	
	public function setPriceForAMinute($priceForAMinute)
	{
		$this::$priceForAMinute = $priceForAMinute;
	}
	
	public function getPriceForAMinute()
	{
		return $this->priceForAMinute;
	}
	
	public function printFullInfo()
	{
		$caller = $this->getCaller();
		$receiver = $this->getReceiver();
		echo
		'Caller:' . PHP_EOL .
		implode(PHP_EOL, $caller->getInfo()) .
		PHP_EOL . 'Receiver:' . PHP_EOL .
		implode(PHP_EOL, $receiver->getInfo()) .
		PHP_EOL . "The duration of the call was " .
		$this->getDuration() . "minutes" . PHP_EOL . PHP_EOL;
	}
}