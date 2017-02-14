<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\OauthClientRepository;
use CodeDelivery\Models\OauthClient;
use CodeDelivery\Validators\OauthClientValidator;

/**
 * Class OauthClientRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OauthClientRepositoryEloquent extends BaseRepository implements OauthClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OauthClient::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
