<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

# php artisan db:seed --class=AudioSeeder

class AudioSeeder extends Seeder {

    public
    function run()
    {
        $faker = \Faker\Factory::create();

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \DB::table('user_image_comments')->delete();
        // \DB::table('user_image_comments')->truncate();
        // \DB::table('user_image_file')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $this->FIRST($faker);
        // $this->SECOND($faker);
        // $this->THIRD($faker);
        // $this->FOURTH($faker);
        return;

    }
    function FOURTH($faker) {
        $images = [
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
        ];

        \UserAudio::query()
            ->chunk(100, function($datas) use ($faker, $images) {
                $temp_comments = [];
                foreach ($datas as $data) {

                    foreach ($images as $key => $value) {
                        # code...
                        $n1 = [
                            'post_id' => $data->id,
                            'user_id' => $data->user_id,
                            'file' => $value,
                            'diblokir' => '0',
                        ];

                        array_push($temp_comments, $n1);
                    }
                }

                // \UserAudioComments::query()->insert($temp_comments);
                \UserAudioFile::query()
                    ->upsert($temp_comments, [
                        'post_id',
                        'user_id',
                        'file'
                    ]);
            });
    }

    function THIRD($faker) {
        \UserAudioComments::query()
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

                // \UserAudioComments::query()->insert($temp_comments);
                \UserAudioComments::query()->upsert($temp_comments, ['post_id','user_id','parent_id','comment']);
            });
    }

    function SECOND($faker) {

        \UserAudio::query()
            ->chunk(100, function($datas) use ($faker) {
                $temp = [];
                foreach ($datas as $data) {
                    for ($i=0; $i < 50; $i++) {
                        $n1 = [
                            'post_id' => $data->id,
                            'user_id' => $data->user_id,
                            'parent_id' => NULL,
                            'comment' => $faker->text($maxNbChars = 350),
                            'diblokir' => '0',
                        ];

                        array_push($temp, $n1);
                    }
                }

                // \UserAudio::query()->upsert($temp_video, ['description']);
                // \UserAudioComments::query()->insert($temp_comments);
                \UserAudioComments::query()->upsert($temp, ['post_id','user_id','parent_id','comment']);
            });

    }

    function FIRST($faker) {

        \UserAudio::query()
            ->chunk(100, function($datas) use ($faker) {
                // $temp_comments = [];
                $temp = [];
                foreach ($datas as $data) {

                    $n = [
                        'id' => $data->id,
                        'user_id' => $data->user_id,
                        'file' => 'https://vgmsite.com/soundtracks/megaman-8-original-soundtrack-saturn-version/cpxklhxz/08%20-%20dr.%20light%27s%20lab.mp3',
                        'description' => $faker->text($maxNbChars = 350),
                    ];

                    array_push($temp, $n);

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

                \UserAudio::query()->upsert($temp, ['file']);

                // \UserAudioComments::query()->insert($temp_comments);
                // \UserAudioComments::query()->upsert($temp_comments, ['post_id','user_id','parent_id','comment']);
            });

    }

}
