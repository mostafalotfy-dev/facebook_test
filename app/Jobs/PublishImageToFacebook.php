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
        $this->token = "EAAWR0tDd8jgBAPtbV9zZBYTrPByjRucwpsYpSUBPuZAQaMFxAX4L3Ri8YqZBRL56wDs473iEHOpHr8w2WewMXxfq1dY9IICVWZCXgrlJQKt7UKhKh1ZBoE080E709ODOOSzg2580HAA35tnOkt5v8xIdhJ5djs18wl3sRKKFDtR9ZBp9ZBimuAXRMDrp4piUu4naB3HbZCMyEizlZCmwaCfDSW3I8zubfloQ0j9KnZBA4INOqhhiZCuEsCR";
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
        ->addToAlbum($id,[
            "source"=> new FacebookFile(public_path($this->path)),
        ],$this->token);
       
    }
}
