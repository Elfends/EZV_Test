<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    //Get Task List get(/api/tasks)
    public function testGetAllTasks(){
        Task::factory()->count(3)->create();

        $response = $this->get('/api/tasks');

        $response->assertStatus(200);

        $response->assertJsonStructure(['data' => []]);//collections
    }

    //Get Task get(/api/tasks/{id})
    public function testGetSingleTask(){
        $task = Task::factory()->create();
    
        $response = $this->get('/api/tasks/' . $task->id);
    
        $response->assertStatus(200);
    
        $response->assertJsonStructure(['data' => [
            'id',
            'title',
            'description',
            'user' => ['name'],
        ]]);
    
    }

    //Create Task post(/api/tasks)
    public function testCreateTaskSuccess(){
        $data = [
            'title' => 'New Task',
            'description' => 'Description of Lorem Ipsum',
            'user_id' => 1, // Assuming user_id 1 exists
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201);

        $response->assertJson(['message' => 'Success store task']);
    }
    public function testCreateTaskInvalidTitle(){
        $data = [
            //undefine title
            'description' => 'Description of Lorem Ipsum',
            'user_id' => 1, // Assuming user_id 1 exists
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['title']);
    }
    public function testCreateTaskInvalidUserID(){
        $data = [
            'title' => 'New Task',
            'description' => 'Description of Lorem Ipsum',
            'user_id' => 'asbul' //invalid type of user_id
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['user_id']);
    }

    //Update Tasks put(/api/tasks/{id})
    public function testUpdateTaskSuccess(){
        // Create a test task
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Task Title',
            'description' => 'Updated description',
            'user_id' => 2, // Assuming user_id 2 exists
        ];

        $response = $this->putJson('/api/tasks/' . $task->id, $data);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Success update task']);
    }
    public function testUpdateTaskNotFound(){
        // Attempt to update a task that doesn't exist (invalid ID)
        $data = [
            'title' => 'Updated Task Title',
            'description' => 'Updated description',
            'user_id' => 2, // Assuming user_id 2 exists
        ];

        $response = $this->putJson('/api/tasks/999', $data);

        $response->assertStatus(404);

        $response->assertJson(['message' => 'Task is not exist.']);
    }

    //Delete Task delete(/api/tasks/{id})
    public function testDeleteTask(){
        // Create a test task
        $task = Task::factory()->create();

        $response = $this->delete('/api/tasks/' . $task->id);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Success delete task']);
    }
    public function testDeleteTaskNotFound(){
        // Attempt to delete a task that doesn't exist (invalid ID)
        $response = $this->delete('/api/tasks/999');

        $response->assertStatus(404);

        $response->assertJson(['message' => 'Task is not exist.']);
    }

}
