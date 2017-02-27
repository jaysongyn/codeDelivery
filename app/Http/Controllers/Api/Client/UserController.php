<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Repositories\UserRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function authenticated()
    {
        return $this->userRepository->skipPresenter(false)->find(Authorizer::getResourceOwnerId());
    }

}
