@extends('layouts.app')

@section('title', 'Оформлення замовлення')

@section('content')
<h1 class="text-3xl font-bold mb-6">Оформлення замовлення</h1>

<form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Імʼя:</label>
        <input type="text" name="customer_name" class="border p-2 w-full" required>
    </div>

    <div>
        <label class="block font-semibold">Email:</label>
        <input type="email" name="customer_email" class="border p-2 w-full" required>
    </div>

    <p class="text-xl">Сума замовлення: <b>{{ $total }} ₴</b></p>

    <button class="bg-green-600 text-white px-6 py-2 rounded">
        Підтвердити замовлення
    </button>
</form>

@endsection
