<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rc1021\LaravelMenuArchitect\Facades\MenuArct;

class MenuArchitectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_id = DB::table(MenuArct::model('MenuArchitect')->getTable())->insert([
            'name' => 'admin',
        ]);

        DB::table(MenuArct::model('MenuArchitectItem')->getTable())->insert([
            [
              "id" => 1,
              "label" => "Main Navigation",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 0,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 0,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 05:02:17",
              "updated_at" => "2020-03-16 12:51:56",
              "role_id" => 0,
            ],
            [
              "id" => 3,
              "label" => "Account Settings",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 0,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 0,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 11:25:47",
              "updated_at" => "2020-03-15 11:25:47",
              "role_id" => 0,
            ],
            [
              "id" => 5,
              "label" => "Labels",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 0,
              "sort" => 3,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 0,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 11:26:32",
              "updated_at" => "2020-03-15 11:26:32",
              "role_id" => 0,
            ],
            [
              "id" => 22,
              "label" => "Pages",
              "link" => "/pages",
              "route" => null,
              "query_string" => null,
              "parent_id" => 1,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#E91E63F2",
              "target" => "_self",
              "created_at" => "2020-03-15 12:46:20",
              "updated_at" => "2020-03-16 14:51:31",
              "role_id" => 0,
            ],
            [
              "id" => 23,
              "label" => "Profile",
              "link" => "/profile",
              "route" => null,
              "query_string" => null,
              "parent_id" => 3,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:46:41",
              "updated_at" => "2020-03-16 13:36:23",
              "role_id" => 0,
            ],
            [
              "id" => 24,
              "label" => "Change Password",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 3,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:47:00",
              "updated_at" => "2020-03-15 12:47:00",
              "role_id" => 0,
            ],
            [
              "id" => 25,
              "label" => "Multi Level",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 0,
              "sort" => 4,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 0,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:47:11",
              "updated_at" => "2020-03-15 12:47:11",
              "role_id" => 0,
            ],
            [
              "id" => 26,
              "label" => "Level 1",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 25,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:50:45",
              "updated_at" => "2020-03-15 12:50:45",
              "role_id" => 0,
            ],
            [
              "id" => 27,
              "label" => "Level 1",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 25,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:50:49",
              "updated_at" => "2020-03-15 12:50:49",
              "role_id" => 0,
            ],
            [
              "id" => 28,
              "label" => "Level 1",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 25,
              "sort" => 3,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:50:52",
              "updated_at" => "2020-03-15 12:50:52",
              "role_id" => 0,
            ],
            [
              "id" => 29,
              "label" => "Level 2",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 27,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 2,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:02",
              "updated_at" => "2020-03-15 12:51:02",
              "role_id" => 0,
            ],
            [
              "id" => 30,
              "label" => "Level 2",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 27,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 2,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:06",
              "updated_at" => "2020-03-15 12:51:06",
              "role_id" => 0,
            ],
            [
              "id" => 31,
              "label" => "Level 3",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 30,
              "sort" => 1,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 3,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:12",
              "updated_at" => "2020-03-15 12:51:12",
              "role_id" => 0,
            ],
            [
              "id" => 32,
              "label" => "Level 3",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 30,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 3,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:16",
              "updated_at" => "2020-03-15 12:51:16",
              "role_id" => 0,
            ],
            [
              "id" => 33,
              "label" => "important",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 5,
              "sort" => 2,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:24",
              "updated_at" => "2020-03-15 12:51:24",
              "role_id" => 0,
            ],
            [
              "id" => 34,
              "label" => "warning",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 5,
              "sort" => 3,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:31",
              "updated_at" => "2020-03-15 12:51:31",
              "role_id" => 0,
            ],
            [
              "id" => 35,
              "label" => "information",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 5,
              "sort" => 4,
              "class" => null,
              "menu_id" => $menu_id,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 12:51:38",
              "updated_at" => "2020-03-15 12:51:38",
              "role_id" => 0,
            ],
            [
              "id" => 36,
              "label" => "aaaa",
              "link" => null,
              "route" => null,
              "query_string" => null,
              "parent_id" => 5,
              "sort" => 1,
              "class" => null,
              "menu_id" => 5,
              "depth" => 1,
              "icon" => null,
              "color" => "#000000",
              "target" => "_self",
              "created_at" => "2020-03-15 23:24:40",
              "updated_at" => "2020-03-15 23:24:40",
              "role_id" => 0,
            ],
          ]);
    }
}
