<?php

use Illuminate\Database\Seeder;

class ListMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = new App\Models\ListMenu;
        $list->name = "Appetisers";
        $list->describe = "Đồ uống khai vị";
        $list->save();
       
    }
}
