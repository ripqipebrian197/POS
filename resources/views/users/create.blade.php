@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    @include('layouts.navbar')

    <h1>Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @include('users._form')
    </form>

@endsection