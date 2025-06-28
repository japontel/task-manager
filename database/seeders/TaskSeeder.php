<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        foreach ($categories as $category) {
            Task::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => "Task for {$category->name}",
                'description' => "Description for {$category->name}",
                'status' => 'pending',
            ]);
        }
    }
}
