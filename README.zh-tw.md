# Laravel Menu Architect
[![Total Downloads](https://poser.pugx.org/rc1021/laravel-menu-architect/downloads.svg)](https://packagist.org/packages/rc1021/laravel-menu-architect)
[![License](https://poser.pugx.org/rc1021/laravel-menu-architect/license.svg)](https://packagist.org/packages/rc1021/laravel-menu-architect)


一個便捷、快速、好用的 Laravel Menu 建構包 [Laravel](http://laravel.com/)

![Laravel Menu Architect](https://raw.githubusercontent.com/rc1021/laravel-menu-architect/master/screenshot.png)

## 下載安裝

```bash
composer require rc1021/laravel-menu-architect
```

如果 Laravel 專案小於 5.5 請修改 `config/app.php` :

在 `providers` 陣列裡加入以下內容

```php
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,

        ...

        Rc1021\LaravelMenuArchitect\LaravelMenuArchitectServiceProvider::class,

        ...

],
```

接著將 `'MenuArct'    => Rc1021\LaravelMenuArchitect\Facades\MenuArct::class` 加到 `$aliases` 陣列索引中:

```php
'aliases' => [

    'App'       => Illuminate\Support\Facades\App::class,
    'Artisan'   => Illuminate\Support\Facades\Artisan::class,
    ...
    'MenuArct'      => Rc1021\LaravelMenuArchitect\Facades\MenuArct::class,

],
```

完成後就可以在程式中，使用 `MenuArct` 別名了。


接著，在終端機使用下列指令，將此包的組態檔、視圖、資料遷移檔發佈到專案中：
```bash
php artisan vendor:publish --provider="Rc1021\\LaravelMenuArchitect\\LaravelMenuArchitectServiceProvider"
```

## 開始使用

啟動專案伺服器

```bash
php artisan serve
```

使用瀏覧器打開 [http://127.0.0.1:8000/menu_arct](http://127.0.0.1:8000/menu_arct) 就能開使編輯選單了。

## Demo 的資料

您可以使用 `seeder` 加入 Demo 的資料
```bash
php artisan db:seed --class=MenuArchitectSeeder
```

接著，在任何一個視圖中加入以下代碼：
```php
{!! menu_arct('admin') !!}
```

您指定的選單就會出現在畫面中。

## 選單資料輸出

您可以使用以下的代碼取得 `array` 和 `json` 資料格式：

```php
$arr_menu = menu_arct('admin', '_array');
$json_menu = menu_arct('admin', '_json');
```

## 視圖輸出

- `{!! menu_arct('admin', 'adminlte') !!}`
- `{!! menu_arct('admin', 'bootstrap') !!}`
- `{!! menu_arct('admin', 'nestable') !!}`

![Display Menu](https://raw.githubusercontent.com/rc1021/laravel-menu-architect/master/output_display.png)

## 操作指定的選單資料

您可以自訂一些方法操作選單資料，以下的例子說明怎麼取得第2級項目：

```php 
$customize_func = function ($menu) 
{
    // $menu: 是主要選單的 model
    // $menu->items: 選單項目列表
    // $menu->buildTree(): 有階層的項目陣列

    $collection = collect($menu->items);
    $filtered = $collection->filter(function ($item, $key) {
        return $item['depth'] == 2 and isset($item['children']);
    });
    return $filtered->all();
}

$customize_data = menu_arct('admin', 'key', ['key' => $customize_func]);
```

## 自訂您的視圖

![Custom View](https://raw.githubusercontent.com/rc1021/laravel-menu-architect/master/custom_view.png)

您也可以在專案路徑 `resources/views/vendor/menu_architect/display` 加入客製化的視圖。

```php
// your_view.blade.php

// $menu: 是主要選單的 model
// $menu->items: 選單項目列表
// $items: 有階層的項目陣列

<ul class="sidebar-menu tree" data-widget="tree">
    @foreach ($items as $item)
        <li class="header {{$item['class']}}" style="{{empty($item['color'])?:'color:'.$item['color']}}">{{$item['label']}}</li>
        @if(isset($item['children']))
            @each('menu_architect::menu.display.adminlte_list', $item['children'], 'item')
        @endif
    @endforeach
</ul>
```

接著使用此代碼 `menu_arct('admin', 'your_view')` 顯示選單項目的網頁結構。

## 意見和想法

如果有什麼建議、想法或問題，請到 `issue` 頁面留下記錄。


## 貢獻

如果您可以改進或添加任何功能，請隨時提交請求請求。

## Credits

* [許益銘 rc1021](https://github.com/rc1021)
* [All Contributors](https://github.com/rc1021/laravel-menu-architect/graphs/contributors)

## 授權

* Laravel Menu Architect *是根據MIT許可條款分發的免費軟件。