<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows authenticated user to see their tasks', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(route('tasks.index'))
        ->assertStatus(200)
        ->assertSee($task->title);
});

it('allows a user to create a task', function () {
    $user = User::factory()->create();
    $categoryId = \App\Models\Category::factory()->create()->id;

    $data = [
        'title' => 'Test Task',
        'description' => 'Task description',
        'status' => 'pending',
        'category_id' => $categoryId,
    ];

    $this->actingAs($user)
        ->post(route('tasks.store'), $data)
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks', [
        'title' => 'Test Task',
        'user_id' => $user->id,
    ]);
});

it('allows a user to delete a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->delete(route('tasks.destroy', $task))
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});