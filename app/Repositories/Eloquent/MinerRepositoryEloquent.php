<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/20 0020
 * Time: 9:22
 */

namespace App\Repositories\Eloquent;

use App\Models\Miner;
use App\Repositories\Contracts\MinerRepository as CapitalRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MinerRepositoryEloquent extends BaseRepository implements CapitalRepositoryInterface
{
    public function model()
    {
        return Miner::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createMiner(array $attributes)
    {
        $rst = $this->create($attributes);

        if($rst)
        {
            flash('创建成功' ,'success');
        }else{
            flash('创建失败' , 'error');
        }

        return $rst;
    }

    public function getAll($columns = ['*'])
    {
        $list = $this->all($columns)->toArray();
        foreach ($list as $key => $value) {
            $list[$key]['button'] = $this->model->getActionButtons('miners',$value['id']);
        }
        return $list;
    }

}