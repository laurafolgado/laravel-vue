@extends('layouts.app')

@section('title', 'Produktu Berria Sortu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Produktu Berria Sortu</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('produktuak.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="izena" class="form-label">Izena <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('izena') is-invalid @enderror" 
                               id="izena" 
                               name="izena" 
                               value="{{ old('izena') }}" 
                               required>
                        @error('izena')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskribapena" class="form-label">Deskribapena</label>
                        <textarea class="form-control @error('deskribapena') is-invalid @enderror" 
                                  id="deskribapena" 
                                  name="deskribapena" 
                                  rows="4">{{ old('deskribapena') }}</textarea>
                        @error('deskribapena')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="prezioa" class="form-label">Prezioa (€) <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('prezioa') is-invalid @enderror" 
                               id="prezioa" 
                               name="prezioa" 
                               value="{{ old('prezioa') }}" 
                               step="0.01" 
                               min="0" 
                               required>
                        @error('prezioa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Gorde</button>
                        <a href="{{ route('produktuak.index') }}" class="btn btn-secondary">Utzi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
