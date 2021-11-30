<?php

use Projekt\Api\UserTodo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app){

    $app->get('/users_todos', function(Request $request, Response $response){
        $usersTodos = UserTodo::all();
        $kimenet= $usersTodos->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json');
    });

    $app->get('/user_todos/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $userTodo = UserTodo::find($args['id']);
        if ($userTodo === null) {
            $ki = json_encode(['error' => 'Nincs ilyen User ID-val teendő']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $kimenet= $userTodo->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });

    $app->post('/users_todos',function(Request $request,Response $response){
        $input=json_decode($request-> getBody(),true);
        $userTodo=UserTodo::create($input);
        
        $userTodo->save();

        $kimenet=$userTodo->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');
    });

    $app->delete('/user_todos/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $userTodo = UserTodo::find($args['id']);
        if ($userTodo === null) {
            $ki = json_encode(['error' => 'Nincs ilyen User ID-val teendő']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $userTodo->delete();
        return $response
            ->withStatus(204);
    });


    /*
    todo_id-t hozzá kell adni az adatbázishoz és úgy írni utat hozzá, 
        hogy a felhasználó szerint az összes teendőt lehessen listázni
    */ 

    


};