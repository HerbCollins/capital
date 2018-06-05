<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/6/5 0005
 * Time: 13:15
 */

namespace App\Repositories\Eloquent;


use App\Models\Notice;
use App\Repositories\Contracts\NoticeRepository as NoticeRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class NoticeRepositoryEloquent extends BaseRepository implements NoticeRepositoryInterface
{
    public function model()
    {
        return Notice::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createNotice(array $attributes)
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
        $list = $this->orderBy('updated_at','desc')->all($columns);
        foreach ($list as $key => &$value) {
            $value->button = $this->model->getActionButtons('notices',$value['id']);
        }
        return $list;
    }

}