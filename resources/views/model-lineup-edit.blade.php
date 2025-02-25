@extends('layouts.app')

@section('content')
    @if($modelLineup)
        <model-lineup-edit-component 
            :model_lineup="{{ json_encode($modelLineup) }}"
            :old="{{ json_encode(old() ?: $modelLineup ?? null) }}"
            :errors= "{{ $errors }}">
        </model-lineup-edit-component >
    @else
        <model-lineup-edit-component
            :old="{{ json_encode(old() ?: $modelLineup ?? null) }}"
            :errors= "{{ $errors }}">
        </model-lineup-edit-component >
    @endif
@endsection