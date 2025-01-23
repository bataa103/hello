@extends('layouts.admin')

@section('admin')

<div class="container">
    <h1 class="text-xl font-bold">Хэрэглэгчдээс ирсэн захидал</h1>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Нэр</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Зурвас</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Огноо</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($messages as $message)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message->message }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4">No messages available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
@section('scripts')
    <script>
        // public/admin/js/messages.js

document.addEventListener("DOMContentLoaded", function () {
    // Select all 'View' buttons
    const viewButtons = document.querySelectorAll(".view-message");

    viewButtons.forEach(button => {
        button.addEventListener("click", function () {
            const messageId = this.dataset.id;

            // Fetch the message details
            fetch(`/admin/messages/${messageId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show the message content (you can customize the modal logic)
                        alert(`Message Content: ${data.message.content}`);
                    } else {
                        alert("Message not found!");
                    }
                })
                .catch(error => console.error("Error fetching message:", error));
        });
    });
});

    </script>
@endsection

