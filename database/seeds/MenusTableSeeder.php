<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemManage = new Menu();
        $systemManage->name = '系统';
        $systemManage->url = 'admin/menus';
        $systemManage->slug = 'system.manage';
        $systemManage->icon = 'fa fa-cogs';
        $systemManage->parent_id = 0;
        $systemManage->save();

        $menusManage = new Menu();
        $menusManage->name = '后台目录管理';
        $menusManage->url = 'admin/menus';
        $menusManage->slug = 'menus.list';
        $menusManage->parent_id = $systemManage->id;
        $menusManage->save();

        $adminUserManage = new Menu();
        $adminUserManage->name = '后台用户管理';
        $adminUserManage->url = 'admin/adminuser';
        $adminUserManage->slug = 'adminuser.list';
        $adminUserManage->parent_id = $systemManage->id;
        $adminUserManage->save();

        $permissionManage = new Menu();
        $permissionManage->name = '权限管理';
        $permissionManage->url = 'admin/permission';
        $permissionManage->slug = 'permission.list';
        $permissionManage->parent_id = $systemManage->id;
        $permissionManage->save();

        $roleManage = new Menu();
        $roleManage->name = '角色管理';
        $roleManage->url = 'admin/role';
        $roleManage->slug = 'role.list';
        $roleManage->parent_id = $systemManage->id;
        $roleManage->save();

        $system = new Menu();
        $system->name = "系统设置";
        $system->url = "admin/system";
        $system->slug = "admin.system";
        $system->parent_id = $systemManage->id;
        $system->save();

        $UsersManage = new Menu();
        $UsersManage->name = '用户管理';
        $UsersManage->url = 'admin/users';
        $UsersManage->slug = 'users.list';
        $UsersManage->parent_id = 0;
        $UsersManage->save();

        $UserManage = new Menu();
        $UserManage->name = '用户列表';
        $UserManage->url = 'admin/users';
        $UserManage->slug = 'users.list';
        $UserManage->parent_id = $UsersManage->id;
        $UserManage->save();

        $MinersManage = new Menu();
        $MinersManage->name = '矿机管理';
        $MinersManage->url = 'admin/miners';
        $MinersManage->slug = 'miners.list';
        $MinersManage->parent_id = 0;
        $MinersManage->save();

        $MinersListManage = new Menu();
        $MinersListManage->name = '矿机列表';
        $MinersListManage->url = 'admin/miners';
        $MinersListManage->slug = 'miners.list';
        $MinersListManage->parent_id = $MinersManage->id;
        $MinersListManage->save();

        $MinerBuyManage = new Menu();
        $MinerBuyManage->name = '矿机购买记录';
        $MinerBuyManage->url = 'admin/userminers';
        $MinerBuyManage->slug = 'userminers.list';
        $MinerBuyManage->parent_id = $MinersManage->id;
        $MinerBuyManage->save();

        $OrderManage = new Menu();
        $OrderManage->name = "订单管理";
        $OrderManage->url = "admin/Orders";
        $OrderManage->slug = "orders.list";
        $OrderManage->parent_id = 0;
        $OrderManage->save();

        $OrderList = new Menu();
        $OrderList->name = "订单列表";
        $OrderList->url = "admin/orders";
        $OrderList->slug = "orders.list";
        $OrderList->parent_id = $OrderManage->id;
        $OrderList->save();

        $OrderList = new Menu();
        $OrderList->name = "自主出售";
        $OrderList->url = "admin/orders/type/1";
        $OrderList->slug = "orders.list";
        $OrderList->parent_id = $OrderManage->id;
        $OrderList->save();

        $OrderList = new Menu();
        $OrderList->name = "自主求购";
        $OrderList->url = "admin/orders/type/2";
        $OrderList->slug = "orders.list";
        $OrderList->parent_id = $OrderManage->id;
        $OrderList->save();

        $OrderList = new Menu();
        $OrderList->name = "接单买入";
        $OrderList->url = "admin/orders/type/3";
        $OrderList->slug = "orders.list";
        $OrderList->parent_id = $OrderManage->id;
        $OrderList->save();


        $OrderList = new Menu();
        $OrderList->name = "接单卖出";
        $OrderList->url = "admin/orders/type/4";
        $OrderList->slug = "orders.list";
        $OrderList->parent_id = $OrderManage->id;
        $OrderList->save();


        $CoinPrice = new Menu();
        $CoinPrice->name = "价格管理";
        $CoinPrice->url = "admin/coinprices";
        $CoinPrice->slug = "coinprices.list";
        $CoinPrice->parent_id = 0;
        $CoinPrice->save();

        $Coin = new Menu();
        $Coin->name = "价格信息";
        $Coin->url = "admin/coinprices";
        $Coin->slug = "coinprices.list";
        $Coin->parent_id = $CoinPrice->id;
        $Coin->save();

        $CashManage = new Menu();
        $CashManage->name = "提现与充值";
        $CashManage->url = "admin/cashs";
        $CashManage->slug = "cash.manage";
        $CashManage->parent_id = 0;
        $CashManage->save();

        $CashDraw = new Menu();
        $CashDraw->name = "提现";
        $CashDraw->url = "admin/cashs/draw";
        $CashDraw->slug = "cash.manage";
        $CashDraw->parent_id = $CashManage->id;
        $CashDraw->save();

        $CashRecharge = new Menu();
        $CashRecharge->name = "充值";
        $CashRecharge->url = "admin/cashs/recharge";
        $CashRecharge->slug = "cash.manage";
        $CashRecharge->parent_id = $CashManage->id;
        $CashRecharge->save();

    }
}
