<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\DBBaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version February 7, 2022, 1:07 pm UTC
*/

class CategoryRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_en',
        'name_ar',
        'image',
        'created_by',
        'updated_by'
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
        return "categories";
    }
}
