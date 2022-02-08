<?php

namespace App\Repositories;

use App\Models\Reply;
use App\Repositories\BaseRepository;

/**
 * Class ReplyRepository
 * @package App\Repositories
 * @version February 8, 2022, 7:09 am UTC
*/

class ReplyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
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
    public function model()
    {
        return Reply::class;
    }
}
