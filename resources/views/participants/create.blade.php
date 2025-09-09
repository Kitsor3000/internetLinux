<!-- resources/views/participants/create.blade.php -->
@extends('layouts.blade_layout')


@section('content')
<h1>Додати нового учасника</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('participants.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Ім'я</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <label for="telegram_username">Telegram</label>
        <input type="text" name="telegram_username" id="telegram_username" class="form-control">
    </div>

    <div class="form-group">
        <label for="joined_date">Дата приєднання</label>
        <input type="date" name="joined_date" id="joined_date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Додати</button>
</form>
@endsection
