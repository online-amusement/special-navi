@extends('layouts.app')

@section('content')
    <category-tag-component 
        v-bind:categorytags="{{ ($categoryTags) }}">
    </category-tag-component>
@endsection

