<?php
class Useronline extends LuatAppModel{
	var $name="Useronline";
	private $tgtmp;
	private $ip;
	private $local;

	function setTgtmp($tgtmp){
		$this->tgtmp=$tgtmp;
	}
	function getTgtmp(){
		if(!isset($this->tgtmp)){
			$this->tgtmp="";
		}
		return $this->tgtmp;
	}
	
	function setIp($ip){
		$this->ip=$ip;
	}
	function getIp(){
		if(!isset($this->ip)){
			$this->ip="";
		}
		return $this->ip;
	}
	
	function setLocal($local){
		$this->local=$local;
	}
	function getLocal(){
		if(!isset($this->local)){
			$this->local="";
		}
		return $this->local;
	}
}
?>