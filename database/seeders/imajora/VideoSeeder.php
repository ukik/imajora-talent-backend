<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

# php artisan db:seed --class=VideoSeeder

class VideoSeeder extends Seeder {

    public
    function run()
    {
        $faker = \Faker\Factory::create();

        // $this->INSERT_ARTIKEL();
        // $this->INSERT_GAMBAR();
        // $this->INSERT_KONSULTASI();
        // $this->INSERT_JAWABAN_KONSULTASI();
        // $this->INSERT_VIDEO();
        // $this->INSERT_PRODUK();
        // $this->INSERT_STATUS();

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \DB::table('user_video_comments')->delete();
        // \DB::table('user_video_comments')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $this->FIRST($faker);
        // $this->SECOND($faker);
        // $this->THIRD($faker);
        return;

    }
    function THIRD($faker) {
        \UserVideoComments::query()
            ->where('parent_id',NULL)
            ->chunk(100, function($datas) use ($faker) {
                $temp_comments = [];
                foreach ($datas as $data) {

                    for ($i=0; $i < 50; $i++) {
                        $n1 = [
                            'post_id' => $data->post_id,
                            'user_id' => $data->user_id,
                            'parent_id' => $data->id,
                            'comment' => $faker->text($maxNbChars = 350),
                            'diblokir' => '0',
                        ];

                        array_push($temp_comments, $n1);
                    }
                }

                // \UserVideoComments::query()->insert($temp_comments);
                \UserVideoComments::query()->upsert($temp_comments, ['post_id','user_id','parent_id','comment']);
            });
    }

    function SECOND($faker) {

        \UserVideo::query()
            ->chunk(100, function($datas) use ($faker) {
                $temp_comments = [];
                foreach ($datas as $data) {
                    for ($i=0; $i < 50; $i++) {
                        $n1 = [
                            'post_id' => $data->id,
                            'user_id' => $data->user_id,
                            'parent_id' => NULL,
                            'comment' => $faker->text($maxNbChars = 350),
                            'diblokir' => '0',
                        ];

                        array_push($temp_comments, $n1);
                    }
                }

                // \UserVideo::query()->upsert($temp_video, ['description']);
                // \UserVideoComments::query()->insert($temp_comments);
                \UserVideoComments::query()->upsert($temp_comments, ['post_id','user_id','parent_id','comment']);
            });

    }

    function FIRST($faker) {

        \UserVideo::query()
            ->chunk(100, function($datas) use ($faker) {
                $temp_comments = [];
                $temp_video = [];
                foreach ($datas as $data) {

                    $n = [
                        'id' => $data->id,
                        'user_id' => $data->user_id,
                        'file' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                        'description' => $faker->text($maxNbChars = 350),
                    ];

                    array_push($temp_video, $n);

                    // for ($i=0; $i < 50; $i++) {
                    //     $n1 = [
                    //         'post_id' => $data->id,
                    //         'user_id' => $data->user_id,
                    //         'parent_id' => NULL,
                    //         'comment' => $faker->text($maxNbChars = 350),
                    //         'diblokir' => '0',
                    //     ];

                    //     array_push($temp_comments, $n1);
                    // }
                }

                \UserVideo::query()->upsert($temp_video, ['description','file']);

                // \UserVideoComments::query()->insert($temp_comments);
                // \UserVideoComments::query()->upsert($temp_comments, ['post_id','user_id','parent_id','comment']);
            });

    }

    function INSERT_ARTIKEL() {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('user_gambar')->where('user_gambarable_type', 'Artikel_Model')->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $artikels = \Artikel_Model::get();

        $faker = \Faker\Factory::create();

        foreach ($artikels as $key => $artikel) {

            for ($i=0; $i < rand(0, 10); $i++) {
                # code...

                $form = [
                    'id_user'               => $artikel->id_user,
                    'user_gambarable_id'    => $artikel->id,
                    'user_gambarable_type'  => 'Artikel_Model',
                    'label'     => 'artikel',
                    'file'      => array_values([
                        "https://images.alphacoders.com/232/thumb-1920-232381.jpg",
                        "https://i.pinimg.com/originals/89/f6/17/89f6175d8e6731fe72c5f1f4547683e1.jpg",
                        "https://images7.alphacoders.com/332/332404.jpg",
                        "https://www.wallpaperup.com/uploads/wallpapers/2014/06/23/376376/f30f2e4b1049637ced41592507f942c2.jpg",
                        "https://www.gematsu.com/wp-content/uploads/2015/12/Star-Ocean-Integrity-and-Faithlessness_2015_12-28-15_001.jpg",
                        "https://images.alphacoders.com/232/thumb-1920-232381.jpg",
                        "https://i.pinimg.com/originals/89/f6/17/89f6175d8e6731fe72c5f1f4547683e1.jpg",
                        "https://images7.alphacoders.com/332/332404.jpg",
                        "https://www.wallpaperup.com/uploads/wallpapers/2014/06/23/376376/f30f2e4b1049637ced41592507f942c2.jpg",
                        "https://www.gematsu.com/wp-content/uploads/2015/12/Star-Ocean-Integrity-and-Faithlessness_2015_12-28-15_001.jpg",
                        "https://images.alphacoders.com/232/thumb-1920-232381.jpg",
                        "https://i.pinimg.com/originals/89/f6/17/89f6175d8e6731fe72c5f1f4547683e1.jpg",
                        "https://images7.alphacoders.com/332/332404.jpg",
                        "https://www.wallpaperup.com/uploads/wallpapers/2014/06/23/376376/f30f2e4b1049637ced41592507f942c2.jpg",
                        "https://www.gematsu.com/wp-content/uploads/2015/12/Star-Ocean-Integrity-and-Faithlessness_2015_12-28-15_001.jpg",
                    ])[mt_rand(0, 14)],
                ];

                // var_dump($form);

                \User_Gambar_Model::insert($form);
            }
        }
    }

}
