<?php

use Projekt\Api\UserTodo;
use Projekt\Api\UserData;
use Projekt\Api\UserXp;
use Projekt\Api\UserIcon;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app){

    #Users Todos rész
    $app->get('/users_todos', function(Request $request, Response $response){
        $usersTodos = UserTodo::all();
        $kimenet= $usersTodos->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json');
    });

    $app->get('/users_todos/{id}', function(Request $request, Response $response, array $args){
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

    $app->delete('/users_todos/{id}', function(Request $request,Response $response, array $args){
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


    $app->put('/users_todos/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $userTodo = UserTodo::find($args['id']);
        if($userTodo === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű todo']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $userTodo->fill($input);
        $userTodo->save();
        $response->getBody()->write($userTodo->toJson());
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });


    /*
    todo_id-t hozzá kell adni az adatbázishoz és úgy írni utat hozzá, 
        hogy a felhasználó szerint az összes teendőt lehessen listázni
    */ 

    //USER DATA RÉSZ
    $app -> get('/userek', function(Request $request, Response $response) {
        $userek = UserData::all();
        $kimenet = $userek->toJson();

        $response -> withHeader('Content-type', 'application/json')->getbody()->write($kimenet);
        return $response;
    });

    $app->post('/userek', function(Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        //Bemenet validáció!! ˇ
        $user = UserData::create($input);

        $user->save();

        $kimenet = $user->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201) //created status code
            ->withHeader('Content-type', 'application/json');
    });


    $app->delete('/userek/{id}', function (Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $user = UserData::find($args['id']);
        if($user === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $user->delete();
        return $response
            ->withStatus(204);
    });



    $app->put('/userek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $user = UserData::find($args['id']);
        if($user === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $user->fill($input);
        $user->save();
        $response->getBody()->write($user->toJson());
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });


    $app->get('/userek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $user = UserData::find($args['id']);
        if($user === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }

        $kimenet = $user->toJson();
        $response->getBody()->write($kimenet);
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });


    #USER XP RÉSZ
    $app->get('/users_xp', function(Request $request, Response $response, array $args){
        $usersXp = UserXp::all();
        $kimenet = $usersXp->toJson();

        $response -> withHeader('Content-type', 'application/json')->getbody()->write($kimenet);
        return $response;
    });



    $app->get('/users_xp/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $usersXp = UserXp::find($args['id']);
        if ($usersXp === null) {
            $ki = json_encode(['error' => 'Nem létező user.']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $kimenet= $usersXp->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });


    $app->post('/users_xp',function(Request $request,Response $response){
        $input=json_decode($request-> getBody(),true);
        //vaidáció!
        $userXp=UserXp::create($input);
    
        $userXp->save();

        $kimenet=$userXp->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');
    });

    
    $app->delete('/users_xp/{id}', function (Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $userXp = UserXp::find($args['id']);
        if($userXp === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $userXp->delete();
        return $response
            ->withStatus(204);
    });

    /*
    új felhasználó esetén a neki megfelelő ID-val rétrahozni egy új sort a postnál és az xp-t 0-ra állítani
    */ 


    $app->put('/users_xp/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $userXp = UserXp::find($args['id']);
        if($userXp === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $userXp->fill($input);
        $userXp->save();
        $response->getBody()->write($userXp->toJson());
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });








    /// ICON TÁBLA
    $app -> get('/iconok', function(Request $request, Response $response) {
        $iconok = UserIcon::all();
        $kimenet = $iconok->toJson();

        $response -> withHeader('Content-type', 'application/json')->getbody()->write($kimenet);
        return $response;
    });

    $app->post('/iconok', function(Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        //Bemenet validáció!! ˇ
        $icon = UserIcon::create($input);

        $icon->save();

        $kimenet = $icon->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201) //created status code
            ->withHeader('Content-type', 'application/json');
    });


    $app->delete('/iconok/{id}', function (Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $icon = UserIcon::find($args['id']);
        if($icon === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű icon']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $icon->delete();
        return $response
            ->withStatus(204);
    });



    $app->put('/iconok/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $icon = UserIcon::find($args['id']);
        if($icon === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű icon']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $icon->fill($input);
        $icon->save();
        $response->getBody()->write($icon->toJson());
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });


    $app->get('/iconok/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0){
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
        }

        $icon = UserIcon::find($args['id']);
        if($icon === null){
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű icon']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(404);
        }

        $kimenet = $icon->toJson();
        $response->getBody()->write($kimenet);
        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
    });





};