<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClientRepository;

use CodeDelivery\Repositories\OrderItemRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\StatusRepository;
use CodeDelivery\Repositories\UserRepository;


use CodeDelivery\Http\Requests;
use Symfony\Component\HttpKernel\Client;

class OrdersController extends Controller
{

    private $repository;
    private $clientRepository;
    private $userRepository;
    private $statusRepository;
    private $orderItemRepository;


    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        ClientRepository $clientRepository,
        OrderItemRepository $orderItemRepository,
        StatusRepository $statusRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->statusRepository = $statusRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->repository->with(['client.user','deliveryman','status'])->paginate(5);

        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userRepository->lists('name','id');
        return view('admin.orders.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminOrderRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('admin.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->repository->find($id);
        $users = $this->userRepository->lists('name','id');
        $status = $this->statusRepository->lists('name','id');
        $clients = $this->clientRepository->with('user','status');
        return view('admin.orders.edit',compact('order','users','clients','status'));
    }


    public function update(Requests\AdminOrderRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data,$id);
        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return  redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function items($id)
    {
        $orderItems = $this->orderItemRepository->with(['product'])->findWhere(['order_id' => $id]);
        return view('admin.orderItems.index',compact('orderItems'));
    }
}
