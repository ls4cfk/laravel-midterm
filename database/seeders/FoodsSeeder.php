<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Menu;

class FoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    
    {   
        $array = array(
            array('foods' => array('name' => 'pizza','price' => 10,'image_url' => "https://th.bing.com/th/id/R.f25febbcbdd9a4d973ee6a8a2d6259e4?rik=DNvn8bDTmqp7jA&pid=ImgRaw&r=0", 'description' => 'aa', 'position' => 1,'menu_category' => '1')),
            array('foods' => array('name' => 'a1','price' => 20,'image_url' => "https://th.bing.com/th/id/R.f25febbcbdd9a4d973ee6a8a2d6259e4?rik=DNvn8bDTmqp7jA&pid=ImgRaw&r=0", 'description' => 'aa', 'position' => 2,'menu_category' => '2')),
            array('foods' => array('name' => 'a2','price' => 3,'image_url' => "https://th.bing.com/th/id/R.f25febbcbdd9a4d973ee6a8a2d6259e4?rik=DNvn8bDTmqp7jA&pid=ImgRaw&r=0", 'description' => 'aa', 'position' => 3,'menu_category' => '1')),
            array('foods' => array('name' => 'a3','price' => 4,'image_url' => "https://th.bing.com/th/id/R.f25febbcbdd9a4d973ee6a8a2d6259e4?rik=DNvn8bDTmqp7jA&pid=ImgRaw&r=0", 'description' => 'aa', 'position' => 4,'menu_category' => '1')),
            array('foods' => array('name' => 'a4','price' => 120,'image_url' => "https://th.bing.com/th/id/R.f25febbcbdd9a4d973ee6a8a2d6259e4?rik=DNvn8bDTmqp7jA&pid=ImgRaw&r=0", 'description' => 'aa', 'position' => 5,'menu_category' => '2'))
    );
        foreach ($array as $element) {
            $menu = new Menu();
            $menu->fill([
                'name' => $element['foods']['name'],
                'price' => $element['foods']['price'],
                'image_url' => $element['foods']['image_url'],
                'description' => $element['foods']['description'],
                'position' => $element['foods']['position'],
                'menu_category' => $element['foods']['menu_category'],
            ])->save();
        }
    }
}