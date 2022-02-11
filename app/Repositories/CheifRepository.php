<?php

namespace App\Repositories;

use App\Models\Cheif;
use App\Repositories\DBBaseRepository;

/**
 * Class CheifRepository
 * @package App\Repositories
 * @version February 8, 2022, 7:51 am UTC
*/

class CheifRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'phone_number',
        'email',
        'avatar',
        'provider_id',
        'provider_token',
        'provider_name',
        'identity',
        'youtube_channel',
        'facebook_link',
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
        return "cheifs";
    }
}
