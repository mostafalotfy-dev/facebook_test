<?php

namespace App\Repositories;



/**
 * Class RoleRepository
 * @package App\Repositories
 * @version February 11, 2022, 5:04 pm UTC
*/

class RoleRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
       
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
        return "roles";
    }
}
