<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\BaseRepository;

/**
 * Class RecipeRepository
 * @package App\Repositories
 * @version February 9, 2022, 11:32 am UTC
*/

class RecipeRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
        'title',
        'description',
        'user_id',
        'category_id',
        'people_count',
        'cooking_time'
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
        return "recipes";
    }

    public function joinUsers()
    {
        return $this->table->join("users","recipes.user_id","=","users.id");
    }
}
