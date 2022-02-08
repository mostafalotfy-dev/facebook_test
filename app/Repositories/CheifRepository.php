<?php

namespace App\Repositories;

use App\Models\Cheif;
use App\Repositories\BaseRepository;

/**
 * Class CheifRepository
 * @package App\Repositories
 * @version February 8, 2022, 7:51 am UTC
*/

class CheifRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'phone_number',
        'email',
        'phone_number_verified_at',
        'password',
        'avatar',
        'provider_id',
        'provider_token',
        'provider_name',
        'identity',
        'youtube_channel',
        'facebook_link',
        'description',
        'user_ip',
        'udid',
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
    public function model()
    {
        return Cheif::class;
    }
}
