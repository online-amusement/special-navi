@extends('layouts.app')

@section('content')
    @if($subCayegoryTags)
        <sub-category-tag-edit-component 
            :sub_category="{{ ($subCayegoryTags) }}"
            :category="{{ ($categoryTag) }}"
            :old="{{ json_encode(old() ?: $subCayegoryTags ?? null) }}"
            :errors= "{{ $errors }}">
        </sub-category-tag-edit-component >
    @else
        <sub-category-tag-edit-component 
            :category="{{ ($categoryTag) }}"
            :old="{{ json_encode(old() ?: $subCayegoryTags ?? null) }}"
            :errors= "{{ $errors }}">
        </sub-category-tag-edit-component >
    @endif
@endsection