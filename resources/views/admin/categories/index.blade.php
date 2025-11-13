@extends('admin.layout')

@section('title', 'Категорії')

@section('content')
<h1 class="text-3xl font-bold mb-6">Категорії</h1>

<a href="{{ route('admin.categories.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded inline-block mb-4">
    ➕ Додати категорію
</a>

<table class="w-full bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3">ID</th>
        <th class="p-3">Назва</th>
        <th class="p-3">Slug</th>
        <th class="p-3">Дії</th>
    </tr>

    @foreach($categories as $category)
    <tr class="border-b">
        <td class="p-3">{{ $category->id }}</td>
        <td class="p-3">{{ $category->name }}</td>
        <td class="p-3">{{ $category->slug }}</td>
        <td class="p-3 space-x-4">

            <a href="{{ route('admin.categories.edit', $category) }}"
               class="text-blue-600">
                Редагувати
            </a>

            <form action="{{ route('admin.categories.destroy', $category) }}"
                  method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600"
                        onclick="return confirm('Видалити категорію?')">
                    Видалити
                </button>
            </form>

        </td>
    </tr>
    @endforeach
</table>

@endsection
