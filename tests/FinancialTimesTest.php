<?php
namespace Tests;

require_once(__DIR__ . '/../src/Models/checkRequest.php');

class FinancialTimesTest extends BaseTestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRoutes($url) {
        $response = $this->runApp("POST", '/api/FinancialTimes/'.$url);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function dataProvider() {
        return [
            ['getContentById'],
            ['getCurationsList'],
            ['getAspectsList'],
            ['getFacetsList'],
            ['searchContent'],
            ['getContentNotifications']
        ];
    }
}