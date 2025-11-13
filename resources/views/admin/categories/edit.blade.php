@extends('admin.layout')

@section('title', 'Редагування категорії')

@section('content')
<h1 class="text-3xl font-bold mb-6">Редагувати категорію</h1>

<form action="{{ route('admin.categories.update', $category) }}"
      method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold">Назва</label>
        <input type="text" name="name" value="{{ $category->name }}" class="border p-2 w-full">
    </div>

    <div>
        <label class="block font-semibold">Slug</label>
        <input type="text" name="slug" value="{{ $category->slug }}" class="border p-2 w-full">
    </div>

    <button class="bg-blue-600 text-white px-6 py-2 rounded">
        Оновити
    </button>
</form>

@endsection
