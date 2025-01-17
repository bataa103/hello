<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @extends('layouts.app') <!-- Extend your layout -->

@section('content')
<div class="container">
    <div class="row">
        <h1>User Dashboard</h1>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <canvas id="lineChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>


@endsection


</x-app-layout>
