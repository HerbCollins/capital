<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->systemManage();
        $this->menus();
        $this->adminUser();
        $this->permission();
        $this->role();

        $this->notice();
    }


    /**
     * create system permission
     */
    public function systemManage()
    {
        $systemManage = New Permission();
        $systemManage->name = 'system.manage';
        $systemManage->display_name = '系统管理';
        $systemManage->description = '系统管理';
        $systemManage->save();

        $adminSystemManage = New Permission();
        $adminSystemManage->name = "admin.system";
        $adminSystemManage->display_name = "系统设置";
        $adminSystemManage->description = "系统设置";
        $adminSystemManage->save();
    }

    /**
     * create menus permission
     */
    public function menus()
    {
        $menusList = New Permission();
        $menusList->name = 'menus.list';
        $menusList->display_name = '目录列表';
        $menusList->description = '目录列表';
        $menusList->save();

        $menusAdd = New Permission();
        $menusAdd->name = 'menus.add';
        $menusAdd->display_name = '添加目录';
        $menusAdd->description = '添加目录';
        $menusAdd->save();

        $menusEdit = New Permission();
        $menusEdit->name = 'menus.edit';
        $menusEdit->display_name = '修改目录';
        $menusEdit->description = '修改目录';
        $menusEdit->save();

        $menusDelete = New Permission();
        $menusDelete->name = 'menus.delete';
        $menusDelete->display_name = '删除目录';
        $menusDelete->description = '删除目录';
        $menusDelete->save();

        $menusList = New Permission();
        $menusList->name = 'users.list';
        $menusList->display_name = '用户列表';
        $menusList->description = '用户列表';
        $menusList->save();

        $menusAdd = New Permission();
        $menusAdd->name = 'users.add';
        $menusAdd->display_name = '添加用户';
        $menusAdd->description = '添加用户';
        $menusAdd->save();

        $menusEdit = New Permission();
        $menusEdit->name = 'users.edit';
        $menusEdit->display_name = '修改用户';
        $menusEdit->description = '修改用户';
        $menusEdit->save();

        $menusDelete = New Permission();
        $menusDelete->name = 'users.delete';
        $menusDelete->display_name = '删除用户';
        $menusDelete->description = '删除用户';
        $menusDelete->save();

        $minerList = New Permission();
        $minerList->name = 'miners.list';
        $minerList->display_name = '矿机列表';
        $minerList->description = '矿机列表';
        $minerList->save();

        $minerAdd = New Permission();
        $minerAdd->name = 'miners.add';
        $minerAdd->display_name = '添加矿机';
        $minerAdd->description = '添加矿机';
        $minerAdd->save();

        $minerEdit = New Permission();
        $minerEdit->name = 'miners.edit';
        $minerEdit->display_name = '修改矿机';
        $minerEdit->description = '修改矿机';
        $minerEdit->save();

        $minerDelete = New Permission();
        $minerDelete->name = 'miners.delete';
        $minerDelete->display_name = '删除矿机';
        $minerDelete->description = '删除矿机';
        $minerDelete->save();

        $userminerList = New Permission();
        $userminerList->name = 'userminers.list';
        $userminerList->display_name = '矿机购买记录';
        $userminerList->description = '矿机购买记录';
        $userminerList->save();

        $userminerDelete = New Permission();
        $userminerDelete->name = 'userminers.delete';
        $userminerDelete->display_name = '删除矿机购买记录';
        $userminerDelete->description = '删除矿机购买记录';
        $userminerDelete->save();

        $orderList = New Permission();
        $orderList->name = 'orders.list';
        $orderList->display_name = '订单列表';
        $orderList->description = '订单列表';
        $orderList->save();

        $orderAdd = New Permission();
        $orderAdd->name = 'orders.add';
        $orderAdd->display_name = '增加订单';
        $orderAdd->description = '增加订单';
        $orderAdd->save();;

        $orderDelete = New Permission();
        $orderDelete->name = 'orders.delete';
        $orderDelete->display_name = '删除订单';
        $orderDelete->description = '删除订单';
        $orderDelete->save();

        $orderEdit = New Permission();
        $orderEdit->name = 'orders.edit';
        $orderEdit->display_name = '编辑订单';
        $orderEdit->description = '编辑订单';
        $orderEdit->save();

        $coinList = New Permission();
        $coinList->name = "coinprices.list";
        $coinList->display_name = "价格信息";
        $coinList->description = '价格信息';
        $coinList->save();

        $coinAdd = New Permission();
        $coinAdd->name = "coinprices.add";
        $coinAdd->display_name = "增加价格";
        $coinAdd->description = '增加价格';
        $coinAdd->save();

        $coinAdd = New Permission();
        $coinAdd->name = "coinprices.axis";
        $coinAdd->display_name = "价格图表";
        $coinAdd->description = '价格图表';
        $coinAdd->save();

        $coinDelete = New Permission();
        $coinDelete->name = "coinprices.delete";
        $coinDelete->display_name = "删除价格";
        $coinDelete->description = '删除价格';
        $coinDelete->save();

        $cash = New Permission();
        $cash->name = 'cash.manage';
        $cash->display_name = '提现与充值';
        $cash->description = '提现与充值';
        $cash->save();


    }

    /**
     * create admin user permission
     */
    public function adminUser()
    {
        $adminUserList = New Permission();
        $adminUserList->name = 'adminuser.list';
        $adminUserList->display_name = '后台用户列表';
        $adminUserList->description = '后台用户列表';
        $adminUserList->save();

        $adminUserAdd = New Permission();
        $adminUserAdd->name = 'adminuser.add';
        $adminUserAdd->display_name = '添加后台用户';
        $adminUserAdd->description = '添加后台用户';
        $adminUserAdd->save();

        $adminUserEdit = New Permission();
        $adminUserEdit->name = 'adminuser.edit';
        $adminUserEdit->display_name = '修改后台用户';
        $adminUserEdit->description = '修改后台用户';
        $adminUserEdit->save();

        $adminUserDelete = New Permission();
        $adminUserDelete->name = 'adminuser.delete';
        $adminUserDelete->display_name = '删除后台用户';
        $adminUserDelete->description = '删除后台用户';
        $adminUserDelete->save();
    }

    /**
     * create permission permission
     */
    public function permission()
    {
        $permissionList = New Permission();
        $permissionList->name = 'permission.list';
        $permissionList->display_name = '权限列表';
        $permissionList->description = '权限列表';
        $permissionList->save();

        $permissionAdd = New Permission();
        $permissionAdd->name = 'permission.add';
        $permissionAdd->display_name = '添加权限';
        $permissionAdd->description = '添加权限';
        $permissionAdd->save();

        $permissionEdit = New Permission();
        $permissionEdit->name = 'permission.edit';
        $permissionEdit->display_name = '修改权限';
        $permissionEdit->description = '修改权限';
        $permissionEdit->save();

        $permissionDelete = New Permission();
        $permissionDelete->name = 'permission.delete';
        $permissionDelete->display_name = '删除权限';
        $permissionDelete->description = '删除权限';
        $permissionDelete->save();
    }

    /**
     * create role permission
     */
    public function role()
    {
        $roleList = New Permission();
        $roleList->name = 'role.list';
        $roleList->display_name = '角色列表';
        $roleList->description = '角色列表';
        $roleList->save();

        $roleAdd = New Permission();
        $roleAdd->name = 'role.add';
        $roleAdd->display_name = '添加角色';
        $roleAdd->description = '添加角色';
        $roleAdd->save();

        $roleEdit = New Permission();
        $roleEdit->name = 'role.edit';
        $roleEdit->display_name = '修改角色';
        $roleEdit->description = '修改角色';
        $roleEdit->save();

        $roleDelete = New Permission();
        $roleDelete->name = 'role.delete';
        $roleDelete->display_name = '删除角色';
        $roleDelete->description = '删除角色';
        $roleDelete->save();
    }


    public function notice()
    {
        $list = New Permission();
        $list->name = 'notice.list';
        $list->display_name = '公告列表';
        $list->description = '公告列表';
        $list->save();

        $add = New Permission();
        $add->name = 'notice.add';
        $add->display_name = '添加公告';
        $add->description = '添加公告';
        $add->save();

        $edit = New Permission();
        $edit->name = 'notice.edit';
        $edit->display_name = '修改公告';
        $edit->description = '修改公告';
        $edit->save();

        $delete = New Permission();
        $delete->name = 'notice.delete';
        $delete->display_name = '删除公告';
        $delete->description = '删除公告';
        $delete->save();
    }
}
