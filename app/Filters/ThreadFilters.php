<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];
    /**
     * @param $username
     * @return mixed
     */
    protected function by ( $username )
    {
        $userId = User::whereName( $username )->firstOrFail()->id;
        return $this->builder->where( 'user_id', $userId );
    }

    protected function popular() {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
