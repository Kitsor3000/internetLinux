<!-- resources/views/participants/index.blade.php -->
@extends('layouts.blade_layout')


@section('content')
<h1>Учасники</h1>

<a href="{{ route('participants.create') }}" class="btn btn-primary">Додати учасника</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Телефон</th>
            <th>Telegram</th>
            <th>Дата приєднання</th>
            <th>Дії</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participants as $participant)
            <tr>
                <td>{{ $participant->id }}</td>
                <td>{{ $participant->name }}</td>
                <td>{{ $participant->phone }}</td>
                <td>{{ $participant->telegram_username }}</td>
                <td>{{ $participant->joined_date }}</td>
                <td>
                    <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-info btn-sm">Переглянути</a>
                    <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
