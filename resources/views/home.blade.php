@extends('layouts.app')

@section('content')
    <member-component 
        :members="{{ json_encode($members) }}" 
        :input="{{ json_encode(request()->input()) }}">
    </member-component>
@endsection