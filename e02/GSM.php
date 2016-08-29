<?php

namespace e02;

class GSM
{
	const REGEX_GSM = "/^((\+359|0)[\-\s]?8[7-9]\d[\-\/\s\\\s]?\d\d[\-\s]?\d[\-\s]?\d[\-\s]?\d\d)$/";
	const REGEX_TIME = "/^[0-5]?\d([:\,.\|\-][0-5]\d)?$/";
	
	private $model;
	private $hasSimCard;
	private $simMobileNumber;
	private $outgoingCallsDuration;
	private $lastIncomingCall;
	private $lastOutgoingCall;
	
	public function __construct($model)
	{
		$this->model = $model;
		$this->hasSimCard = false;
		$this->outgoingCallsDuration = 0;
	}
	
	public function getModel()
	{
		return $this->model;
	}
	
	public function getHasSimCard($asString = true)
	{
		if ($asString){
			return $this->hasSimCard ? 'Has a SIM Card' : "Doesn't have a SIM Card";
		}
		return $this->hasSimCard;
	}
	
	public function getSimMobileNumber() 
	{
		return $this->simMobileNumber;
	}
	
	public function getLastIncomingCall()
	{
		if (isset($this->lastIncomingCall)) {
			return $this->lastIncomingCall;
		}
		return 'No received calls!';
	}
	
	public function setLastIncomingCall(Call $call)
	{
		$this->lastIncomingCall = $call;
	}
	
	public function getLastOutgoingCall()
	{
		if(!isset($this->lastOutgoingCall)){
			return 'No outgoing calls!';
		}
		return $this->lastOutgoingCall;
	}
	
	public function setLastOutgoingCall(Call $call)
	{
		$this->lastOutgoingCall = $call;
	}
	
	public function getOutgoingCallsDuration(bool $inMinutes = true)
	{
		if($inMinutes){
			return $this->outgoingCallsDuration < 3600 ? 
				date("i:s", $this->outgoingCallsDuration):
				date("G:i:s", $this->outgoingCallsDuration - 3600);
		}
		return $this->outgoingCallsDuration;
	}
	
	public function addOutgoingCallsDuration($duration)
	{
		$array = explode(':', $duration);
		$dur = 0;
		foreach ($array as $key=>$value) {
			$dur += $value * pow(60, count($array) - 1 - $key);
		}
		$this->outgoingCallsDuration += $dur;
	}
	
	public function insertSimCard($simMobileNumber)
	{
		if (preg_match($this::REGEX_GSM, $simMobileNumber)){
			$this->hasSimCard = true;
			$this->simMobileNumber = $simMobileNumber;
		}
	}
	
	public function removeSimCard()
	{
		$this->hasSimCard = false;
		unset($this->simMobileNumber);
	}
	
	public function receiveCall($call)
	{
		$this->setLastIncomingCall($call);
	}
	
	public function call(GSM $receiver, $duration, &$error = '')
	{
		if (!($receiver->hasSimCard)){
			return $error = "Receiver has no valid SIM card!";
		}
		if(!($this->hasSimCard)){
			return $error = "No SIM card detected!";
		}
		if (!(preg_match($this::REGEX_TIME, $duration))){
			return $error = "Invalid duration!";
		}
		if ($receiver->simMobileNumber == $this->simMobileNumber){
			return $error = "You can't call yourself!";
		}
		$error='';
		$duration = str_replace([',',':','.','|','-'], ':', $duration);
		$call = new \e02\Call($this, $receiver, $duration);
		$this->setLastOutgoingCall($call);
		$this->addOutgoingCallsDuration($duration);
		$receiver->receiveCall($call);
	}
							
	public function getSumForCalls()
	{
		return Call::$priceForAMinute ?
		$this->getOutgoingCallsDuration(false) * Call::$priceForAMinute / 60:
		"The price for calls has not been set!";
	}
	
	public function printInfoForTheLastOutgoingCall()
	{
		$call = $this->getLastOutgoingCall();
		if (is_string($call)){
			echo 'No outgoing calls!';
			return;
		}
		$call->printFullInfo();
	}

	public function printInfoForTheLastIncomingCall()
	{
		$call = $this->getLastIncomingCall();
		if (is_string($call)){
			echo 'No received calls!';
			return;
		}
		$call->printFullInfo();
	}
	
	public function getInfo()
	{
		return [
				$this->getModel(),
				$this->getHasSimCard(),
				$this->getSimMobileNumber(),
				'Time talking: ' . $this->getOutgoingCallsDuration(),
				'Bill: ' . $this->getSumForCalls()
		];
	}
}