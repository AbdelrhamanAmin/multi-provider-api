<?php

namespace App\Services;

use App\Models\User;

class UserService{

    /**
     * getUsers
     * apply filter based on filter criteria
     * @param array $filterCriteria
     * @return users
     */
    public function getUsers(array $filterCriteria)
    {
        $query = User::query();
        if (isset($filterCriteria['provider'])) {
            $query->where('data_provider', '=', $filterCriteria['provider']);
        }
        if(isset($filterCriteria['balanceMin']) && isset($filterCriteria['balanceMax'])) {
            $query->whereBetween('amount', [$filterCriteria['balanceMin'], $filterCriteria['balanceMax']]);
        }
        if(isset($filterCriteria['currency'])) {
            $query->where('currency', '=', $filterCriteria['currency']);
        }
        if(isset($filterCriteria['status'])) {
            $query->where('status_code', '=', $filterCriteria['status']);
        }
        return $query->get();
    }
}
