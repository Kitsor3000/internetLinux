@extends('admin.layout')

@section('title', 'Нова категорія')

@section('content')
<h1 class="text-3xl font-bold mb-6">Додати категорію</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Назва</label>
        <input type="text" name="name" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Slug (латиниця)</label>
        <input type="text" name="slug" class="border p-2 w-full">
    </div>

    <button class="bg-green-600 text-white px-6 py-2 rounded">
        Створити
    </button>
</form>

@endsection
