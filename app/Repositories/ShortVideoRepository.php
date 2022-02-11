<?php

namespace App\Repositories;

use App\Models\ShortVideo;
use App\Repositories\DBBaseRepository;

/**
 * Class ShortVideoRepository
 * @package App\Repositories
 * @version February 8, 2022, 7:36 am UTC
*/

class ShortVideoRepository extends DBBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'view_count',
        'user_id'
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
        return "short_videos";
    }
}
