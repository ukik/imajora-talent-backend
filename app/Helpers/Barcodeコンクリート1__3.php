<?php

if(!function_exists('Barcodeコンクリート1__3')) {
    function Barcodeコンクリート1__3($data)
    {
        $code = $data->barcode;
        $code1 = $data->barcode_1;
        // $code2 = $data->barcode_2;
        // $code3 = $data->barcode_3;
        // $code = implode('', [$code1, $code2, $code3]);

        $code = implode('', [$code, $code1]);

        $driving = "";
        // $driving .= $data->driving_place_building ? '〇'.$data->driving_place_building : ''; //棟
        // $driving .= " ";
        // $driving .= $data->driving_place_construction_zone ? '〇'.$data->driving_place_construction_zone : ''; //工区
        // $driving .= " ";
        // $driving .= $data->driving_place_pile_no == 1 ? '〇杭' : ''; //杭
        // $driving .= " ";
        // $driving .= $data->driving_place_pressurepot == 1 ? '〇耐圧盤' : ''; //
        // $driving .= " ";
        // $driving .= $data->driving_place_underground_beam == 1 ? '〇地中梁' : ''; //地中梁
        // $driving .= " ";
        // $driving_upstream .= $data->driving_place_upstream == 1 ? '〇階立上り' : '-'; //階立上り
        // $driving_upstream .= " ";
        // $driving_upstream .= $data->driving_place_upstream_input ? '〇'.$data->driving_place_upstream_input : ''; //階立上り
        // $driving_upstream .= " ";
        // $driving .= $data->driving_place_floor == 1 ? '〇階床' : ''; //階床
        // $driving .= " ";
        // $driving_place_other .= $data->driving_place_other == 1 ? '〇他' : '-'; //他
        // $driving_place_other .= " ";
        // $driving_place_other .= $data->driving_place_other_input ? '〇'.$data->driving_place_other_input : ''; //他

        $driving .= $data->driving_place_building ? '〇'.$data->driving_place_building : ''; //
        $driving .= " ";
        $driving .= $data->driving_place_construction_zone ? '〇'.$data->driving_place_construction_zone : ''; //
        $driving .= " ";
        $driving .= $data->driving_location ? '〇'.$data->driving_location : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_pile_no ? '〇'.$data->driving_location_pile_no : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_upstream ? '〇'.$data->driving_location_upstream : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_floor ? '〇'.$data->driving_location_floor : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_other ? '〇'.$data->driving_location_other : ''; //
        $driving .= " ";

        $driving = preg_replace('/[^\p{L}\p{N}\s]/u', '', $driving);
        $driving = preg_replace('/\s+/', ' ', $driving);

        // $code = "12345678940";
        // $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG(); // Pixel based PNG

        // $barcode = $generatorPNG->getBarcode($code, $generatorPNG::TYPE_CODE_128);

        // $barcode_encode = base64_encode($barcode);

        // $width = 136.75;
        // $height = 66.145833333;

        // If chosen was '封かん' is '緑’ , ’現場水中’ is ’赤’, ruled like this as PPT.
        $curing_method_alias = $data->curing_method == '封かん' ? "緑" : "赤";

        $company_name = $data->company_name ? $data->company_name : '';
        $company_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $company_name);
        $company_name = preg_replace('/\s+/', ' ', $company_name);

        $label = $data->label ? $data->label : '';
        $label = preg_replace('/[^\p{L}\p{N}\s]/u', '', $label);
        $label = preg_replace('/\s+/', ' ', $label);

        $construction_name = $data->construction_name ? $data->construction_name : '';
        $construction_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $construction_name);
        $construction_name = preg_replace('/\s+/', ' ', $construction_name);

        $label = $data->label ? $data->label : '';

        $test_day = $data->test_day ? str_replace('/','.',$data->test_day) : '-';

        $driving_date = $data->driving_date ? str_replace('/','.',$data->driving_date) : '-';

        $how_to_call_nominal_intensity = $data->how_to_call_nominal_intensity ? $data->how_to_call_nominal_intensity : '-';

        $lot_no = $data->lot_no ? $data->lot_no : '-';

        $curing_method = $data->curing_method ? $data->curing_method : '-';

        $management = $data->management ? $data->management : '-';

        $key = substr($data->created_at, -2).prepand_zero($data->id,9).'001'.'A';

        return
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="488px" height="239px" viewBox="0 0 488 239">
        <defs>
            <image id="Bitmap_1" x="0" y="0" width="200" height="100"
            xlink:href="data:image/png;base64,' . imagick_code_128_鉄筋($code) . '"
            />
        </defs>
        <g id="Layer_2" />
        <g id="barcode_mortar_svg">
          <g id="Layer_2">
            <g>
              <g>
                <g>
                  <path fill="#FFFFFF" stroke="none" d="
      M 488.75 239.3
      L 488.75 0 0 0 0 239.3 488.75 239.3 Z" />
                </g>
              </g>
            </g>
          </g>
          <g id="Layer_1">
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 245.5 0
      L 488.75 0 488.75 20 488.75 40 488.75 60 488.75 239.3 262.7 239.3 160.9 239.3 0 239.3 0 145.2 0 116.8 0 88.4 0 60 0 40 0 20 0 0 245.5 0 245.5 20 488.75 20
      M 488.75 60
      L 262.7 60 262.7 88.4 262.7 116.8 262.7 145.2 262.7 239.3
      M 262.7 60
      L 165.7 60 165.7 88.4 262.7 88.4
      M 165.7 60
      L 104.55 60 104.55 88.4 165.7 88.4
      M 262.7 116.8
      L 160.9 116.8 160.9 145.2 262.7 145.2
      M 0 145.2
      L 160.9 145.2 160.9 239.3
      M 0 116.8
      L 160.9 116.8
      M 0 88.4
      L 104.55 88.4
      M 0 60
      L 104.55 60
      M 0 20
      L 245.5 20
      M 0 40
      L 488.75 40" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,22) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="488.7" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$construction_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 30.5,151.65) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-30.5" y="-2" width="160.9" height="33.3" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="-28.5" y="22.85" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="24" fill="#000000" xml:space="preserve">'.$curing_method.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,42) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="488.7" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇棟</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">333333</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 276.65,73.7) ">
              <g>
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 162.9,151.65) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="101.8" height="33.3" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="22.85" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="24" fill="#000000" xml:space="preserve">'.$management.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,64.2) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-2" y="-2" width="102.35" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$driving_date.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 425.1,24.7) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="64.2" height="34" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="0" y="25.8" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">立写</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -4.7,14.7) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 4.7 73.7
      L 4.7 45.3" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 30.5,118.8) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-30.5" y="-2" width="160.9" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="-28.5" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$key.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 162.9,118.8) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-2" y="-2" width="101.8" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="0" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$test_day.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,92.6) ">
              <clipPath id="Mask_Mask_9">
                <rect x="-2" y="-2" width="258.25" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_9)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">00-000</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">、</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$curing_method_alias.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 245.5,103.7) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M -245.5 13.1
      L -245.5 -15.3" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 107.55,64.2) ">
              <clipPath id="Mask_Mask_10">
                <rect x="-2" y="-2" width="58.75" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_10)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$how_to_call_nominal_intensity.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 225.35,64.2) ">
              <clipPath id="Mask_Mask_11">
                <rect x="-58.15" y="-2" width="93.65" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_11)" writing-mode="lr">
                <tspan x="-56.15" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">ロット</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve"> '.$lot_no.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,2) ">
              <clipPath id="Mask_Mask_12">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_12)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$company_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 247.5,2) ">
              <clipPath id="Mask_Mask_13">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_13)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$label.'</tspan>
              </text>
            </g>
          </g>
        </g>
      </svg>';
    }
}
