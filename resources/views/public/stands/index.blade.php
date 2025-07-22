@extends('layouts.app')

@section('title', 'Nos Stands Eat&Drink')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-primary">Nos Stands</h2>

    @if($stands->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($stands as $stand)
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-lg">{{ $stand->nom_stand }}</h3>
                        <p>{{ $stand->description }}</p>
                        {{-- <p>Localisation: {{ $stand->localisation }}</p>
                        <p>Contact: {{ $stand->contact }}</p> --}}
                        <div class="card-actions justify-end">
                            <a href="{{ route('public.stands.products', $stand->id) }}" class="btn btn-primary btn-sm">
                                Voir les produits
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Il n'y a pas encore de stands disponibles.</p>
    @endif
@endsection
