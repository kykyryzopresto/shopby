<?php
namespace App\Http\Controllers\Parser;

use App\Models\Parser;
use App\Services\Parser\Service;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class IndexController
{
    private $container;

    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        try {
            if(count($queryParams)>0){
                $sqlFilter = Service::prepareFilters($queryParams);
                $queryParams = array_values($queryParams);

                $result = Parser::getAllByFilter($queryParams, $sqlFilter);
            } else {
                $result = Parser::getAll();
            }

            $response->getBody()->write(json_encode($result));

            return $response;

        } catch (\Exception $exception){
            $response->getBody()->write($exception->getMessage());
            return $response->withStatus(500);

        }
    }

    public function store(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $items = file_get_contents('https://api.nbrb.by/exrates/rates?periodicity=0');

            if(!empty($items)) {
                $items = json_decode($items,true);
                foreach ($items as $item) {

                    $unique = ["Date" => $item["Date"],"Cur_Abbreviation" => $item["Cur_Abbreviation"]];
                    $sqlFilter = Service::prepareFilters($unique,"AND ");
                    $queryParams = array_values($unique);

                    if(!Parser::isExists($queryParams,$sqlFilter))
                    {
                        $sqlFilterInsert = Service::prepareFilters($item);
                        $queryParamsInsert = array_values($item);
                        Parser::store($queryParamsInsert, $sqlFilterInsert);
                    }

                }
                return $response->withStatus(200);
            } else {
                return $response->withStatus(500);
            }

        } catch (\Exception $exception){
            $response->getBody()->write($exception->getMessage());
            return $response->withStatus(500);

        }


    }

    /*public function show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $response->getBody()->write("Show page: $id");
        return $response;
    }
    public function update(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $response->getBody()->write("Update page: $id");
        return $response;
    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $response->getBody()->write("Delete page: $id");
        return $response;
    }*/



}
