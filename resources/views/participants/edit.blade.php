<!-- resources/views/participants/edit.blade.php -->
@extends('layouts.blade_layout')


@section('content')
<h1>Редагувати учасника</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('participants.update', $participant->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Ім'я</label>
        <input type="text" name="name" id="name" value="{{ $participant->name }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" id="phone" value="{{ $participant->phone }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="telegram_username">Telegram</label>
        <input type="text" name="telegram_username" id="telegram_username" value="{{ $participant->telegram_username }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="joined_date">Дата приєднання</label>
        <input type="date" name="joined_date" id="joined_date" value="{{ $participant->joined_date }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Оновити</button>
</form>
@endsection
