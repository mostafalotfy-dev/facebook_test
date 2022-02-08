<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\BaseRepository;


/**
 * Class AdminRepository
 * @package App\Repositories
 * @version February 7, 2022, 10:19 am UTC
*/

class AdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'avatar'
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
        return Admin::class;
    }
}
