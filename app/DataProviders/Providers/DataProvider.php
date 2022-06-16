<?php

namespace App\DataProviders\Providers;

class DataProvider
{
	protected $userData;

	public function __construct($userData)
	{
		$this->userData = $userData;
	}
}
