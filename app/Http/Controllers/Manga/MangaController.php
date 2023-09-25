<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MangaController extends Controller
{
   public function getMangaData() 
   {
    $client = new Client();
    $res = $client->request('GET', 'https://api.consumet.org/anime/gogoanime/top-airing');

    if($res->getStatusCode() == 200) {
        $data = $res->getBody();
        echo $data; exit;
       return view('welcome', $data);
    } else {
       return view('error');
    }
 
    // return view('welcome');
   }
}
