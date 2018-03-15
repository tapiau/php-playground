<?php
/**
 * Created by PhpStorm.
 * User: zibi
 * Date: 2018-03-13
 * Time: 13:15
 */

class SampleList
{
	public $sampleRate = 0;
	public $sampleList = [];
	public $timeStart = 0;
	public $timeLen = 0;
	public $input = null;

	public function __construct($sampleRate,$timeStart,$timeLen,Input $input)
	{
		$this->sampleRate = $sampleRate;
		$this->timeStart = $timeStart;
		$this->timeLen = $timeLen;
		$this->input = $input;

		$this->sampleList = $input->sampleList($sampleRate,$timeStart,$timeLen);
	}
}
