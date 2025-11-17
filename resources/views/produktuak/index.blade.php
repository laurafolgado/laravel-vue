@extends('layouts.app')

@section('title', 'Produktuak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Produktuak</h1>
    <a href="{{ route('produktuak.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Produktu Berria
    </a>
</div>

@if($produktuak->isEmpty())
    <div class="alert alert-info">
        Ez dago produkturik oraindik. <a href="{{ route('produktuak.create') }}">Sortu lehenengo produktua</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Izena</th>
                    <th>Deskribapena</th>
                    <th>Prezioa</th>
                    <th>Ekintzak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produktuak as $produktua)
                <tr>
                    <td>{{ $produktua->id }}</td>
                    <td>{{ $produktua->izena }}</td>
                    <td>{{ Str::limit($produktua->deskribapena, 50) }}</td>
                    <td>{{ number_format($produktua->prezioa, 2) }} €</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('produktuak.show', $produktua) }}" 
                               class="btn btn-sm btn-info" title="Ikusi">
                                Ikusi
                            </a>
                            <a href="{{ route('produktuak.edit', $produktua) }}" 
                               class="btn btn-sm btn-warning" title="Editatu">
                                Editatu
                            </a>
                            <form action="{{ route('produktuak.destroy', $produktua) }}" 
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Ziur zaude produktu hau ezabatu nahi duzula?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Ezabatu">
                                    Ezabatu
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $produktuak->links() }}
    </div>
@endif
@endsection
