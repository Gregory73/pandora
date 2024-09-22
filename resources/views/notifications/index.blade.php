@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Notificaciones</h1>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-4">
        @forelse ($notifications as $notification)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h5 class="text-xl font-semibold mb-2">{{ $notification->title }}</h5>
                <p class="text-gray-600 mb-4">{{ $notification->message }}</p>
                <div class="flex space-x-2">
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Marcar como leída</button>
                    </form>

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                No tienes notificaciones.
            </div>
        @endforelse
    </div>
</div>
@endsection
