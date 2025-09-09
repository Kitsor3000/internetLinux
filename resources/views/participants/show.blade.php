<!-- resources/views/participants/show.blade.php -->
@extends('layouts.blade_layout')


@section('content')
<h1>Деталі учасника</h1>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">{{ $participant->name }}</h5>
        <p class="card-text"><strong>Телефон:</strong> {{ $participant->phone }}</p>
        <p class="card-text"><strong>Telegram:</strong> {{ $participant->telegram_username }}</p>
        <p class="card-text"><strong>Дата приєднання:</strong> {{ $participant->joined_date }}</p>
        <a href="{{ route('participants.index') }}" class="btn btn-secondary mt-3">Назад</a>
    </div>
</div>
@endsection
