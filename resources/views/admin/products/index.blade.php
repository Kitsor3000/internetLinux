@extends('admin.layout')

@section('title', 'Товари')

@section('content')
<h1 class="text-3xl font-bold mb-6">Усі товари</h1>

<a href="{{ route('admin.products.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded inline-block mb-4">
    ➕ Додати товар
</a>

<table class="w-full bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3">Фото</th>
        <th class="p-3">Назва</th>
        <th class="p-3">Ціна</th>
        <th class="p-3">Категорія</th>
        <th class="p-3">Дії</th>
    </tr>

    @foreach($products as $product)
    <tr class="border-b">
        <td class="p-3">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="h-14">
            @endif
        </td>
        <td class="p-3">{{ $product->name }}</td>
        <td class="p-3">{{ $product->price }} ₴</td>
        <td class="p-3">{{ $product->category->name ?? '-' }}</td>
        <td class="p-3 space-x-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600">Редагувати</a>

            <form action="{{ route('admin.products.destroy', $product) }}"
                  method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-600"
                        onclick="return confirm('Видалити товар?')">Видалити</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
