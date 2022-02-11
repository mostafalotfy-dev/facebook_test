<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\DBBaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version February 10, 2022, 1:40 pm UTC
*/

class UserRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'phone_number',
        'phone_number_verified_at',
        'password',
        'verify_number',
        'avatar',
        'provider_id',
        'provider_token',
        'provider_name',
        'description',
        'user_ip',
        'remember_token'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function table()
    {
        return "users";
    }
}
