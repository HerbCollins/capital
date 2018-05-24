<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/21 0021
 * Time: 10:02
 */

namespace App\Repositories\Eloquent;


use App\Models\Price;
use App\Repositories\Contracts\PriceRepository as PriceRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class PriceRepositoryEloquent extends BaseRepository implements PriceRepositoryInterface
{
    public function model()
    {
        return Price::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($columns = ["*"])
    {
        $list = $this->all($columns)->toArray();

        return $list;
    }

    public function createPrice(array $attributes)
    {
        $rst = $this->create($attributes);
        if($rst)
            flash('价格新增成功', 'success');
        else
            flash('价格新增失败' , 'error');

        return $rst;
    }

}