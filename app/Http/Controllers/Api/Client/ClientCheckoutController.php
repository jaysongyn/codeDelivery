<?php

namespace CodeDelivery\Http\Controllers\Api\Client;


use CodeDelivery\Repositories\OrderRepository;

use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;


use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController  extends Controller
{
    private $repository;

    private $with =[
        'client',
        'cupom',
        'items.product'
    ];

    /**
     * @var $service
     */
    private $service;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        OrderRepository $repository,
        OrderService $service,
        UserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $id = Authorizer::getResourceOwnerId();
        $clientid = $this->userRepository->find($id)->client->id;
        $orders = $this->repository->skipPresenter(false)->with($this->with)->scopeQuery(function($query) use ($clientid){
          return   $query->where('client_id','=', $clientid);
        })->paginate(2);

        return $orders;
    }

    public  function  store(Requests\CheckoutRequest $request)
    {
        $id = Authorizer::getResourceOwnerId();
        $data = $request->all();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->service->create($data);
        $orders = $this->repository->skipPresenter(false)->with($this->with)->find($order->id);
        return $orders;
    }

    public function show($id)
    {
       return $order = $this->repository->skipPresenter(false)->with($this->with)->find($id);
    }


}
