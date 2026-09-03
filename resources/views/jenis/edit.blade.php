@extends('layouts.app')

@section('title', 'Jenis Edit')

@section('content')
<div class="container my-4">
    <h4 class="mb-4">Edit Jenis</h4>

    <!-- Ditambahkan route admin.jenis.update -->
    <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('jenis._form')
    </form>
</div>
@endsection