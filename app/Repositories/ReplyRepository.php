<?php

namespace App\Repositories;


use App\Repositories\DBBaseRepository;

/**
 * Class ReplyRepository
 * @package App\Repositories
 * @version February 8, 2022, 7:09 am UTC
*/

class ReplyRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
        'comment_id',
        'description'
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
        return "comment_replies";
    }
}
