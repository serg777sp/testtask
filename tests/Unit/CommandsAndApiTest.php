<?php

namespace Tests\Unit;

use Tests\TestCase;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EntityManager;
use App\Models\Doc2\User;

class CommandsAndApiTest extends TestCase
{
    use DatabaseTransactions;

    private $test_user;

    protected function setUp() {
        parent::setUp();
        $this->test_user = [
            'name' => 'test_user',
            'password' => 'secret',
            'info' => 'information about the test user'
        ];

    }

    /**
     * a test for command user:create.
     *
     * @return void
     */
    public function testUserCreate()
    {
        $params = [
            'name' => $this->test_user['name'],
            '--password' => $this->test_user['password'],
            '--info' => $this->test_user['info']
        ];
        $res = $this->artisan('user:create', $params);

        $this->assertEquals(200, $res);
    }

    /**
     * a test for command user:update.
     *
     * @return void
     */
    public function testUserUpdate() {
        $params = [
            'name' => $this->test_user['name'],
            '--info' => $this->test_user['info']
        ];
        $res = $this->artisan('user:update', $params);

        $this->assertEquals(200, $res);

    }

    /**
     * a test api.
     *
     * @return void
     */
    public function testApi() {
        $response = $this->get('get-info/' . $this->test_user['name']);

        $response->assertStatus(200);

        $this->assertEquals($this->test_user['info'], $response->original);

        $this->deleteTestUser();
    }

    private function deleteTestUser() {
        $user = EntityManager::getRepository(User::class)->findOneBy(['name' => $this->test_user['name']]);
        EntityManager::remove($user);
        EntityManager::flush();
    }
}
