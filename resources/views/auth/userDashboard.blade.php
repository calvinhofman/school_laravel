@extends('auth.layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-black my-2 font-bold text-2xl">User profile</div>
            <div class="border-2 border-blue-600 rounded-xl p-2 flex flex-col space-y-4">
                <div class="flex flex-row space-x-4">
                    <p>User</p>
                    <p>{{ auth()->user()->name }}</p>
                </div>
                <div class="flex flex-row space-x-4">
                    <p>email</p>
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <div class="flex flex-row space-x-4">
                    <p>profile pic</p> <img class="w-40 h-40" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="">
                </div>
                <div><a href="">Edit </a></div>
            </div>
        </div>
    </div>
</div>

@endsection