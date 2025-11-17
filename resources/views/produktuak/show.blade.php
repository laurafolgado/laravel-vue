@extends('layouts.app')

@section('title', 'Produktua Ikusi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Produktuaren Xehetasunak</h2>
                <a href="{{ route('produktuak.index') }}" class="btn btn-sm btn-secondary">Atzera</a>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="text-muted">ID</h5>
                    <p class="fs-5">{{ $produktua->id }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-muted">Izena</h5>
                    <p class="fs-5">{{ $produktua->izena }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-muted">Deskribapena</h5>
                    <p class="fs-5">{{ $produktua->deskribapena ?? 'Deskribapenik ez' }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-muted">Prezioa</h5>
                    <p class="fs-5 fw-bold text-success">{{ number_format($produktua->prezioa, 2) }} €</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-muted">Sortze data</h5>
                    <p class="fs-6">{{ $produktua->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-muted">Azken eguneraketa</h5>
                    <p class="fs-6">{{ $produktua->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('produktuak.edit', $produktua) }}" class="btn btn-warning">
                        Editatu
                    </a>
                    
                    <form action="{{ route('produktuak.destroy', $produktua) }}" 
                          method="POST" 
                          style="display: inline;"
                          onsubmit="return confirm('Ziur zaude produktu hau ezabatu nahi duzula?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Ezabatu
                        </button>
                    </form>
                    
                    <a href="{{ route('produktuak.index') }}" class="btn btn-secondary">
                        Zerrendara itzuli
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
