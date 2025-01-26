@extends('layouts.app')

@section('content')
    <category-tag-component 
        :categorytags="{{ json_encode($categoryTags) }}">

    </category-tag-component>
@endsection

