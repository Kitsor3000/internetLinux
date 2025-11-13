@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="grid md:grid-cols-2 gap-8">

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow">
    @endif

    <div>
        <h1 class="text-3xl font-bold">{{ $product->name }}</h1>

        <p class="text-gray-600 mt-3">{{ $product->description }}</p>

        <p class="text-2xl font-semibold mt-4">{{ $product->price }} ₴</p>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
            @csrf
            <button class="bg-green-600 text-white px-6 py-2 rounded">
                Додати в кошик
            </button>
        </form>
    </div>

</div>
@endsection
