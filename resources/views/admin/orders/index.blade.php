@extends('admin.layout')

@section('title', 'Замовлення')

@section('content')
<h1 class="text-3xl font-bold mb-6">Усі замовлення</h1>

<table class="w-full bg-white shadow rounded">
    <tr class="border-b">
        <th class="p-3">ID</th>
        <th class="p-3">Покупець</th>
        <th class="p-3">Email</th>
        <th class="p-3">Сума</th>
        <th class="p-3">Статус</th>
        <th class="p-3">Дата</th>
        <th class="p-3">Дії</th>
    </tr>

    @foreach($orders as $order)
    <tr class="border-b">
        <td class="p-3">{{ $order->id }}</td>
        <td class="p-3">{{ $order->customer_name }}</td>
        <td class="p-3">{{ $order->customer_email }}</td>
        <td class="p-3">{{ $order->total }} ₴</td>
        <td class="p-3 uppercase">{{ $order->status }}</td>
        <td class="p-3">{{ $order->created_at->format('d.m.Y H:i') }}</td>

        <td class="p-3">
            <a href="{{ route('admin.orders.show', $order) }}"
               class="text-blue-600">
                Переглянути
            </a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
