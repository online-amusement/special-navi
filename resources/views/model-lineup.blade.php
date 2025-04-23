@extends('layouts.app')

@section('content')
    <model-lineup-component 
        v-bind:model_lineups="{{ ($modelLineups) }}" >
    </model-lineup-component>
@endsection