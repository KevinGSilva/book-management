@extends('layouts.base')

@section('content')
    <form method="POST" id="form-{{ $action }}">
        @include('forms.book')
    </form>
@endsection
