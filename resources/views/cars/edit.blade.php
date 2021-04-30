@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase font-bold">update car</h1>
        </div>

        <div class="flex justify-center pt-20">
            <form action="/cars/{{ $car->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">
                    <img src="{{ asset('images/' . $car->image_path) }}" class="w-80 mb-8 shadow-xl">
                    <input type="file" name="image" class="mb-10" value="{{ asset('images/' . $car->image_path) }}">
                    <input
                        type="text"
                        name="name"
                        value="{{ $car->name }}"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                    >
                    <input
                        type="text"
                        name="founded"
                        value="{{ $car->founded }}"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                    >
                    <input
                        type="text"
                        name="description"
                        value="{{ $car->description }}"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                    >
                    <button class="bg-green-500 shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        @if ($errors->any())
            <div class="w-4/8 m-auto text-center">
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif
    </div>
@endsection

