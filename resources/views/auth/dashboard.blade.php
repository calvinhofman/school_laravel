@extends('auth.layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="border-2 border-blue-600 rounded-xl p-2 flex flex-col space-y-4">
                <div>
                    <form action="{{ route('animes') }}" method="post">
                        @csrf
                        <button type="submit">Sync</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection