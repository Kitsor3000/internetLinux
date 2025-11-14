@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="grid md:grid-cols-2 gap-12">

    <!-- Фото -->
    <div>
        @if($product->image)
           <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">


        @else
            <div class="h-80 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                Нема фото
            </div>
        @endif
    </div>

    <!-- Опис -->
    <div>
        <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>

        <p class="text-gray-600 text-lg">{{ $product->description }}</p>

        <p class="text-3xl font-bold text-blue-600 mt-6">{{ $product->price }} ₴</p>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-8">
            @csrf
            <button class="bg-gradient-to-r from-green-600 to-lime-600 text-white px-8 py-3 rounded-lg text-xl hover:opacity-90">
                Додати в кошик
            </button>
        </form>
    </div>

</div>
@endsection
