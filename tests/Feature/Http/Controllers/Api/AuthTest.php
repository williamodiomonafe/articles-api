<?php

use Faker\Factory;
use App\User;

class AuthTest extends TestCase
{

    /**
     * @test
     */
    public function canRegisterUser()
    {
        $response = $this->post('/auth/register', [
            'name' => 'William Odiomonafe',
            'email' => 'william@mail.com',
            'password' => 'secret',
        ]);

        $response->assertResponseStatus(201);
        $response->seeJsonStructure([
            'name',
            'email',
        ]);
    }


    /**
     * @test
     */
    public function canAuthenticateUser()
    {
        $response = $this->post('auth/login', [
            'email' => 'william@mail.com',
            'password' => 'secret',
        ]);

        $response->seeJsonStructure([
            'token',
        ]);
    }
}