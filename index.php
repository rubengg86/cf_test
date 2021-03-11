<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;

require __DIR__ . '/vendor/autoload.php';

include 'classes.php';

$app = AppFactory::create();

$app->post('/api/v1/clubforce', function (Request $request, Response $response,$args) {
        
    $data = json_decode(file_get_contents('php://input'), true);
    /** If received data is not well formed, returns 400 bad request */
    if(!$data || $data == '' || $data == null){
        $result_msg = array('Status'=> 'ERROR', 'ERROR_MSG' => 'No valid data received', 'ERROR_CODE' => 'WRONG_DATA_002');
        $response->getBody()->write(json_encode($result_msg));
        return $response->withStatus(400);
    }

    $clubForce = new ClubForce();
    $result = $clubForce->processStudentsGrades($data);

    if($result){

        $response->getBody()->write(json_encode($result));
        return $response;

    }else{

        $result_msg = array('Status'=> 'ERROR', 'ERROR_MSG' => 'Wrong data received, Please check grades and name from each studend', 'ERROR_CODE' => 'WRONG_DATA_001');
        $response->getBody()->write(json_encode($result_msg));
        return $response->withStatus(400);
    }

});

$app->run();