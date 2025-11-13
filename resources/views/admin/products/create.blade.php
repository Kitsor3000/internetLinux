@extends('admin.layout')

@section('title', 'Новий товар')

@section('content')
<h1 class="text-3xl font-bold mb-6">Додати товар</h1>

<form action="{{ route('admin.products.store') }}" method="POST"
      enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Назва</label>
        <input type="text" name="name" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Опис</label>
        <textarea name="description" class="border p-2 w-full"></textarea>
    </div>

    <div>
        <label class="block font-semibold">Ціна (₴)</label>
        <input type="number" name="price" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Категорія</label>
        <select name="category_id" class="border p-2 w-full">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-semibold">Фото</label>
        <input type="file" name="image" class="border p-2 w-full">
    </div>

    <button class="bg-green-600 text-white px-6 py-2 rounded">
        Створити
    </button>
</form>

@endsection
