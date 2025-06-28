<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the category index for authenticated users', function () {
    $user = User::factory()->create();
    Category::factory()->count(3)->create();

    $this->actingAs($user)
        ->get(route('categories.index'))
        ->assertStatus(200)
        ->assertSee('Categories');
});

it('allows authenticated users to create a category', function () {
    $user = User::factory()->create();

    $data = ['name' => 'Work'];

    $this->actingAs($user)
        ->post(route('categories.store'), $data)
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', $data);
});

it('allows authenticated users to update a category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['name' => 'Old Name']);

    $this->actingAs($user)
        ->put(route('categories.update', $category), ['name' => 'New Name'])
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'New Name']);
});

it('allows authenticated users to delete a category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->delete(route('categories.destroy', $category))
        ->assertRedirect(route('categories.index'));

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});
