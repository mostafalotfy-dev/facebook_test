<?php

namespace App\Repositories;

use App\Models\HashTag;
use App\Repositories\BaseRepository;

/**
 * Class HashTagRepository
 * @package App\Repositories
 * @version February 8, 2022, 12:56 pm UTC
*/

class HashTagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'user_id',
        'postable_type',
        'postable_id'
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
        return HashTag::class;
    }
}
