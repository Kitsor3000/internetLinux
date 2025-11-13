@extends('layouts.app')

@section('title', 'Кошик')

@section('content')
<h1 class="text-3xl font-bold mb-6">Кошик</h1>

@if(empty($cart))
    <p class="text-gray-500 text-lg">Кошик порожній.</p>
@else

<table class="w-full bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3 text-left">Товар</th>
        <th class="p-3">Кількість</th>
        <th class="p-3">Ціна</th>
        <th class="p-3">Разом</th>
        <th></th>
    </tr>

    @foreach($cart as $id => $item)
        <tr class="border-b">
            <td class="p-3">{{ $item['name'] }}</td>
            <td class="text-center">{{ $item['quantity'] }}</td>
            <td class="text-center">{{ $item['price'] }} ₴</td>
            <td class="text-center">{{ $item['price'] * $item['quantity'] }} ₴</td>
            <td class="p-3">
                <a href="{{ route('cart.remove', $id) }}" class="text-red-600">Видалити</a>
            </td>
        </tr>
    @endforeach
</table>

<p class="text-xl font-bold mt-4">Загальна сума: {{ $total }} ₴</p>

<a href="{{ route('orders.checkout') }}" class="inline-block bg-blue-600 text-white px-6 py-2 mt-4 rounded">
    Оформити замовлення
</a>

@endif
@endsection
