@extends('layouts.app')

@section('content')
    <div class="mx-auto w-4/5 py-24">
        <div class="text-center">
            <img src="{{ asset('images/' . $car->image_path) }}" class="w-8/12 mb-8 shadow-xl">
            <h1 class="text-5xl uppercase font-bold">{{ $car->name }}</h1>
{{--            <p class="text-lg text-gray-700 py-6">--}}
{{--                {{ $car->headquarter->headquarters }}, {{ $car->headquarter->country }}--}}
{{--            </p>--}}
        </div>

        <div class="py-10 text-center">
            <div class="m-auto">
                <span class="uppercase text-blue-500 font-bold text-xs italic">
                    founded: {{ $car->founded }}
                </span>
                <p class="text-lg text-gray-700 py-6">
                    {{ $car->description }}
                </p>

                <table class="table-auto">
                    <tr class="bg-blue-100">
                        <th class="w-1/4 border-4 border-gray-500">
                            Model
                        </th>
                        <th class="w-1/4 border-4 border-gray-500">
                            Engines
                        </th>
                        <th class="w-1/4 border-4 border-gray-500">
                            Date
                        </th>
                        @forelse($car->carModels as $model)
                            <tr>
                                <td class="border-4 border-gray-500">
                                    {{ $model->model_name }}
                                </td>
                                <td class="border-4 border-gray-500">
                                    @foreach($car->engines as $engine)
                                        @if($model->id == $engine->model_id)
                                            {{ $engine->engine_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="border-4 border-gray-500">
                                    @if(isset($car->productionDate->created_at))
                                        {{ date('d-m-Y', strtotime($car->productionDate->created_at)) }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <p>No car models found</p>
                        @endforelse
                    </tr>
                </table>

                <p class="text-left">
                    Product types:
                    @forelse($car->products as $product)
                        {{ $product->name }}
                    @empty
                        <p>No car product description</p>
                    @endforelse
                </p>
                <hr class="mt-4 mb-8">
            </div>
        </div>
    </div>
@endsection
