<?php

namespace App\DataProviders\Providers;

use Carbon\Carbon;
use App\Constants\DataSource;
use App\DataProviders\DTO\User as DTOUser;
use App\DataProviders\Providers\DataProvider;
use App\DataProviders\Providers\DataProviderInterface;

class DataProviderX extends DataProvider implements DataProviderInterface
{
	const STATUS_CODES = [
		1 => 'authorised',
		2 => 'declined',
		3 => 'refunded',
	];

	public function serialize(): DTOUser
	{
        $user = new DTOUser;
        $user->data_provider_id = $this->userData->parentIdentification;
        $user->data_provider = DataSource::DATA_PROVIDER_X;
        $user->amount = $this->userData->parentAmount;
        $user->currency = $this->userData->Currency;
        $user->email = $this->userData->parentEmail;
        $user->status_code = self::STATUS_CODES[$this->userData->statusCode];
        $user->created_at = Carbon::createFromFormat('Y-m-d', $this->userData->registerationDate)->toDateTime();
        return $user;
	}
}
