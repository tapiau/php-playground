<?php
/**
 * Created by PhpStorm.
 * User: zibi
 * Date: 2018-03-13
 * Time: 12:42
 */

class FFT
{
	public $sampleList = null;

	public $weightList = [];

	public function __construct($sampleList)
	{
		$this->sampleList = $sampleList;
	}

	public function calcWeight($freq)
	{
		$modConst = $freq*2*M_PI;

		return array_reduce(
			$this->sampleList->sampleList,
			function($state,$item) use ($modConst)
			{
				return [
					'sum'=> $state['sum']+cos($modConst*$state['count']/$this->sampleList->sampleRate)*$item,
					'count'=>$state['count']+1
				];
			},
			[
				'sum'=>0,
				'count'=>0
			]
		)['sum'];

	}

	public function normalizeWeightList()
	{

	}
}