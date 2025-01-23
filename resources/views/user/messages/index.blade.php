@extends('layouts.admin')

@section('content1')
<div class="container mx-auto my-8 p-6 bg-gray-50 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
    <form action="{{ route('user.messages.store') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Grid for Name and Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-800"
                    placeholder="Enter your name"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-800"
                    placeholder="Enter your email"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message:</label>
            <textarea
                id="message"
                name="message"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 resize-none text-gray-800"
                placeholder="Write your message here"
                rows="4"
            ></textarea>
            @error('message')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button
                type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Send Message
            </button>
        </div>
    </form>
</div>

@endsection
