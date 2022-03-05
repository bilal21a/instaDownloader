<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zeeshan\Instagrab\Grabber;
use AnyDownloader\DownloadManager\Model\URL;
use AnyDownloader\InstagramDownloader\InstagramHandler;
use Goutte\Client;

class InstaController extends Controller
{
    public function zeeshan()
    {
        $grabber = new Grabber('https://www.instagram.com/reel/CauXZ67AbJ9/?utm_source=ig_web_copy_link');
        dd($grabber->getDownloadUrl());
        $grabber->download();


    }
    public function index()
    {
        $instagramPostUrl = URL::fromString('https://www.instagram.com/tv/CascjxOoJLY/?utm_source=ig_web_copy_link');
        $instagramHandler = new InstagramHandler(new Client());
        $result = $instagramHandler->fetchResource($instagramPostUrl);

        
        // dd($result->toArray()["preview_image"]["url"]);
        $kuch_b= $result->toArray()["preview_video"]["url"];
        $filename = 'temp-image.mp4';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($kuch_b, $tempImage);

        return response()->download($tempImage, $filename);



    }
}
