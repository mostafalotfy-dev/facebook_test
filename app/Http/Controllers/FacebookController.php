<?php

namespace App\Http\Controllers;

use App\Jobs\PublishImageToFacebook;

use App\Jobs\PublishVideoToFacebook;

use Facebook\Facebook;
use Facebook\FileUpload\FacebookFile;
use Sdks\Facebook\FacebookAlbum\Album;
use Sdks\Facebook\Group;
use Facebook\FileUpload\FacebookVideo;

class FacebookController extends Controller
{

    private $fb;
    private $token;
    public function __construct(Facebook $facebook)
    {
        $this->token = "EAAWR0tDd8jgBACB5WImcn7jPGLAbYfZARt3mDyoiSjgq2SwZBfJ2At5ueFlRRJQGZAVKjX4X9ZAdhI8i1gkVkz3GTqE1CDgId8Aw9zse6VpcDEp5PIegcM0Yeqb9NH1ApV5iNtwLzfVhZAp13xUsZBOixIz0uAXJcTTnQy0u3YSEmnXHfIi32OskzxkSxRBUQdbDEu29UZB5cV9V8pHYWQ7Sz43Po0D3iAfWt5PoZCv1jCtCIzPwKc5F";
        $this->fb = $facebook;
        $this->group = new Group($facebook);
    }
    public function index()
    {
        $permissions = [
            "email",
            "groups_access_member_info",
            "public_profile",
            "publish_to_groups"
        ];
       
        if (request("code")) {
            $this->helper->getPersistentDataHandler()->set("state", request("state"));
            $accessToken = $this->helper->getAccessToken("http://localhost:8000");
            dd($accessToken);
        }
        return view("facebook", compact("url"));
    }

    public function form()
    {

        return view("form");
    }
    public function postForm($groupId)
    {

        $group = $this->group;
        $groupResponse = $group->createAlbum($groupId, [
            "name" => request("name"),
            "message" => request("message"),
            "privacy_message" => "open"
        ], $this->token);
        $groupGraphNode = $groupResponse->getGraphNode();

        return redirect()->route("create.album", $groupGraphNode->getField("id"));
    }
    public function addPhotos($albumId)
    {
        $fileName = request()->file("file")->getClientOriginalName();
        request()->file("file")->storeAs("public", $fileName);
        $album = new Album($this->fb);
        $album
            ->addPhotoToAlbum($albumId, [
                "source" => new FacebookFile(public_path("storage/$fileName")),
            ], $this->token);



        return response()->json([
            "status" => 200
        ]);
    }
    public function createVideo($groupId)
    {
        return view("group.form",compact("groupId"));
    }
    public function addVideoToGroup($groupId)
    {
        ini_set('set_time_limit',-1);
        $group= new Group($this->fb);
        $fileName= request()->file("file")->getClientOriginalName();
        $filePath = public_path("storage/$fileName");
        request()->file("file")->move("storage",$fileName);
        $group
        ->addVideo($groupId,$filePath,[
            "title"=> request("title"),
            "description"=> request("description")
        ],$this->token);
        return back();
    }
    
    public function album($albumId)
    {

        return view("album.form", compact("albumId"));
    }
}
