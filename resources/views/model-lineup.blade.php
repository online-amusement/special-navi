@extends('layouts.app')

@section('content')
    <model-lineup-component 
        :model_lineups="{{ json_encode($modelLineups) }}" >
    </model-lineup-component>
@endsection