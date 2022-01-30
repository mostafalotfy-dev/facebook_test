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
    public function __construct(string $id,string $path,array $metadata,?string $token = null)
    {
        $this->token = $token ?: "EAAWR0tDd8jgBAMPwPj5QXvE5I68BaI4fKIwTpZBG2BWAvWo3Xt0xEUZCQZC6QZB2v1kY5nKfdMmDl0FdYcvIWdo7hwuqBCgCZBBoBQ5HNAPBpgxxlIUCfPllVmZCZB8Jo2RhD7AhcfGi3ZCaZAcZAoJ9dc3Iyimvt79ZAuK75oa8NmvOZBx5giRmszXufvZC2Y1szTfIZCkS2owGEzoAZDZD";
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
