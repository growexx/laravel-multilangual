<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\LanguageManager;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('companies');
        $response->assertStatus(200);
    }
    public function test_check_in_local()
    {
        $this->app->setLocale(app()->getLocale('locale'));
        $this->get('http://127.0.0.1:8000/change/lang')
            ->assertStatus(302);
    }
    public function test_ChangeLang()
    {
        $response = $this->get('http://127.0.0.1:8000/change/lang');
        $response->assertStatus(302);
    }
    public function test_Index()
    {

        $response = $this->get('http://127.0.0.1:8000/companies');
        $response->assertStatus(200);
    }
    public function test_createTask()
    {

        $response = $this->get('http://127.0.0.1:8000/companies/create');
        $response->assertStatus(200);
    }
    public function test_StoreTask()
    {
        $response = $this->call('POST', 'http://127.0.0.1:8000/companies', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(500);
    }
    public function test_deleteTask()
    {
        $response = $this->call('DELETE', 'http://127.0.0.1:8000/companies/24', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(500);
    }
    public function test_updateTask()
    {
        $response = $this->call('PUT', 'http://127.0.0.1:8000/companies/17', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(500);
    }
    public function test_editTask()
    {
        $response = $this->call('GET', 'http://127.0.0.1:8000/companies/17/edit', [
            'name' => 'growexx123',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(200);
    }
}
