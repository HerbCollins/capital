<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/19 0019
 * Time: 17:16
 */

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepositoryInterface
{
    const DEFAULT_PWD = '123456';
    /**
     * Specify Model class name
     *
     * @return string
     * @author Maker <maker68@163.com>
     */
    public function model()
    {
        return User::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createUser(array $attributes)
    {
        $attributes['password'] = self::DEFAULT_PWD;

        $attributes['hash'] = time() . rand(10 , 99);

        $rst = $this->create($attributes);
        if($rst)
            flash('用户新增成功', 'success');
        else
            flash('用户新增失败' , 'error');

        return $rst;
    }

    public function getAll($columns = ['*'])
    {
        $list = $this->all($columns)->toArray();
        foreach ($list as $key => $value) {
            $list[$key]['button'] = $this->model->getActionButtons('users',$value['id']);
        }
        return $list;

    }

}