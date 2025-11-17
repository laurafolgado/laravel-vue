<?php

namespace Tests\Feature;

use App\Models\Produktu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProduktuApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_produktuak(): void
    {
        Produktu::factory(3)->create();
        $response = $this->getJson('/api/produktuak');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'current_page']);
    }

    /** @test */
    public function puede_crear_produktua(): void
    {
        $payload = [
            'izena' => 'Kafea',
            'deskribapena' => 'Arabica',
            'prezioa' => 4.50,
        ];
        $response = $this->postJson('/api/produktuak', $payload);
        $response->assertStatus(201)
                 ->assertJsonFragment(['izena' => 'Kafea']);
        $this->assertDatabaseHas('produktuak', ['izena' => 'Kafea']);
    }

    /** @test */
    public function puede_mostrar_un_produktua(): void
    {
        $produktua = Produktu::factory()->create();
        $response = $this->getJson('/api/produktuak/' . $produktua->id);
        $response->assertStatus(200);
        // La respuesta de show es el objeto completo, validamos campos clave
        $response->assertJson([
            'id' => $produktua->id,
            'izena' => $produktua->izena,
        ]);
    }

    /** @test */
    public function puede_actualizar_un_produktua(): void
    {
        $produktua = Produktu::factory()->create();
        $payload = [
            'izena' => 'Izen Berria',
            'deskribapena' => 'Desc nueva',
            'prezioa' => 9.99,
        ];
        $response = $this->putJson('/api/produktuak/' . $produktua->id, $payload);
        $response->assertStatus(200)
                 ->assertJsonFragment(['izena' => 'Izen Berria']);
        $this->assertDatabaseHas('produktuak', ['izena' => 'Izen Berria']);
    }

    /** @test */
    public function puede_eliminar_un_produktua(): void
    {
        $produktua = Produktu::factory()->create();
        $response = $this->deleteJson('/api/produktuak/' . $produktua->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('produktuak', ['id' => $produktua->id]);
    }
}
