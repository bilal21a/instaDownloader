<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zeeshan\Instagrab\Grabber;
use AnyDownloader\DownloadManager\Model\URL;
use AnyDownloader\InstagramDownloader\InstagramHandler;
use AnyDownloader\YouTubeDownloader\YouTubeHandler;
use Symfony\Component\HttpClient\HttpClient;
use AnyDownloader\DownloadManager\DownloadManager;


use Goutte\Client;

class InstaController extends Controller
{
    public function indexOld(Request $request)
    {
        $downloader = new Downloader(FFMPEG_PATH, YOUTUBE-DL_PATH);

       $path = '/aboslute/path/to/directory';
       $downloader->setOutputPath($path);


       try {
    $downloader->download($request-> url);
} catch (Exception $exception) {
    echo $exception->getMessage();
}



    }
    public function index(Request $request)
    {  
      
ini_set('max_execution_time', 300); //3 minutes


        $file_url=$request->url;

        // youtube
        $httpClient = HttpClient::create();

        $youtubeHandler = new YouTubeHandler($httpClient);
        $res = $youtubeHandler->fetchResource(URL::fromString($file_url));

        //    dd($res->toArray());




// INSTAGRAM
        // $instagramPostUrl = URL::fromString($file_url);
        // $instagramHandler = new InstagramHandler(new Client());
        // $result = $instagramHandler->fetchResource($instagramPostUrl);


        // dd($result);

        
        // dd($result->toArray()["preview_image"]["url"]);
        $new_url= $res->toArray()["preview_video"]["url"];
        $filename = 'temp-image.mp4';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($new_url, $tempImage);

        return response()->download($tempImage, $filename);



    }
    public function videoDownloader()
    {
        return view('index');
    }
}
