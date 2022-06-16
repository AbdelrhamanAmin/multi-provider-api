<?php

namespace App\Http\Controllers\API;

use App\Constants\DataSource;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Services\DataSourceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetUsersRequest;

class UserController extends Controller
{
    use ResponseTrait;

    private $userService;
    private $dataSourceService;


    public function __construct(UserService $userService, DataSourceService $dataSourceService)
    {
    	$this->userService = $userService;
    	$this->dataSourceService = $dataSourceService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetUsersRequest $request)
    {
        $users = $this->userService->getUsers($request->validated());
        return $this->success(null, Response::HTTP_OK, $users);

    }

    /**
     * Import function
     * Import data from dataProvider JSON file into database
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        try {
            /*you can add data source here*/
            $this->dataSourceService->importDataSourceToDB('DataProviderX.json', DataSource::DATA_PROVIDER_X);
            $this->dataSourceService->importDataSourceToDB('DataProviderY.json', DataSource::DATA_PROVIDER_Y);
            return $this->success('Data Imported Successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

}
