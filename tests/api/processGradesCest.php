<?php

class processGradesCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $dataToTest = array(
            array(
            'name' => 'Ruben', 
            'grade' => 98
            ),
            array(            
            'name' => 'Trevor', 
            'grade' => 99
            ),
            array(
            'name' => 'OtherPeople', 
            'grade' => 22
            ));
        $I->sendPost('http://localhost:8081/api/v1/clubforce', json_encode($dataToTest));
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('[{"name":"Ruben","grade":100,"pass":true},{"name":"Trevor","grade":100,"pass":true},{"name":"OtherPeople","grade":20,"pass":false}]');
        $I->seeResponseMatchesJsonType([
            'name' => 'string',
            'grade' => 'integer',
            'pass' => 'boolean'
        ],'$[0]');
    }
    
}
