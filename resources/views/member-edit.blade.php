@extends('layouts.app')

@section('content')
    @if($member)
        <member-edit-component 
            :member="{{ ($member) }}"
            :old="{{ json_encode(old() ?: $member ?? null) }}"
            :errors= "{{ $errors }}">
        </member-edit-component >
    @else
        <member-edit-component 
            :old="{{ json_encode(old() ?: $member ?? null) }}"
            :errors= "{{ $errors }}">
        </member-edit-component >
    @endif
@endsection