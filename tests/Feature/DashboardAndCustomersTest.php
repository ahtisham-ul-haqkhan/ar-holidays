<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardAndCustomersTest extends TestCase
{
    /**
     * Test welcome dashboard route.
     */
    public function test_welcome_dashboard_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('AR Holidays');
        $response->assertSee('Surf Your Dream With Us');
    }

    /**
     * Test customer index route.
     */
    public function test_customer_index_page_loads_successfully(): void
    {
        $response = $this->get('/customers');

        $response->assertStatus(200);
        $response->assertSee('Customer Directory');
        $response->assertSee('Muhammad Hamza');
        $response->assertSee('Fatima Zahra');
        $response->assertSee('Add New Customer');
    }

    /**
     * Test customer create route.
     */
    public function test_customer_create_page_loads_successfully(): void
    {
        $response = $this->get('/customers/create');

        $response->assertStatus(200);
        $response->assertSee('Register New Customer');
        $response->assertSee('Customer Profile Information');
        $response->assertSee('CNIC');
    }

    /**
     * Test customer show route.
     */
    public function test_customer_show_page_loads_successfully(): void
    {
        $response = $this->get('/customers/1');

        $response->assertStatus(200);
        $response->assertSee('Muhammad Hamza');
        $response->assertSee('Customer Profile Details');
        $response->assertSee('Passport');
    }

    /**
     * Test customer edit route.
     */
    public function test_customer_edit_page_loads_successfully(): void
    {
        $response = $this->get('/customers/1/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Customer: Muhammad Hamza');
        $response->assertSee('Customer Profile Information');
    }

    /**
     * Test customer store redirection.
     */
    public function test_customer_store_redirects_with_success(): void
    {
        $response = $this->post('/customers', [
            'name' => 'Tariq Mehmood',
            'cnic' => '35202-9988776-9',
            'email' => 'tariq@example.com',
        ]);

        $response->assertRedirect('/customers');
        $response->assertSessionHas('success');
    }

    /**
     * Test customer update redirection.
     */
    public function test_customer_update_redirects_with_success(): void
    {
        $response = $this->put('/customers/1', [
            'name' => 'Muhammad Hamza',
            'cnic' => '35202-8492019-3',
        ]);

        $response->assertRedirect('/customers');
        $response->assertSessionHas('success');
    }
}
