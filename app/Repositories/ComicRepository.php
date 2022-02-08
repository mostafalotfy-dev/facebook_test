<?php

namespace App\Repositories;

use App\Models\Comic;
use App\Repositories\BaseRepository;

/**
 * Class ComicRepository
 * @package App\Repositories
 * @version February 8, 2022, 12:12 pm UTC
*/

class ComicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
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
        return Comic::class;
    }
}