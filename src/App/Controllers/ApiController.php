<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{
    private $name;
    private $model;

    public function __construct($app)
    {
        $Path = explode(DIRECTORY_SEPARATOR, $app->request->getUri()->getPath());

        $Model = str_singular( studly_case( $Path[3] ) );
        $Class = "\\App\\Models\\{$Model}";

        $this->name  = $Model;
        $this->model = new $Class;
    }

    public function index (Request $request, Response $response, $args)
    {

        if ( isset ( $args['id'] ) ) {

            $return = $this->model->find( $args['id'] );
        } else {

            $return = $this->model->get();
        }

        return $response->withJSON($return, 200, JSON_UNESCAPED_UNICODE);
    }

    public function store (Request $request, Response $response)
    {

        $Post = $request->getParsedBody();

        if ( method_exists($this->model, 'StoreData') ) {

            $Post = $this->model->StoreData( $Post );
        }

        $return = $this->model->create( $Post );

        return $response->withJSON($return, 200, JSON_UNESCAPED_UNICODE);
    }

    public function update (Request $request, Response $response, $args)
    {
        $Post = (array) $request->getParsedBody();

        $Update = $this->model->find($args['id']);

        if ( method_exists($this->model, 'UpdateData') ) {

            $Post = $this->model->StoreData( $Post );
        }

        $Update->make( $Post );

        foreach ( $Post as $Key => $Value ) {

            $Update->{$Key} = $Value;
        }

        $Update->save();

        return $response->withJSON($this->model->find($args['id']), 200, JSON_UNESCAPED_UNICODE);
    }

    public function delete (Request $request, Response $response, $args)
    {

        $Delete = $this->model->find($args['id']);

        $return = ['status' => true, 'message' =>  'Record deleted successfully'];

        if (! $Delete->delete() )
        {
            $return = ['status' => false, 'message' =>  'Error deleting record'];
        }

        return $response->withJSON($return, 200, JSON_UNESCAPED_UNICODE);
    }
}