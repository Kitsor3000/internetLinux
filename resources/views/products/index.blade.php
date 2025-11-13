@extends('layouts.app')

@section('title', "Каталог інструментів")

@section('content')

<h1 class="text-4xl font-bold mb-8 text-gray-800">Каталог інструментів</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

@foreach($products as $product)
    <div class="bg-white shadow hover:shadow-xl transition rounded-xl overflow-hidden">
        
        <div class="h-48 bg-gray-200 flex items-center justify-center">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover">
            @else
                <span class="text-gray-500 italic">Нема фото</span>
            @endif
        </div>

        <div class="p-5">
            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>

            <p class="text-gray-600 mt-1">{{ Str::limit($product->description, 50) }}</p>

            <p class="text-2xl font-bold mt-3 text-blue-600">{{ $product->price }} ₴</p>

            <a href="{{ route('products.show', $product) }}"
                class="block mt-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-2 rounded-lg hover:opacity-90">
                Переглянути
            </a>
        </div>

    </div>
@endforeach

</div>

@endsection
