<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DataSourceService{

    /**
     * importDataSourceToDB function
     *
     * @param string $dataSourceFileName
     * @param string $provider
     * @return void
     */
    public function importDataSourceToDB(string $dataSourceFileName, string $provider)
    {
        if (!file_exists(public_path('DataSource/' . $dataSourceFileName))) throw new \Exception("File ".$dataSourceFileName." Not Found", 404);
        $jsonObj = file_get_contents(public_path('DataSource/' . $dataSourceFileName));
        $users = json_decode($jsonObj)->users;
        $provider = "\App\DataProviders\Providers\\$provider";
        DB::transaction(function () use ($users, $provider){
            foreach ($users as $user) {
                $dataProvider = new $provider($user);
                    User::insert(collect($dataProvider->serialize())->toArray());
                }
        });
    }
}
