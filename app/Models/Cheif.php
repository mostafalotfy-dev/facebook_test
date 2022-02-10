<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @SWG\Definition(
 *      definition="Cheif",
 *      required={"name", "phone_number", "email", "password", "avatar", "identity", "user_ip"},
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
 *          property="email",
 *          description="email",
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
 *          property="identity",
 *          description="identity",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="youtube_channel",
 *          description="youtube_channel",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="facebook_link",
 *          description="facebook_link",
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
 *          property="address",
 *          description="address",
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
class Cheif extends Authenticatable
{
    use SoftDeletes,HasApiTokens;

    use HasFactory;

    public $table = 'cheifs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'phone_number',
        'phone_number_verified_at',
        'password',
        'avatar',
        'provider_id',
        'provider_token',
        'provider_name',
        'identity',
        'youtube_channel',
        'facebook_link',
        'description',
        'user_ip',
        'address',
        "verify_number",
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'phone_number_verified_at' => 'datetime',
        'password' => 'string',
        'avatar' => 'string',
        'provider_id' => 'integer',
        'provider_token' => 'string',
        'provider_name' => 'string',
        'identity' => 'string',
        'youtube_channel' => 'string',
        'facebook_link' => 'string',
        'description' => 'string',
        'user_ip' => 'string',
        'udid' => 'string',
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
        'email' => 'required|string|max:255',
        'phone_number_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'avatar' => 'required|string|max:255',
        'provider_id' => 'nullable|integer',
        'provider_token' => 'nullable|string|max:255',
        'provider_name' => 'nullable|string|max:255',
        'identity' => 'required|string|max:255',
        'youtube_channel' => 'nullable|string|max:255',
        'facebook_link' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'user_ip' => 'required|string|max:45',
        'udid' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function waiting()
    {
        return $this->hasOne(WaitingList::class,"user_id");
    }
    public function recipes()
    {
        return $this->belongsTo(Recipe::class);
    }
    public function following()
    {
        return $this->belongsTo(Following::class);
    }
    public function followers()
    {
        return $this->belongsTo(Follower::class);
    }
}
