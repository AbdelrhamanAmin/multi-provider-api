<?php

namespace App\DataProviders\Providers;

use Carbon\Carbon;
use App\Constants\DataSource;
use App\DataProviders\DTO\User as DTOUser;
use App\DataProviders\Providers\DataProvider;
use App\DataProviders\Providers\DataProviderInterface;

class DataProviderY extends DataProvider implements DataProviderInterface
{
	const STATUS_CODES = [
		100 => 'authorised',
		200 => 'declined',
		300 => 'refunded',
	];

	public function serialize(): DTOUser
	{
        $user = new DTOUser;
        $user->data_provider = DataSource::DATA_PROVIDER_Y;
        $user->data_provider_id = $this->userData->id;
        $user->amount = $this->userData->balance;
        $user->currency = $this->userData->currency;
        $user->email = $this->userData->email;
        $user->status_code = self::STATUS_CODES[$this->userData->status];
        $user->created_at = Carbon::createFromFormat('m/d/Y', $this->userData->created_at)->toDateTime();
        return $user;
	}
}
