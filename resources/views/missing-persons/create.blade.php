@extends('layouts.app')

@section('title', 'Додати зниклу особу')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Додати зниклу особу</h1>

            <form action="{{ route('missing-persons.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Особиста інформація -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Ім'я *</label>
                        <input type="text" name="first_name" id="first_name" required
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Прізвище *</label>
                        <input type="text" name="last_name" id="last_name" required
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">По батькові</label>
                        <input type="text" name="middle_name" id="middle_name"
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700">Вік *</label>
                        <input type="number" name="age" id="age" min="0" max="120" required
                               class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Стать *</label>
                        <select name="gender" id="gender" required
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Оберіть стать</option>
                            <option value="male">Чоловік</option>
                            <option value="female">Жінка</option>
                            <option value="unknown">Невідомо</option>
                        </select>
                    </div>
                </div>

                <!-- Локація -->
                <div>
                    <label for="last_location_id" class="block text-sm font-medium text-gray-700">Остання відома локація *</label>
                    <select name="last_location_id" id="last_location_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Оберіть локацію</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->full_address }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Дата зникнення -->
                <div>
                    <label for="disappeared_at" class="block text-sm font-medium text-gray-700">Дата зникнення *</label>
                    <input type="date" name="disappeared_at" id="disappeared_at" required
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Опис -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Опис *</label>
                    <textarea name="description" id="description" rows="4" required
                              class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Детальний опис зовнішності, одягу, обставин зникнення..."></textarea>
                </div>

                <!-- Особливі прикмети -->
                <div>
                    <label for="special_marks" class="block text-sm font-medium text-gray-700">Особливі прикмети</label>
                    <textarea name="special_marks" id="special_marks" rows="2"
                              class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Шрами, татуювання, інвалідність, особливі риси..."></textarea>
                </div>

                <!-- Контактна інформація -->
                <div>
                    <label for="contact_info" class="block text-sm font-medium text-gray-700">Контактна інформація *</label>
                    <input type="text" name="contact_info" id="contact_info" required
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Номер телефону, email для зв'язку...">
                </div>

                <!-- Категорії -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Категорії</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Додаткові налаштування -->
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_urgent" value="1"
                               class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Терміновий випадок</span>
                    </label>
                </div>

                <!-- Фото -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Фото</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Кнопки -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('missing-persons.index') }}"
                       class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">
                        Скасувати
                    </a>
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Додати особу
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Встановлюємо сьогоднішню дату за замовчуванням
        document.getElementById('disappeared_at').valueAsDate = new Date();
    </script>
@endsection
