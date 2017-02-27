<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\ProductRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientProductController  extends Controller
{
    private $repository;


    /**
     * @var $service
     */
    private $service;


    public function __construct(
        ProductRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->skipPresenter(false)->all();
        return $products;
    }


}
