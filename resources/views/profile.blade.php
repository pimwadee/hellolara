@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Profile</div>
    
        <div class="card-body">
            <br>
            <h4>
                Pimwadee Chaovalit
            </h4>
            <hr>
            
            <form>

                <button type="submit" formaction="/api/ConnectKD" method="get">Connect to KidDiary</button>
            </form>
        </div>
    </div>

@endsection