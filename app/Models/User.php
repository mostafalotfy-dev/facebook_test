<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"name", "phone_number", "password", "verify_number", "avatar", "user_ip"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone_number",
 *          description="phone_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone_number_verified_at",
 *          description="phone_number_verified_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="verify_number",
 *          description="verify_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="avatar",
 *          description="avatar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="provider_id",
 *          description="provider_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="provider_token",
 *          description="provider_token",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="provider_name",
 *          description="provider_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_ip",
 *          description="user_ip",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="remember_token",
 *          description="remember_token",
 *          type="string"
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
class User extends Authenticatable{
    use SoftDeletes,HasRoles,HasApiTokens;

    use HasFactory;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'phone_number',
        'phone_number_verified_at',
        'password',
        'verify_number',
        'avatar',
        'provider_id',
        'provider_token',
        'provider_name',
        'description',
        'user_ip',
        'remember_token'
    ];
    public function getSearchResult(): SearchResult
    {

    }
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'phone_number' => 'string',
        'phone_number_verified_at' => 'datetime',
        'password' => 'string',
        'verify_number' => 'string',
        'avatar' => 'string',
        'provider_id' => 'integer',
        'provider_token' => 'string',
        'provider_name' => 'string',
        'description' => 'string',
        'user_ip' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'phone_number_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'verify_number' => 'string|min:4',
        'avatar' => 'required|string|max:255',
        'provider_id' => 'nullable|integer',
        'provider_token' => 'nullable|string|max:255',
        'provider_name' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'user_ip' => 'string|max:45',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function banneds()
    {
        return $this->hasMany(\App\Models\Banned::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bookamrkVideos()
    {
        return $this->hasMany(\App\Models\BookamrkVideo::class);
    }

    

  

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comics()
    {
        return $this->hasMany(\App\Models\Comic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function expriments()
    {
        return $this->hasMany(\App\Models\Expriment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function followers()
    {
        return $this->hasMany(\App\Models\Follower::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function followings()
    {
        return $this->hasMany(\App\Models\Following::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hashtags()
    {
        return $this->hasMany(\App\Models\Hashtag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function recipes()
    {
        return $this->hasMany(\App\Models\Recipe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function shortVideos()
    {
        return $this->hasMany(\App\Models\ShortVideo::class);
    }

   
}
