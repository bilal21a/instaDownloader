<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zeeshan\Instagrab\Grabber;
use AnyDownloader\DownloadManager\Model\URL;
use AnyDownloader\InstagramDownloader\InstagramHandler;
use AnyDownloader\YouTubeDownloader\YouTubeHandler;
use Symfony\Component\HttpClient\HttpClient;
use Goutte\Client;

class InstaController extends Controller
{
    public function zeeshan()
    {
        $grabber = new Grabber('https://www.instagram.com/reel/CauXZ67AbJ9/?utm_source=ig_web_copy_link');
        dd($grabber->getDownloadUrl());
        $grabber->download();


    }
    public function insta_save(Request $request)
    {
        ini_set('max_execution_time', 300); //3 minutes
        $file_url=$request->url;
        $instagramPostUrl = URL::fromString($file_url);
        $instagramHandler = new InstagramHandler(new Client());
        $result = $instagramHandler->fetchResource($instagramPostUrl);
            // Downloading proccesssing
        $kuch_b= $result->toArray()["preview_video"]["url"];
        $filename = 'temp-image.mp4';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($kuch_b, $tempImage);

        return response()->download($tempImage, $filename);
    }
    public function youtube_save(Request $request)
    {
        ini_set('max_execution_time', 300); //3 minutes
        $file_url=$request->url;
        $httpClient = HttpClient::create();

        $youtubeHandler = new YouTubeHandler($httpClient);
        $res = $youtubeHandler->fetchResource(URL::fromString($file_url));
            // Downloading proccesssing
        $kuch_b= $res->toArray()["preview_video"]["url"];
        $filename = 'temp-image.mp4';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($kuch_b, $tempImage);

        return response()->download($tempImage, $filename);
    }
    public function index()
    {
        return view('index');
    }
}
