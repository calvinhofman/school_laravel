<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon; // Import Carbon for date handling
use App\Models\Anime;


class MangaController extends Controller
{
  public function getMangaData()
  {
      $client = new Client();
      $res = $client->request('GET', 'https://api.consumet.org/anime/gogoanime/top-airing');
      // $res = Anime::all();
      if ($res->getStatusCode() == 200 || $res) {
          $data = json_decode($res->getBody(), true); // Convert the JSON response to an associative array
  
          if (isset($data['results'])) {
              $results = $data['results'];
              foreach ($results as $result) {
                  $id = Str::uuid(); // Generate a UUID for each record (assuming you want a UUID for each)
  
                  $currentDate = Carbon::now();


                  $genres = implode(', ', $result['genres']); // Assuming 'genres' is an array in your JSON data


                  // Insert data into the 'anime' table
                  DB::table('animes')->insert([
                      'anime_id' => $id,
                      'title' => $result['title'], // Replace with the actual array key for 'title'
                      'link' => $result['url'], // Replace with the actual array key for 'title'
                      'image' => $result['image'], // Replace with the actual array key for 'genre'
                      'genres' => $genres, // Replace with the actual array key for 'genre'
                      'publish_date' => $currentDate, // Replace with the actual array key for 'publish_date'
                  ]);
              }
  
              return view('welcome', ['data' => $results]); // Pass the "results" array to the view
          } else {
              echo 'oof';
          }
      } else {
          return view('error');
      }
  }
  
}
