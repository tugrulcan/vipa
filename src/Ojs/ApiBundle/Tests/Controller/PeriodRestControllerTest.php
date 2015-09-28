<?php

namespace Ojs\ApiBundle\Tests\Controller;

use Ojs\CoreBundle\Tests\BaseTestCase;

class PeriodRestControllerTest extends BaseTestCase
{
    public function testGetPeriodsAction()
    {
        $url = $this->router->generate('api_1_get_periods');
        $this->client->request('GET', $url);
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testNewPeriodAction()
    {
        $content = [
            'translations' => [
                'en' => [
                    'period' => 'PHPUnit Test Period Field en - POST',
                ]
            ],
        ];
        $url = $this->router->generate('api_1_get_periods');
        $this->client->request(
            'POST',
            $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($content)
        );
        $response = $this->client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testGetPeriodAction()
    {
        $url = $this->router->generate('api_1_get_period', ['id'=> 1]);
        $this->client->request('GET', $url);
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPutPeriodAction()
    {
        $content = [
            'translations' => [
                'en' => [
                    'period' => 'PHPUnit Test Period Field en - PUT',
                ]
            ],
        ];
        $url = $this->router->generate('api_1_put_period', ['id' => 550]);
        $this->client->request(
            'PUT',
            $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($content)
        );
        $response = $this->client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testPatchPeriodAction()
    {
        $content = [
            'translations' => [
                'tr' => [
                    'period' => 'PHPUnit Test Period Field TR - PATCH',
                ]
            ]
        ];
        $url = $this->router->generate('api_1_patch_period', ['id' => 1]);
        $this->client->request(
            'PATCH',
            $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($content)
        );
        $response = $this->client->getResponse();
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testDeletePeriodAction()
    {
        $url = $this->router->generate('api_1_delete_period', ['id' => 1]);
        $this->client->request(
            'DELETE',
            $url
        );
        $response = $this->client->getResponse();
        $this->assertEquals(204, $response->getStatusCode());
    }
}
