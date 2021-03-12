# cf_test

## Dependencies
- Slim framework 4 (via composer)
- codeception to test (via composer)

## How to install 

- Run php composer.phar install in root folder
- Run php -S localhost:8081 -t . index.php to start server

Endpoit will be available in http://localhost:8081/api/v1/clubforce

## How to run API test

To run test with codeception run this command in root folder: 
  - php codecept.phar run api

The test is created in tests/api/processGradesCest.php
  
  If test is OK, we must see this:
  
  ![image](https://user-images.githubusercontent.com/283145/110786330-4d4e7b80-826c-11eb-903a-0d5a5ac4211d.png)
