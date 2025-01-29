@extends('layouts.app')

@section('content')
    <sub-category-tag-component :sub_category="{{ json_encode($subCayegoryTag) }}" >
    </sub-category-tag-component>
@endsection