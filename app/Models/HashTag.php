<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="HashTag",
 *      required={"title", "user_id", "postable_type", "postable_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="postable_type",
 *          description="postable_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="postable_id",
 *          description="postable_id",
 *          type="integer",
 *          format="int32"
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
class HashTag extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'hashtags';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'user_id',
        'postable_type',
        'postable_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'user_id' => 'integer',
        'postable_type' => 'string',
        'postable_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'user_id' => 'required',
        'postable_type' => 'required|string|max:255',
        'postable_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class,"recipe_hashtag");
    }
    
}
