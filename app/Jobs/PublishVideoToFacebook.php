<?php

namespace App\Jobs;

use Facebook\Facebook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sdks\Facebook\ProviderRepository;

use Sdks\Facebook\FacebookAlbum\Album;
use Facebook\FileUpload\FacebookVideo;
use Sdks\Facebook\Group;
use Throwable;

class PublishVideoToFacebook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $group;
    private $metadata;
    private $id;
    private $path;
    private $token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $id,$path,$metadata)
    {
        $this->token = "EAAWR0tDd8jgBADOXgDmZB1jYYwTJfnoPnTNDxlHa2K9VuedIHvIhuKWEoo9VFzvnCOFvA1FZAfVul5PSqO5DNpqk4urDh5aZAwAynxHPZBCZAXFZCTF1gkPCAVG7C3bAATxxUmscncMHZCuveIZAXuFsNiZB7ZCQA7toxNRVVBEG2nuh9UzBXUFsRKH5UsdJHVsZBqJvOV2Kuzc1gZDZD";
        $this->id = $id;
        $this->path = $path;
        $this->metadata = $metadata;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Facebook $facebook)
    {
        $group = new Group($facebook);
        $group
        ->addVideo($this->id,$this->path,
        $this->metadata,$this->token);
        
    }
   
   
    public function failed(Throwable $e)
    {
        var_dump($e->getMessage());
    }
}
