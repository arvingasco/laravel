<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomepageWorks()
    {
        $response = $this -> get('/');
            
        $response -> assertSeeText('Homepage');
        $response -> assertSeeText('Welcome to my homepage!');
    }

    public function testContactPageWorks() {
        $response = $this -> get('/contact');

        $response -> assertSeeText('Contact Page');
        $response -> assertSeeText('Find me at my email: arvin.gasco@wedocode.co.uk');   
    }
}
