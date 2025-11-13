@extends('admin.layout')

@section('title', 'Замовлення №' . $order->id)

@section('content')
<h1 class="text-3xl font-bold mb-6">Замовлення №{{ $order->id }}</h1>

<div class="mb-6">
    <p><b>Покупець:</b> {{ $order->customer_name }}</p>
    <p><b>Email:</b> {{ $order->customer_email }}</p>
    <p><b>Статус:</b> <span class="uppercase">{{ $order->status }}</span></p>
</div>

<h2 class="text-2xl font-bold mb-4">Товари</h2>

<table class="w-full bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3">Назва</th>
        <th class="p-3">Кількість</th>
        <th class="p-3">Ціна</th>
        <th class="p-3">Разом</th>
    </tr>

    @foreach($order->items as $item)
    <tr class="border-b">
        <td class="p-3">{{ $item->product->name }}</td>
        <td class="p-3 text-center">{{ $item->quantity }}</td>
        <td class="p-3 text-center">{{ $item->price }} ₴</td>
        <td class="p-3 text-center">{{ $item->price * $item->quantity }} ₴</td>
    </tr>
    @endforeach
</table>

<p class="text-xl font-bold mt-4">Сума: {{ $order->total }} ₴</p>

<hr class="my-6">

<h2 class="text-xl font-bold mb-3">Змінити статус</h2>

<form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="status" class="border p-2 rounded">
        <option value="new" @selected($order->status=='new')>Нове</option>
        <option value="paid" @selected($order->status=='paid')>Оплачено</option>
        <option value="shipped" @selected($order->status=='shipped')>Відправлено</option>
        <option value="completed" @selected($order->status=='completed')>Виконано</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded ml-3">
        Оновити статус
    </button>
</form>

@endsection
