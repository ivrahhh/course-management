<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    private $department;

    public function setUp() : void
    {
        parent::setUp();

        $this->seed();

        $this->department = Department::query()->first();
    }

    public function test_user_can_add_new_course()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();

        $courseData = [
            'name' => 'Information Technology',
            'description' => fake()->realText(),
            'department_id' => $this->department->id,
        ];

        $response = $this->actingAs($user)->post(route('courses.store'), $courseData);
        $response->assertValid();

        $this->assertDatabaseHas('courses', $courseData);
    }

    public function test_user_cannot_add_new_course_with_already_existing_course()
    {
                /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();
        
        Course::factory()->create([
            'name' => 'Information Technology',
        ]);

        $courseData = [
            'name' => 'Information Technology',
            'description' => fake()->realText(),
            'department_id' => $this->department->id,
        ];

        $response = $this->actingAs($user)->post(route('courses.store'), $courseData);
        $response->assertInvalid('name');
    }

    public function test_user_can_update_existing_course()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $response = $this->actingAs($user)->put(route('courses.update', ['course' => $course->id]), [
            'name' => 'New course name',
            'description' => 'Slightly Changed Course Description',
            'department_id' => $course->department_id,
        ]);

        $response->assertValid();
    
        $this->assertNotSame($course, $course->fresh());
    }

    public function test_user_cannot_update_existing_course_with_unknown_deparment_id()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $response = $this->actingAs($user)->put(route('courses.update', ['course' => $course->id]), [
            'name' => 'New course name',
            'description' => 'Slightly Changed Course Description',
            'department_id' => 10,
        ]);

        $response->assertInvalid();
    }

    public function test_user_can_delete_course()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $response = $this->actingAs($user)->delete(route('courses.destroy', ['course' => $course->id]));

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
