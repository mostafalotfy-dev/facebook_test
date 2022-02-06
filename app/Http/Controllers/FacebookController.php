<?php

namespace App\Http\Controllers;

use App\Jobs\PublishImageToFacebook;

use App\Jobs\PublishVideoToFacebook;
use Exception;
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
        $this->token = "EAAWR0tDd8jgBAMSNH5PpZC3gkM9BW57VVyFRswHBrVF9ZAYtZC6Gr2r6O4WMlsbT68V9NVnVCOctsSEJ6Wg5Rb0Qe1ahu9rhWCb3HPL9wMkByLB1EC9xIaCgdFhGfFNDnIUZARIcZAlAXJ3pAbqlQNUpDe9NUUApOJKvD0ZAQSkQv1kzT07odpoYu0EMEAkPEVdmPZC7n4mXAZDZD";
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
        $fileName = uniqid(). request()->file("file")->getClientOriginalName();
        request()->file("file")->move("storage", $fileName);
        $album = new Album($this->fb);

        dispatch(new PublishImageToFacebook($albumId, "storage/$fileName"));


        return response()->json([
            "status" => 200
        ]);
    }
    public function createVideo($groupId)
    {
        return view("group.form", compact("groupId"));
    }
    public function addVideoToGroup($groupId)
    {
        ini_set('default_socket_timeout', 100);
        $group = new Group($this->fb);
        $fileName = request()->file("file")->getClientOriginalName();
        $filePath = public_path("storage/$fileName");
        request()->file("file")->move("storage", $fileName);
        dispatch(new PublishVideoToFacebook($groupId, $filePath, [
            "title" => request("title"),
            "description" => request("description")
        ],$this->token));
        return back();
    }

    public function album($albumId)
    {

        return view("album.form", compact("albumId"));
    }
}
