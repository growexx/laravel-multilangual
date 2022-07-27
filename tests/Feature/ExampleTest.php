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
    public function test_createCompany()
    {

        $response = $this->get('http://127.0.0.1:8000/companies/create');
        $response->assertStatus(200);
    }
    public function test_StoreCompany()
    {
        $response = $this->call('POST', 'http://127.0.0.1:8000/companies', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(500);
    }
    public function test_deleteCompany()
    {
        $response = $this->call('DELETE', 'http://127.0.0.1:8000/companies/27', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(500);
    }
    public function test_updateCompany()
    {
        $response = $this->call('PUT', 'http://127.0.0.1:8000/companies/30', [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(302);
    }
    public function test_editCompany()
    {
        $response = $this->call('GET', 'http://127.0.0.1:8000/companies/30/edit', [
            'name' => 'growexx123',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(200);
    }
}
