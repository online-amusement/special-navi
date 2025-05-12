@extends('layouts.app')

@section('content')
    <sub-category-tag-component v-bind:sub_category="{{ ($subCategoryTag) }}" >
    </sub-category-tag-component>
@endsection