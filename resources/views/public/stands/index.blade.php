@extends('layouts.app')

@section('title', 'Nos Stands Eat&Drink')

@section('content')
    <h2>Nos Stands</h2>

    @if($stands->count() > 0)
        <div class="stands-list">
            @foreach($stands as $stand)
                <div class="stand-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
                    <h3>{{ $stand->nom }}</h3>
                    <p>{{ $stand->description }}</p>
                    <p>Localisation: {{ $stand->localisation }}</p>
                    <p>Contact: {{ $stand->contact }}</p>
                    <a href="{{ route('public.stands.products', $stand->id) }}">Voir les produits de ce stand</a>
                </div>
            @endforeach
        </div>
    @else
        <p>Il n'y a pas encore de stands disponibles.</p>
    @endif
@endsection