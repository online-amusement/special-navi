@extends('layouts.app')

@section('content')
    <sub-category-tag-component v-bind:sub_category="{{ ($subCayegoryTag) }}" >
    </sub-category-tag-component>
@endsection