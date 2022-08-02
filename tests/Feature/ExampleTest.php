<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;

class ExampleTest extends TestCase
{
    public function test_ChangeLang()
    {
        $response = $this->get('http://127.0.0.1:8000/change/lang');
        $response->assertStatus(302);
    }
    public function test_Index()
    {
        $response = $this->withoutMiddleware();
        $response = Company::create([
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
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
        $response->assertStatus(302);
    }
    public function test_ShowCompanies()
    {
        $company = Company::first();
        $id = $company->id;
        $response = $this->get('http://127.0.0.1:8000/companies/'.$id);
        $response->assertStatus(200);
    }
    public function test_updateCompany()
    {
        $company = Company::first();
        $id = $company->id;
        $response = $this->call('PUT', 'http://127.0.0.1:8000/companies/'.$id, [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(302);
    }
    public function test_editCompany()
    {
        $company = Company::first();
        $id = $company->id;
        $response = $this->call('GET', 'http://127.0.0.1:8000/companies/'.$id.'/edit', [
            'name' => 'growexx123',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(200);
    }
    public function test_deleteCompany()
    {
        $response = Company::create([
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $id = $response->id;
        $response = $this->call('DELETE', 'http://127.0.0.1:8000/companies/'.$id, [
            'name' => 'growexx',
            'email' => 'abc@gmail.com',
            'address' => 'abc,amd'
        ]);
        $response->assertStatus(302);
    }
}
