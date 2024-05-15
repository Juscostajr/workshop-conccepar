<?php
namespace Jusce\WorkshopConccepar;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TodoController
{
    private TodoRepository $repository;

    public function __construct()
    {
        $this->repository = new TodoRepository();
    }

    public function about(Request $request, Response $response): Response
    {
        $content = [
            'author' => 'Juscelino Fernandes',
            'project' => 'To do List'
        ];

        $response->getBody()->write(json_encode($content));
        return $response;
    }

    public function addItem(Request $request, Response $response): Response
    {
        $todoList = $this->repository->getInstance();
        $payload = json_decode($request->getBody());
        $todoList->add(new TodoItem($payload->description));
        return $response->withStatus(200);
    }

    public function findAll(Request $request, Response $response): Response
    {
        $todoList = $this->repository->getInstance();
        $response->getBody()->write(json_encode($todoList));
        return $response;
    }

    public function editItem(Request $request, Response $response, array $args): Response
    {
        $index = $args['index'];
        $payload = json_decode($request->getBody());
        $todoList = $this->repository->getInstance();
        $description = $payload->description;
        $todoList->get($index)->setDescription($description);
        return $response->withStatus(200);
    }

    public function checkItem(Request $request, Response $response, array $args): Response
    {
        $todoList = $this->repository->getInstance();
        $index = $args['index'];

        $todoList->get($index)->setStatus(TodoStatus::CHECKED);
        return $response->withStatus(200);

    }
}