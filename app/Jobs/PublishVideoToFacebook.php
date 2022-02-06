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
        $this->token = $token ?: "EAAWR0tDd8jgBAMSNH5PpZC3gkM9BW57VVyFRswHBrVF9ZAYtZC6Gr2r6O4WMlsbT68V9NVnVCOctsSEJ6Wg5Rb0Qe1ahu9rhWCb3HPL9wMkByLB1EC9xIaCgdFhGfFNDnIUZARIcZAlAXJ3pAbqlQNUpDe9NUUApOJKvD0ZAQSkQv1kzT07odpoYu0EMEAkPEVdmPZC7n4mXAZDZD";
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
