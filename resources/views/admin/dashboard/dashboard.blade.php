@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="flex-1">
        <div class="main_content container mx-auto py-8">
            <h1 class="text-3xl font-bold mb-4">Dashboard</h1>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($data as $item)
                        <div class="content_item bg-white p-6 rounded-md shadow-md">
                            <h2 class="text-xl font-semibold mb-2">{{ $item['name'] }}</h2>
                            <p class="text-gray-600">{{ $item['count'] }} items</p>
                        </div>
                    @endforeach
                </div>
        </div>
    </main>

@endsection
