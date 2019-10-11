<?php

namespace SoftwareBackend\Menu\Handler;

use Encore\Admin\Facades\Admin;

class MenuHandler
{
    public static function shouldShowMenu($menu)
    {
        //$menu = resolve('Encore\Admin\Admin');
        //$menu = \Encore\Admin\Facades\Admin::menu();
        //dd($menu);
        //$menu = Admin::menu();
        $permissionPaths = self::getPermissionPaths();
        if(!isset($menu['children'])){
            return self::judge($menu['uri'], $permissionPaths);
        }else{
            foreach ($menu['children'] as $item){
                if(self::judge($item['uri'], $permissionPaths))
                    return true;
            }
        }
        return false;
    }

    public static function judge($path, $permissionPaths){
        if(Admin::user()->isAdministrator()){
            return true;
        }
        $path = self::makePath($path);
        foreach ($permissionPaths as $permission){
            $permissionPath = self::makePath($permission);
            if(strpos($path, trim($permissionPath, '*')) !== false && $permission !== '/'){
                return true;
            }
            if($permissionPath === $path){
                return true;
            }
        }
        return false;
    }

    public static function getPermissionPaths()
    {
        $permissions = Admin::user()->allPermissions();
        $paths = [];
        foreach ($permissions as $permission){
            if($permission['http_path'] != ""){
                $paths = array_merge($paths, explode("\r\n", $permission['http_path']));
            }
        }
        return array_unique($paths);
    }

    private static function makePath($path)
    {
        return mb_strtolower(trim(config('admin.route.prefix'), '/').'/'.trim($path, '/'));
    }
}