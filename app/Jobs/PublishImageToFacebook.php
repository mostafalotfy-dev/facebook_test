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
use Facebook\FileUpload\FacebookFile;
use Sdks\Facebook\FacebookAlbum\Album;
class PublishImageToFacebook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $group;
    private $token;
    private $album;
    private $provider;
    private $helper;
    private $id;
    private $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id,$path)
    {
        $this->token = "EAAWR0tDd8jgBAMSNH5PpZC3gkM9BW57VVyFRswHBrVF9ZAYtZC6Gr2r6O4WMlsbT68V9NVnVCOctsSEJ6Wg5Rb0Qe1ahu9rhWCb3HPL9wMkByLB1EC9xIaCgdFhGfFNDnIUZARIcZAlAXJ3pAbqlQNUpDe9NUUApOJKvD0ZAQSkQv1kzT07odpoYu0EMEAkPEVdmPZC7n4mXAZDZD";
        $this->id = $id;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Facebook $facebook)
    {
        $this->provider = new ProviderRepository($facebook);
        $this->album = new Album($facebook);
        $this->addPhotosToAlbum($this->id,$this->path);
        
    }
   
    private function addPhotosToAlbum($id, $fileName)
    {
        $album = $this->album;
        $album
        ->uploadPhotoToAlbum($id,public_path("$fileName")
        ,$this->token);
       
    }
}
