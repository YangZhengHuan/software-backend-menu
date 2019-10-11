<?php

namespace SoftwareBackend\Menu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(MenuExtension $extension)
    {
        if (!MenuExtension::boot()) {
            return;
        }


        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'software-backend-menu');
        }

        //$menuPath = view('software-backend-menu::partials.menu')->getPath();
        //$menuAdminPath = view('admin::partials.menu')->getPath();
        //view()->replaceNamespace('admin::partials.menu', $menuPath);
        //app('view')->prependNamespace('admin::partials.menu', $menuPath);

/*      $replacePath = view('software-backend-menu::partials.menu')->getPath();//直接修改文件内容
        $replaceMenu = file_get_contents($replacePath);
        $path = view('admin::partials.menu')->getPath();
        $menu = file_get_contents($path);
        if ($replaceMenu != $menu) {
            @mkdir($path, 0777, true);
            file_put_contents($path, $replaceMenu);
        }*/

/*      $path = view('admin::partials.sidebar')->getPath();//修改sidebar文件中指定的menu文件
        $sidebar = file_get_contents($path);
        if (strpos($sidebar, 'software-backend-menu::partials.menu') === false) {
            $replaceSidebar = str_replace("admin::partials.menu","software-backend-menu::partials.menu",$sidebar);
            @mkdir($path, 0777, true);
            file_put_contents($path, $replaceSidebar);
        }*/

    }
}