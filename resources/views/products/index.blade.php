@extends('layouts.app')

@section('title', 'Каталог інструментів')

@section('content')
<h1 class="text-3xl font-bold mb-6">Каталог інструментів</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    @foreach($products as $product)
        <div class="bg-white shadow rounded p-4">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover rounded">
            @endif

            <h2 class="text-xl font-semibold mt-3">{{ $product->name }}</h2>
            <p class="text-gray-500">{{ $product->price }} ₴</p>

            <a href="{{ route('products.show', $product) }}"
               class="block bg-blue-600 text-white text-center py-2 mt-4 rounded">
                Детальніше
            </a>
        </div>
    @endforeach

</div>

@endsection
