<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_create_new_department()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();

        $departmentData = [
            'name' => 'Information Technology',
        ];

        $response = $this->actingAs($user)->post(route('departments.store'), $departmentData);
        $response->assertValid();

        $this->assertDatabaseHas('departments', $departmentData);
    }

    public function test_user_cannot_create_new_department_with_already_existing_department()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->post(route('departments.store'), [
            'name' => $department->name,
        ]);
        $response->assertInvalid(['name']);
    }

    public function test_user_can_update_department_name()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();

        $department = Department::factory()->create();
        
        $response = $this->actingAs($user)->put(route('departments.update', ['department' => $department->id]), [
            'name' => 'New Name for department',
        ]);

        $response->assertValid();

        $this->assertNotSame($department->fresh(), $department);
    }

    public function test_user_cannot_update_department_with_already_existing_department_name()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();

        $department = Department::factory()->create();
        $departmentOther = Department::factory()->create();
        
        $response = $this->actingAs($user)->put(route('departments.update', ['department' => $department->id]), [
            'name' => $departmentOther->name,
        ]);

        $response->assertInvalid('name');
    }

    public function test_user_can_delete_department()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();

        $department = Department::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('departments.destroy', ['department' => $department->id]));

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
