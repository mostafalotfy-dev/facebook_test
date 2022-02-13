<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Recipe",
 *      required={"view_count", "title", "description", "user_id", "category_id", "people_count", "cooking_time"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="view_count",
 *          description="view_count",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="category_id",
 *          description="category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="people_count",
 *          description="people_count",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cooking_time",
 *          description="cooking_time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Recipe extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recipes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'view_count',
        'title',
        'description',
        'user_id',
        'category_id',
        'people_count',
        'cooking_time'
    ];
  
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'view_count' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'people_count' => 'integer',
        'cooking_time' => 'datetime',
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
     
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'user_id' => 'required',
        'category_id' => 'required',
        'people_count' => 'required',
        'cooking_time' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function hashtags()
    {
        return $this->morphOne(HashTag::class, 'postable')->latestOfMany();
    }
    
}
