@extends('layouts.app')

@section('title', 'Кошик')

@section('content')

<h1 class="text-4xl font-bold mb-8">Кошик</h1>

@if(empty($cart))
    <p class="text-gray-600 text-xl">Ваш кошик порожній.</p>

@else

<div class="bg-white shadow rounded-xl overflow-hidden">

    <table class="w-full">
        <tr class="bg-gray-100 border-b">
            <th class="p-4 text-left">Товар</th>
            <th class="p-4">К-сть</th>
            <th class="p-4">Ціна</th>
            <th class="p-4">Разом</th>
            <th></th>
        </tr>

        @foreach($cart as $id => $item)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-4">{{ $item['name'] }}</td>
            <td class="p-4 text-center">{{ $item['quantity'] }}</td>
            <td class="p-4 text-center">{{ $item['price'] }} ₴</td>
            <td class="p-4 text-center">{{ $item['price'] * $item['quantity'] }} ₴</td>
            <td class="p-4 text-center">
                <a href="{{ route('cart.remove', $id) }}" class="text-red-600 hover:underline">Видалити</a>
            </td>
        </tr>
        @endforeach
    </table>

</div>

<p class="text-right text-3xl font-bold mt-6">Сума: {{ $total }} ₴</p>

<a href="{{ route('orders.checkout') }}"
   class="inline-block mt-6 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-3 rounded-lg text-xl hover:opacity-90 float-right">
    Оформити замовлення
</a>

@endif

@endsection
