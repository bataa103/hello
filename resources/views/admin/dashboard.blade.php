@extends('layouts.admin')

@section('admin')
<div class="container mx-auto p-8 bg-gray-50 rounded-xl shadow-xl">
    <!-- Page Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8 border-b pb-4">Админ удирдлага</h1>

    <!-- Welcome Message -->
    <div class="mb-8">
        <p class="text-xl text-gray-600">
            Сайн уу, <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>! Админ хяналтын самбарт тавтай морил.
        </p>
    </div>

    <!-- Information Table -->

    <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-6 py-3 text-gray-700 text-lg font-bold">Ангилал</th>
                <th class="border border-gray-300 px-6 py-3 text-gray-700 text-lg font-bold text-center">Тоон мэдээлэл</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-gray-300">
                <td class="border border-gray-300 px-6 py-4 text-gray-800 text-xl font-medium">Нийт хэрэглэгч</td>
                <td class="border border-gray-300 px-6 py-4 text-blue-600 text-3xl font-extrabold text-center">{{ $users->count() }}</td>
            </tr>
            <tr class="border-b border-gray-300">
                <td class="border border-gray-300 px-6 py-4 text-gray-800 text-xl font-medium">Идэвхитэй хэрэглэгч</td>
                <td class="border border-gray-300 px-6 py-4 text-green-600 text-3xl font-extrabold text-center">{{ $plans->count() }}</td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-6 py-4 text-gray-800 text-xl font-medium">Ирсэн захидалууд</td>
                <td class="border border-gray-300 px-6 py-4 text-yellow-600 text-3xl font-extrabold text-center">{{ $messages->count() }}</td>
            </tr>
        </tbody>
    </table>

</div>
@endsection
