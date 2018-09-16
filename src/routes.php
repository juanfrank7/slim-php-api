<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/name' route");
    $name = $args['name'];
    $array1 = ['name' => $name, 'age' => 35];
    // Render index view
    $response = json_encode($array1);
    return $response;
});
	
// get all todos
$app->get('/todos', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/todos' route");
    $sth = $this->db->prepare("SELECT * FROM tasks");
    $sth->execute();
    $todos = $sth->fetchAll();
    return $this->response->withJson($todos);
});

// Retrieve todo with id 
$app->get('/todo/[{id}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/todo/id' route");
    $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
    $sth->bindParam(":id", $args['id']);
    $sth->execute();
    $todos = $sth->fetchObject();
    return $this->response->withJson($todos);
});

// Add a new todo
$app->post('/todo', function (Request $request, Response $response) {
    $this->logger->info("Slim-Skeleton '/todo/p' route");
    $input = $request->getParsedBody();
    $sql = "INSERT INTO tasks (task) VALUES (:task)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam(":task", $input['task']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

// Update todo with given id
$app->put('/todo/[{id}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/todo/id/p' route");
    $input = $request->getParsedBody();
    $sql = "UPDATE tasks SET task=:task WHERE id=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam(":id", $args['id']);
    $sth->bindParam(":task", $input['task']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});

// Remove a todo with given id
$app->delete('/todo/[{id}]', function (Request $request, Response $response, array $args) {
   $this->logger->info("Slim-Skeleton '/todo/id/d' route");
   $sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
   $sth->bindParam(":id", $args['id']);
   $sth->execute();
   return $this->response->write("deleted todo");
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
