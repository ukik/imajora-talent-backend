<?php
// require_once "libs/Mobile_Detect.php";
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Modules\User\Entities\User;
use Jenssegers\Agent\Agent;

if (!function_exists('memory')) {
    function memory($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}

if (!function_exists('Resolver')) {
    function Resolver(array $parameters = [], $status = 200)
    {

		// $notifications = [
		// 	//'user'			=> $user,
		// 	'notifications' => notifications()
		// ];

        return response()
            ->json(
                array_merge(
                    [
                        'memory'    => memory(memory_get_usage(true)),
                        'logged'    => auth_check(),
                        'client'    => Auth::check() ? Auth::user()->client : NULL, //getter('client'),
                    ],
                    $parameters,
                    // $notifications
                )
            )
            // cukup header ini saja agar API yang di akses dari browser tanpa aplikasi auto download
            ->header('Content-Type', 'application/json')
            // ->header('Content-Disposition',' attachment; filename="file.json"')
            ->setStatusCode($status);

            // tidak diperlukan sepertinya
            // ->header('Content-Description',' File Transfer')
            // ->header('Content-Type',' application/octet-stream')
            // ->header('Expires',' 0')
            // ->header('Cache-Control',' must-revalidate')
            // ->header('Pragma',' public')

    }
}

if (!function_exists('Fallback')) {
    function Fallback(array $parameters = [], $status = 400)
    {
        return response()
            ->json(
                array_merge(
                    [
                        'memory'    => memory(memory_get_usage(true)),
                        'logged'    => auth_check(),
                        'client'    => Auth::check() ? Auth::user()->client : NULL, //getter('client'),
                    ],
                    $parameters,
                    // $notifications
                )
                // array_merge(
                // $parameters
                // // $notifications
            )
            ->header('Content-Type', 'application/json')
            // ->header('Content-Type', 'application/x-www-form-urlencoded')
            ->setStatusCode($status);
    }
}

// Include and instantiate the class.
// require_once 'Mobile_Detect.php';

if (!function_exists('Signature')) {
    function Signature()
    {

        $check      = \Auth::user(); //auth('api')->user(); //Sentinel::check(); // \Auth::check();

        $csrf = getter('csrf');
        $token = getter('tera_token');

        if($check) {

            // untuk upgrade user dari subscriber ke mitra/investor
            // if(RouteName() == "site.author") {}
            // $is_pengaturan_lengkap = 0;
            if($check['first_name'] && $check['phone'] && $check['about_us']) {
                $is_pengaturan_lengkap = 1;
            } else {
                $is_pengaturan_lengkap = 0;
            }

            $activation   = $check->withActivation()->first();
            if($activation) {
                $completed = $activation['completed'];
            } else {
                $completed = 0;
            }

            $role    = $check->withRoles()->get();  // \Auth::id()

            return [
                'logged'        => \Auth::check(),
                'csrf'          => empty($csrf) ? request()->header('csrf') : $csrf,
                'role'          => $role[0],
                'activation'    => $completed,
                'token'         => empty($token) ? JWTToken() : $token,
                'user'          => $check,
                'is_pengaturan_lengkap' => $is_pengaturan_lengkap,

                // 'role_slug' => $role[0]->slug,
                // 'platform'  => $detect, //json_decode(request()->header('platform'), true),
                // 'lokasi'    => // jika ingin
            ];
        }

        return [
            'logged'    => false,
            'csrf'      => null,
            'role'      => null,
            // 'role_slug' => null,
            'token'     => null,
            // 'platform'  => $detect, //json_decode(request()->header('platform'), true),
            'user'      => null,
            'is_pengaturan_lengkap' => null,
        ];
    }
}
