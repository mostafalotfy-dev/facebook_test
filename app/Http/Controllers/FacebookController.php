<?php

namespace App\Http\Controllers;

use App\Jobs\PublishImageToFacebook;

use App\Jobs\PublishVideoToFacebook;

use Facebook\Facebook;
use Sdks\Facebook\Group;


class FacebookController extends Controller
{
   
    
    public function __construct(Facebook $facebook)
    {
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
        $url = $this->helper->getLoginUrl("http://localhost:8000",$permissions);
        if(request("code"))
        {
            $this->helper->getPersistentDataHandler()->set("state",request("state"));
            $accessToken = $this->helper->getAccessToken("http://localhost:8000");
            dd($accessToken);
        }
        return view("facebook",compact("url"));
    }

    public function form()
    {

        return view("form");
    }
    public function postForm($groupId)
    {
      
        $group = $this->group;
        $groupResponse = $group->createAlbum($groupId,[
            "name" => request("name"),
            "message"=>request("message"),
            "privacy_message"=>"open"
        ],$this->token);
        $groupGraphNode = $groupResponse->getGraphNode();
      
        return redirect()->route("create.album",$groupGraphNode->getField("id"));
    }
    public function addPhotos($albumId)
    {
        $fileName = request()->file("file")->getClientOriginalName();
        request()->file("file")->storeAs("public",$fileName);
        $mimeType = request()->file("file")->getMimeType();
        
        if(substr($mimeType,0,4) == "image")
        {
            dispatch(new PublishImageToFacebook($albumId,"storage/$fileName"));
        }elseif(substr($mimeType,0,5) == "video")
        {
            var_dump("video");
           dispatch(new PublishVideoToFacebook($albumId,"storage/$fileName"));
        }
   
        
        return response()->json([
            "status"=> 200
        ]);

    }
 
    public function code()
    {
      
        $this->helper->getPersistentDataHandler()->set("state",request("state"));
        $this->helper->getAccessToken();
       
      
        // return redirect()->to("/");
    }
    public function album($albumId)
    {
       
        return view("album.form",compact("albumId"));
    }
}
