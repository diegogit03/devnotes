<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotesTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_all_notes(): void
    {
        $user = User::factory()->create();
        Note::factory(5)->set('user_id', $user->id)->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/notes');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'body',
            ]
        ]);
    }

    public function test_show_a_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()
            ->set('user_id', $user->id)
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/notes/' . $note->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'body',
        ]);
    }

    public function test_create_a_note(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/api/notes', [
                'title' => 'Test',
                'body' => 'Test Body'
            ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'title',
            'body',
        ]);

        $id = $response->json('id');
        $exists = Note::find($id);
        $this->assertNotNull($exists);
    }

    public function test_update_a_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()
            ->set('user_id', $user->id)
            ->create();

        $response = $this
            ->actingAs($user)
            ->put('/api/notes/' . $note->id, [
                'title' => 'Test',
                'body' => 'Test Body'
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'body',
        ]);

        $note->refresh();
        $this->assertEquals('Test', $note->title);
        $this->assertEquals('Test Body', $note->body);
    }

    public function test_delete_a_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()
            ->set('user_id', $user->id)
            ->create();

        $response = $this
            ->actingAs($user)
            ->delete('/api/notes/' . $note->id);

        $response->assertStatus(204);

        $this->assertFalse($note->exists());
    }
}
