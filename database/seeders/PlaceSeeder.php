<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Place;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // إضافة الفئات
        $category1 = Category::create(['title' => 'أسواق', 'slug' => 'souks']);
        $category2 = Category::create(['title' => 'مطاعم', 'slug' => 'restaurants']);
        $category3 = Category::create(['title' => 'صيدليات', 'slug' => 'pharmacies']);

        // إضافة المستخدمين
        $user1 = User::create([
            'name' => 'أحمد ناصر',
            'email' => 'ahmed@example.com',
            'password' => bcrypt('password'), // تأكد من تشفير كلمة المرور
            'role_id' => 1, // مثلا role_id 1 يعني أدمن
        ]);

        $user2 = User::create([
            'name' => 'محمد علي',
            'email' => 'mohamed@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        $user3 = User::create([
            'name' => 'سارة خالد',
            'email' => 'sara@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        $user4 = User::create([
            'name' => 'لطيفة حسين',
            'email' => 'latifa@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        $user5 = User::create([
            'name' => 'أحمد محمد',
            'email' => 'ahmedmohamed@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        // حذف الأماكن السابقة لتجنب التكرار
        \DB::table('places')->truncate();

        // إضافة الأماكن وربطها بالفئات والمستخدمين
        $place = new Place();
        $place->name = "سوق مكة";
        $place->slug = 'سوق-مكة';
        $place->image = "physical-map.jpg";
        $place->category_id = $category1->id;
        $place->overview = "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث";
        $place->address = "الطريق الدائري الثالث، حي الهجرة، مكة ، المملكة العربية السعودية";
        $place->user_id = $user1->id; // ربط المستخدم بـ Place
        $place->latitude = 21.3924513;
        $place->longitude = 39.8226124;
        $place->view_count = 3;
        $place->save();

        $place = new Place();
        $place->name = 'مطعم مكة';
        $place->slug = 'مطعم-مكة';
        $place->image = 'physical-map.jpg';
        $place->category_id = $category2->id;
        $place->overview = "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث...";
        $place->address = 'الكعكية، مكة ، المملكة العربية السعودية';
        $place->user_id = $user2->id; // ربط المستخدم بـ Place
        $place->latitude = '35.743330';
        $place->longitude = '-5.819870';
        $place->view_count = 2;
        $place->save();

        $place = new Place();
        $place->name = 'صيدلية مكة';
        $place->slug = 'صيدلية-مكة';
        $place->image = 'physical-map.jpg';
        $place->category_id = $category3->id;
        $place->overview = "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث...";
        $place->address = 'شارع ذات النطاقين، الهجرة، مكة ، المملكة العربية السعودية';
        $place->user_id = $user3->id; // ربط المستخدم بـ Place
        $place->latitude = '21.357680';
        $place->longitude = '39.860840';
        $place->view_count = 1;
        $place->save();

        $place = new Place();
        $place->name = 'صيدلية الشهد';
        $place->slug = 'صيدلية-الشهد';
        $place->image = 'physical-map.jpg';
        $place->category_id = $category3->id;
        $place->overview = "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث...";
        $place->address = 'شارع خالد بن عبدالعزيز،، العزيزية الجنوبية، مكة ، المملكة العربية السعودية';
        $place->user_id = $user4->id; // ربط المستخدم بـ Place
        $place->latitude = '21.431800';
        $place->longitude = '39.291380';
        $place->view_count = 0;
        $place->save();
    }
}
