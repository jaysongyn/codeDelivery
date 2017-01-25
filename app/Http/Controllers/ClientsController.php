<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClientRepository;

use CodeDelivery\Repositories\UserRepository;


use CodeDelivery\Http\Requests;

class ClientsController extends Controller
{

    private $repository;
    private $userRepository;


    public function __construct(ClientRepository $repository,UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->repository->with(['user'])->paginate(5);

        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userRepository->lists('name','id');
        return view('admin.clients.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminClientRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('admin.clients.index');
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
        $client = $this->repository->find($id);
        $users = $this->userRepository->lists('name','id');
        return view('admin.clients.edit',compact('client','users'));
    }


    public function update(Requests\AdminClientRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data,$id);
        return redirect()->route('admin.clients.index');
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
        return  redirect()->route('admin.clients.index');
    }
}
