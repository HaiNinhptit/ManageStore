<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //create admin rules=1
        DB::table('users')->insert([
            ['name' => 'Hai Ninh','email' => 'daoninh@gmail.com','password' => bcrypt('haininh123'), 'rules' => 1, 'flag' => 1, 'email_confirm_token' => str_random(20), 'password_reset_token' => str_random(20)],
            ['name' => 'Ngoc Lan','email' => 'ngoclan@gmail.com','password' => bcrypt('ngoclan123'), 'rules' => 1, 'flag' => 1, 'email_confirm_token' => str_random(20), 'password_reset_token' => str_random(20)],
            ['name' => 'Ngoc Thuy','email' => 'ngocthuy@gmail.com','password' => bcrypt('ngocthuy123'), 'rules' => 1, 'flag' => 1, 'email_confirm_token' => str_random(20), 'password_reset_token' => str_random(20)],
            ['name' => 'Pham Thuong','email' => 'phamthuong@gmail.com','password' => bcrypt('phamthuong123'), 'rules' => 1, 'flag' => 1, 'email_confirm_token' => str_random(20), 'password_reset_token' => str_random(20)],
        ]);
        //create category
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Athletic Shoes','trademark' => 'Woman'],
            ['id' => 2, 'name' => 'High Heels','trademark' => 'Woman'],
            ['id' => 3, 'name' => 'Flat Shoes','trademark' => 'Woman'],
            ['id' => 4, 'name' => 'Athletic Shoes','trademark' => 'Man'],
            ['id' => 5, 'name' => 'Leather Shoes','trademark' => 'Man'],
            ['id' => 6, 'name' => 'Athletic Shoes','trademark' => 'Kid'],
            ['id' => 7, 'name' => 'Flat Shoes','trademark' => 'Kid'],
        ]);
        //create product
        DB::table('products')->insert([
            ['name' => 'Thể Thao Trắng Đen','description' => 'Có đủ size', 'category_id' => 1 ,'price' => 300000],
            ['name' => 'Trắng Thêu Hoa','description' => 'Tùy chọn hình thêu', 'category_id' => 1 ,'price' => 450000 ],
            ['name' => 'Slip on đinh da bóng','description' => 'Có 2 màu trắng, đen', 'category_id' => 1 ,'price' => 500000],
            ['name' => 'Giày thể thao không dây','description' => 'Có 3 màu đen, trắng, hồng', 'category_id' => 1 ,'price' => 550000 ],
            ['name' => 'Convert cao cổ','description' => 'Có 4 màu đen, trắng, đỏ, xanh ', 'category_id' => 1 ,'price' => 1000000 ],
            ['name' => 'Cao gót ánh kim','description' => 'Cao 7 và 12 phân', 'category_id' => 2 ,'price' => 700000 ],
            ['name' => 'Đen mũi tròn có dây gài','description' => 'Cao 5,7 phân ', 'category_id' => 2 ,'price' => 500000 ],
            ['name' => 'Hở mũi quai đan','description' => 'Có 2 màu đen , nude', 'category_id' => 2 ,'price' => 1200000 ],
            ['name' => 'Đen quai chéo','description' => 'Có 7 phân và 12 phân', 'category_id' => 2 ,'price' => 1000000],
            ['name' => 'Búp bê có nơ','description' => 'có 2 màu hồng, đen', 'category_id' => 3 ,'price' => 350000],
            ['name' => 'Búp bê mũi nhọn nơ chìm','description' => 'Có 2 màu hồng, trắng', 'category_id' => 3 ,'price' => 400000],
            ['name' => 'Búp bê nơ ngang','description' => 'Có thể tháo nơ', 'category_id' => 3 ,'price' => 450000 ],
            ['name' => 'Búp bê đính hoa','description' => 'Có 3 màu đen, hồng, trắng', 'category_id' => 3 ,'price' => 480000],
            ['name' => 'Cao cổ màu xám nhạt','description' => 'Có 2 màu xám, đen', 'category_id' => 4 ,'price' => 1300000 ],
            ['name' => 'Thể thao trắng','description' => 'Đủ size nam, nữ ', 'category_id' => 4 ,'price' => 700000],
            ['name' => 'Giày nike','description' => 'Có đủ size nam nữ', 'category_id' => 4 ,'price' => 500000],
            ['name' => 'Giày nike air','description' => 'Có đủ size nam, nữ', 'category_id' => 4 ,'price' => 800000],
            ['name' => 'Giày adidas','description' => 'Có đủ size nam, nữ', 'category_id' => 4 ,'price' => 750000],
            ['name' => 'Giày da buộc dây màu nâu','description' => 'Có 2 màu nâu, đen', 'category_id' => 5 ,'price' => 1500000 ],
            ['name' => 'Giày da cao cổ','description' => 'Có đủ size', 'category_id' => 5 ,'price' => 1700000],
            ['name' => 'Giày lười','description' => 'Có đủ size', 'category_id' => 5 ,'price' => 1200000],
            ['name' => 'Giày da đen buộc dây','description' => 'Có đủ size', 'category_id' => 5 ,'price' => 1500000],           
            ['name' => 'Giày da lộn cao cổ','description' => 'Có 3 màu đỏ, đen, vàng', 'category_id' => 6 ,'price' => 500000 ],
            ['name' => 'Giày da lộn thấp cổ','description' => 'Có 3 màu đỏ, đen, vàng', 'category_id' => 6 ,'price' => 450000],
            ['name' => 'Giày thể thao hồng','description' => 'Có đủ size', 'category_id' => 6 ,'price' => 350000],
            ['name' => 'Giày thể thao quai dán','description' => 'Có đủ size, có 2 màu trắng, đen', 'category_id' => 6 ,'price' => 480000],
            ['name' => 'Giày búp bê có quai đinh','description' => 'Có 2 màu trắng, đen', 'category_id' => 7 ,'price' => 450000],
           
        ]);
        //create picture
        DB::table('pictures')->insert([
            ['name' => 'bupbecoquai.jpg', 'product_id' => 27],
            ['name' => 'daloncaoco.jpg', 'product_id' => 23],
            ['name' => 'dalon.jpg', 'product_id' => 24],
            ['name' => 'thethaohong.jpg', 'product_id' => 25],
            ['name' => 'quaidan.jpg', 'product_id' => 26],           
            ['name' => 'images (14).jpg', 'product_id' => 19],
            ['name' => 'download (7).jpg', 'product_id' => 20],
            ['name' => 'download (6).jpg', 'product_id' => 21],
            ['name' => 'download (5).jpg', 'product_id' => 22],
            ['name' => 'thethaotrangden.jpg', 'product_id' => 1],
            ['name' => 'thethaotheuhoa.jpg', 'product_id' => 2],
            ['name' => 'slipondinh.jpg', 'product_id' => 3],
            ['name' => 'thethao.jpg', 'product_id' => 4],
            ['name' => 'convertallstart.jpg', 'product_id' => 5],
            ['name' => 'caogotanhkim.jpg', 'product_id' => 6],
            ['name' => 'cao3phan.jpg', 'product_id' => 7],
            ['name' => 'caoquaidan.jpg', 'product_id' => 8],
            ['name' => 'caoquaicheo.jpg', 'product_id' => 9],
            ['name' => 'images (13).jpg', 'product_id' => 10],
            ['name' => 'images (12).jpg', 'product_id' => 11],
            ['name' => 'download (4).jpg', 'product_id' => 12],
            ['name' => 'download (3).jpg', 'product_id' => 13],
            ['name' => 't2.jpg', 'product_id' => 14],
            ['name' => 'g.jpg', 'product_id' => 15],
            ['name' => 'g2.jpg', 'product_id' => 16],
            ['name' => 'g5.jpg', 'product_id' => 17],
            ['name' => 'g6.jpg', 'product_id' => 18],          
        ]);
        //create warehousing_detail
        DB::table('warehousing_detail')->insert([
            ['product_id' => 1, 'quantity' => 20, 'price' => 200000, 'date' => '2017-11-06'],
            ['product_id' => 2, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 3, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 4, 'quantity' => 30, 'price' => 400000, 'date' => '2017-11-06'],
            ['product_id' => 5, 'quantity' => 30, 'price' => 800000, 'date' => '2017-11-06'],
            ['product_id' => 6, 'quantity' => 30, 'price' => 500000, 'date' => '2017-11-06'],
            ['product_id' => 7, 'quantity' => 30, 'price' => 250000, 'date' => '2017-11-06'],
            ['product_id' => 8, 'quantity' => 30, 'price' => 900000, 'date' => '2017-11-06'],
            ['product_id' => 9, 'quantity' => 30, 'price' => 600000, 'date' => '2017-11-06'],
            ['product_id' => 10, 'quantity' => 30, 'price' => 200000, 'date' => '2017-11-06'],
            ['product_id' => 11, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 12, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 13, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 14, 'quantity' => 30, 'price' => 1000000, 'date' => '2017-11-06'],
            ['product_id' => 15, 'quantity' => 30, 'price' => 500000, 'date' => '2017-11-06'],
            ['product_id' => 16, 'quantity' => 30, 'price' => 250000, 'date' => '2017-11-06'],
            ['product_id' => 17, 'quantity' => 30, 'price' => 400000, 'date' => '2017-11-06'],
            ['product_id' => 18, 'quantity' => 30, 'price' => 350000, 'date' => '2017-11-06'],
            ['product_id' => 19, 'quantity' => 30, 'price' => 1100000, 'date' => '2017-11-06'],
            ['product_id' => 20, 'quantity' => 30, 'price' => 1400000, 'date' => '2017-11-06'],
            ['product_id' => 21, 'quantity' => 30, 'price' => 800000, 'date' => '2017-11-06'],
            ['product_id' => 22, 'quantity' => 30, 'price' => 1000000, 'date' => '2017-11-06'],
            ['product_id' => 23, 'quantity' => 30, 'price' => 300000, 'date' => '2017-11-06'],
            ['product_id' => 24, 'quantity' => 30, 'price' => 280000, 'date' => '2017-11-06'],
            ['product_id' => 25, 'quantity' => 30, 'price' => 200000, 'date' => '2017-11-06'],
            ['product_id' => 26, 'quantity' => 30, 'price' => 380000, 'date' => '2017-11-06'],
            ['product_id' => 27, 'quantity' => 30, 'price' => 260000, 'date' => '2017-11-06'],
        ]);
        //create active_product
        DB::table('active_product')->insert([
            ['product_id' => 1, 'quantity' => 20],
            ['product_id' => 2, 'quantity' => 30],
            ['product_id' => 3, 'quantity' => 30],
            ['product_id' => 4, 'quantity' => 30],
            ['product_id' => 5, 'quantity' => 30],
            ['product_id' => 6, 'quantity' => 30],
            ['product_id' => 7, 'quantity' => 30],
            ['product_id' => 8, 'quantity' => 30],
            ['product_id' => 9, 'quantity' => 30],
            ['product_id' => 10, 'quantity' => 30],
            ['product_id' => 11, 'quantity' => 30],
            ['product_id' => 12, 'quantity' => 30],
            ['product_id' => 13, 'quantity' => 30],
            ['product_id' => 14, 'quantity' => 30],
            ['product_id' => 15, 'quantity' => 30],
            ['product_id' => 16, 'quantity' => 30],
            ['product_id' => 17, 'quantity' => 30],
            ['product_id' => 18, 'quantity' => 30],
            ['product_id' => 19, 'quantity' => 30],
            ['product_id' => 20, 'quantity' => 30],
            ['product_id' => 21, 'quantity' => 30],
            ['product_id' => 22, 'quantity' => 30],
            ['product_id' => 23, 'quantity' => 30],
            ['product_id' => 24, 'quantity' => 30],
            ['product_id' => 25, 'quantity' => 30],
            ['product_id' => 26, 'quantity' => 30],
            ['product_id' => 27, 'quantity' => 30],
        ]);
      
    }
}
