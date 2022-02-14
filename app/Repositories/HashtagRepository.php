<?php

namespace App\Repositories;



/**
 * Class FollowingRepository
 * @package App\Repositories
 * @version February 8, 2022, 9:29 am UTC
*/

class HashtagRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
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
        return "hashtags";
    }
}
