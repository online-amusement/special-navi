@extends('layouts.app')

@section('content')
@if($categoryTags)
        <category-tag-edit-component 
            :categoryTags="{{ ($categoryTags) }}"
            :old="{{ json_encode(old() ?: $categoryTags ?? null) }}"
            :errors= "{{ $errors }}">
        </category-tag-edit-component >
    @else
        <category-tag-edit-component 
            :old="{{ json_encode(old() ?: $categoryTags ?? null) }}"
            :errors= "{{ $errors }}">
        </category-tag-edit-component >
    @endif
@endsection