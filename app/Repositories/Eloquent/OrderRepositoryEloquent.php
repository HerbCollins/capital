<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/21 0021
 * Time: 16:44
 */

namespace App\Repositories\Eloquent;


use App\Models\Order;
use App\Repositories\Contracts\OrderRepository as OrderRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepositoryEloquent extends BaseRepository implements OrderRepositoryInterface
{
    const PAGE_COUNT = 20;

    public function model()
    {
        return Order::class;
    }

    public function boot()
    {

        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createOrder(array $attrs)
    {
        $attrs['hash_no'] = time().rand(1000 , 9999);

        $rst = $this->create($attrs);
        if($rst)
            flash('订单新增成功', 'success');
        else
            flash('订单新增失败' , 'error');

        return $rst;
    }

    public function getAll($columns = ["*"])
    {
        $list = $this->all($columns)->toArray();
        foreach ($list as $key => $value) {
            $list[$key]['button'] = $this->model->getActionButtons('orders',$value['id']);
        }
        return $list;
    }

    public function findWithPaginate(array $where , $columns = ["*"])
    {
        $list = $this->where($where)->paginate(self::PAGE_COUNT,$columns);

        foreach ($list as $key => $value) {
            $list[$key]['button'] = $this->model->getActionButtons('orders',$value['id']);
        }
        return $list;
    }
}