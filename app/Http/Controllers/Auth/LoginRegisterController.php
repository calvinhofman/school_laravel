<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon; // Import Carbon for date handling

class LoginRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80',
            'password' => 'required|min:4|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')->withSuccess('You have made an account and logged into dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You logged in!');
        }

        return back()->withErrors([
            'email' => 'your provided credentials are wrong',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        if (Auth::check() && auth()->user()->role == 2) {
            return view('auth.dashboard');
        } elseif (auth()->user()->role == 1) {
            return view('auth.userDashboard');
        } else {
            return redirect()->route('home');
        }

        // return redirect()->route('login')->withErrors([
        //     'email' => 'Please login the dashboard to gain access',
        // ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('you logged out succesfully');
    }

    public function animes()
    {

        var_dump('dsa');
        exit;

        if (auth()->user()->role == 2) {
            $client = new Client();
            $res = $client->request('GET', 'https://api.consumet.org/anime/gogoanime/top-airing');
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
                            'image' => $result['image'],
                            'genre' => $genres, // Replace with the actual array key for 'genre'
                            'publish_date' => $currentDate, // Replace with the actual array key for 'publish_date'
                        ]);
                    }

                    return view('welcome', ['data' => $res]); // Pass the "results" array to the view
                } else {
                    echo 'oof';
                }
            } else {
                return view('error');
            }
        } else {

            return view('error');
        }
    }
}
