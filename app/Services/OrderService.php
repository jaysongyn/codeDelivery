<?php
namespace CodeDelivery\Services;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;

/**
 * Created by PhpStorm.
 * User: jaiso
 * Date: 26/01/2017
 * Time: 08:57
 */
class OrderService
{


    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct (
        OrderRepository $orderRepository,
        CupomRepository $cupomRepository,
        ProductRepository $productRepository)
    {

        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {

        \DB::beginTransaction();

        try {
            $data['status_id'] = 1;
            $data['user_delivery_id'] = 1;
            if(isset($data['cupom_id']))
                unset($data['cupom_id']);
            if(isset($data['cupom_code'])){
                $cupom = $this->cupomRepository->findByField('code',$data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach($items as $item){

                $item['price'] = $this->productRepository->find($item['product_id'])->price;
             //   dd($item);
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;

            if(isset($cupom)){
                $order->total = $total - $cupom->value;
            }
            $order->save();

            \DB::commit();

            return $order;

        } catch (\Exception $e){
            \DB::rollback();
            throw $e;
        }
    }

    public function updateStatus($id,$idDeliveryman,$status){
        $order = $this->orderRepository->getByIdAndDeliveryMan($id,$idDeliveryman);
        if(count($order)){
            $order->status_id = $status;
            $order->save();
            return $order;
        }
        return false;
    }
}

