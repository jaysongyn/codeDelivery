<?php

namespace CodeDelivery\Http\Controllers\Api\DeliveryMan;


use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliveryManController extends Controller
{

    private $with =[
        'client',
        'cupom',
        'items.product'
    ];

    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(
        OrderRepository $repository,
        OrderService $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();

        $orders = $this->repository->skipPresenter(true)->with($this->with)->scopeQuery(function ($query) use ($id) {
            return $query->where('user_delivery_id', '=', $id);
        })->paginate();

        return $orders;
    }

    public function  store(Request $request)
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
        $idDeliveryMan = Authorizer::getResourceOwnerId();
        return $this->repository->skipPresenter(false)->with(['client','items.product.category','cupom'])->getByIdAndDeliveryMan($id, $idDeliveryMan);

    }

    public function updateStatus(Request $request,$id)
    {
        $idDeliveryMan = Authorizer::getResourceOwnerId();
        $order = $this->service->updateStatus($id,$idDeliveryMan,$request->get('status_id'));
        if($order)
        {
            return $this->repository->find($order->id);
        }

        abort(400,"Order não encontrado");
    }


}
