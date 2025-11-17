@extends('layouts.app')

@section('title', 'Produktuak - Vue.js')

@section('content')
<div id="app">
    <h1 class="mb-4">Produktuak (Vue.js + API)</h1>
    
    <!-- Alertas de error -->
    <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
        @{{ error }}
        <button type="button" class="btn-close" @click="error = null"></button>
    </div>
    
    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>@{{ form.id ? 'Produktua editatu' : 'Produktu berria sortu' }}</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="saveProduct">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="izena" class="form-label">Izena <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="izena" 
                               v-model="form.izena" 
                               required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="prezioa" class="form-label">Prezioa (€) <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control" 
                               id="prezioa" 
                               v-model="form.prezioa" 
                               step="0.01" 
                               min="0" 
                               required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                                @{{ form.id ? 'Eguneratu' : 'Gorde' }}
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="deskribapena" class="form-label">Deskribapena</label>
                        <textarea class="form-control" 
                                  id="deskribapena" 
                                  v-model="form.deskribapena" 
                                  rows="3"></textarea>
                    </div>
                </div>
                
                <div class="d-flex gap-2" v-if="form.id">
                    <button type="button" class="btn btn-secondary" @click="resetForm">
                        Utzi
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Loader -->
    <div v-if="loading && produktuak.length === 0" class="text-center my-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Kargatzen...</span>
        </div>
    </div>
    
    <!-- Tabla de productos -->
    <div v-else class="card">
        <div class="card-header">
            <h3>Produktu zerrenda</h3>
        </div>
        <div class="card-body">
            <div v-if="produktuak.length === 0" class="alert alert-info">
                Ez dago produkturik oraindik. Sortu lehenengo produktua goiko formularioa erabiliz.
            </div>
            
            <div v-else class="table-responsive">
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
                        <tr v-for="produktua in produktuak" :key="produktua.id">
                            <td>@{{ produktua.id }}</td>
                            <td>@{{ produktua.izena }}</td>
                            <td>@{{ produktua.deskribapena || '-' }}</td>
                            <td>@{{ parseFloat(produktua.prezioa).toFixed(2) }} €</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="editProduct(produktua)" 
                                            class="btn btn-sm btn-warning" 
                                            :disabled="loading">
                                        Editatu
                                    </button>
                                    <button @click="deleteProduct(produktua)" 
                                            class="btn btn-sm btn-danger" 
                                            :disabled="loading">
                                        Ezabatu
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            produktuak: [],
            form: {
                id: null,
                izena: '',
                deskribapena: '',
                prezioa: null
            },
            loading: false,
            error: null
        }
    },
    
    methods: {
        async fetchProducts() {
            this.loading = true;
            this.error = null;
            
            try {
                const response = await axios.get('/api/produktuak');
                // La respuesta viene paginada, los datos están en response.data.data
                this.produktuak = response.data.data || [];
            } catch (error) {
                this.error = 'Errorea produktuak kargatzean: ' + (error.response?.data?.message || error.message);
                console.error('Error fetching products:', error);
            } finally {
                this.loading = false;
            }
        },
        
        resetForm() {
            this.form = {
                id: null,
                izena: '',
                deskribapena: '',
                prezioa: null
            };
            this.error = null;
        },
        
        editProduct(produktua) {
            this.form = {
                id: produktua.id,
                izena: produktua.izena,
                deskribapena: produktua.deskribapena || '',
                prezioa: parseFloat(produktua.prezioa)
            };
            
            // Scroll al formulario
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        
        async saveProduct() {
            this.loading = true;
            this.error = null;
            
            try {
                const data = {
                    izena: this.form.izena,
                    deskribapena: this.form.deskribapena,
                    prezioa: parseFloat(this.form.prezioa)
                };
                
                if (this.form.id) {
                    // Actualizar producto existente
                    await axios.put(`/api/produktuak/${this.form.id}`, data);
                } else {
                    // Crear nuevo producto
                    await axios.post('/api/produktuak', data);
                }
                
                this.resetForm();
                await this.fetchProducts();
            } catch (error) {
                if (error.response?.data?.errors) {
                    // Errores de validación
                    const errors = error.response.data.errors;
                    this.error = Object.values(errors).flat().join(', ');
                } else {
                    this.error = 'Errorea produktua gordetzean: ' + (error.response?.data?.message || error.message);
                }
                console.error('Error saving product:', error);
            } finally {
                this.loading = false;
            }
        },
        
        async deleteProduct(produktua) {
            if (!confirm(`Ziur zaude "${produktua.izena}" ezabatu nahi duzula?`)) {
                return;
            }
            
            this.loading = true;
            this.error = null;
            
            try {
                await axios.delete(`/api/produktuak/${produktua.id}`);
                await this.fetchProducts();
                
                // Si estábamos editando el producto eliminado, resetear el formulario
                if (this.form.id === produktua.id) {
                    this.resetForm();
                }
            } catch (error) {
                this.error = 'Errorea produktua ezabatzean: ' + (error.response?.data?.message || error.message);
                console.error('Error deleting product:', error);
            } finally {
                this.loading = false;
            }
        }
    },
    
    mounted() {
        this.fetchProducts();
    }
}).mount('#app');
</script>
@endsection
