@extends('layouts.app')

@section('title', 'Produktua Editatu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Produktua Editatu</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('produktuak.update', $produktua) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="izena" class="form-label">Izena <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('izena') is-invalid @enderror" 
                               id="izena" 
                               name="izena" 
                               value="{{ old('izena', $produktua->izena) }}" 
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
                                  rows="4">{{ old('deskribapena', $produktua->deskribapena) }}</textarea>
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
                               value="{{ old('prezioa', $produktua->prezioa) }}" 
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
                        <button type="submit" class="btn btn-primary">Gorde aldaketak</button>
                        <a href="{{ route('produktuak.index') }}" class="btn btn-secondary">Utzi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
