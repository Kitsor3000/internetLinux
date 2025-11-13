@extends('admin.layout')

@section('title', 'Редагувати товар')

@section('content')
<h1 class="text-3xl font-bold mb-6">Редагувати товар</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST"
      enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold">Назва</label>
        <input type="text" name="name" value="{{ $product->name }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Опис</label>
        <textarea name="description" class="border p-2 w-full">{{ $product->description }}</textarea>
    </div>

    <div>
        <label class="block font-semibold">Ціна (₴)</label>
        <input type="number" name="price" value="{{ $product->price }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Категорія</label>
        <select name="category_id" class="border p-2 w-full">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected($cat->id == $product->category_id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-semibold">Фото</label>
        <input type="file" name="image" class="border p-2 w-full">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="h-20 mt-2">
        @endif
    </div>

    <button class="bg-blue-600 text-white px-6 py-2 rounded">
        Оновити
    </button>
</form>

@endsection
