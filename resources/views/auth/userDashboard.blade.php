@extends('auth.layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-black my-2 font-bold text-2xl">User profile</div>
            <form method="post" action="{{ route('edituser') }}" class="border-2 border-blue-600 rounded-xl p-2 flex flex-col space-y-4">
                @csrf
                <div class="flex flex-row space-x-4">
                    <p>User</p>
                    <input value="{{ auth()->user()->name }}" type="text" name="name" id="">
                </div>
                <div class="flex flex-row space-x-4">
                    <p>email</p>
                    <input value="{{ auth()->user()->email }}" type="text" name="name" id="">

                </div>
                <div class="flex flex-col space-x-4">
                    <p>profile pic</p> 
                    <img class="w-40 h-40" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="">
                    <input type="file" src="" name="" alt="">
                </div>
                <div><button type="submit">Edit </button></div>
            </form>
        </div>
    </div>
</div>

@endsection