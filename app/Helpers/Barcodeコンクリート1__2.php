<?php

if(!function_exists('Barcodeコンクリート1__2')) {
    function Barcodeコンクリート1__2($data)
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
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG(); // Pixel based PNG

        // $barcode = $generatorPNG->getBarcode($code, $generatorPNG::TYPE_CODE_128);

        // $barcode_encode = base64_encode($barcode);

        $width = 136.75;
        $height = 66.145833333;

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
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="500px" height="195px" viewBox="0 0 500 195">
        <defs>
            <image id="Bitmap_1" x="0" y="0" width="200" height="100"
            xlink:href="data:image/png;base64,' . imagick_code_128_鉄筋($code) . '"
            />
        </defs>
        <g id="Layer_2" />
        <g id="barcode_mortar_svg">
          <g id="Layer_2" transform="matrix( 1, 0, 0, 1, 250.2,107.7) ">
            <g>
              <g>
                <g>
                  <path fill="#FFFFFF" stroke="none" d="
      M 250.25 -107.7
      L -250.2 -107.7 -250.2 88 250.25 88 250.25 -107.7 Z" />
                </g>
              </g>
            </g>
          </g>
          <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 250.2,107.7) ">
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M -245.5 -15.3
      L -140.95 -15.3 -140.95 -43.7 -245.5 -43.7 -245.5 -63.7 -245.5 -83.7 -245.5 -103.7 0 -103.7 245.5 -103.7 245.5 -83.7 245.5 -63.7 245.5 -43.7 17.2 -43.7 17.2 -15.3 17.2 13.1 17.2 41.5 17.2 83.7
      M -245.5 -83.7
      L 0 -83.7 0 -103.7
      M 0 -83.7
      L 245.5 -83.7
      M 17.2 -43.7
      L -79.8 -43.7 -79.8 -15.3 17.2 -15.3
      M -140.95 -15.3
      L -79.8 -15.3
      M -140.95 -43.7
      L -79.8 -43.7
      M 17.2 13.1
      L -84.6 13.1 -84.6 41.5 17.2 41.5
      M -245.5 83.75
      L -245.5 41.5 -245.5 13.1 -84.6 13.1
      M -245.5 41.5
      L -84.6 41.5
      M -245.5 -63.7
      L 245.5 -63.7" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -243.5,-81.7) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="491" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$construction_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -215,47.95) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-30.5" y="-2" width="160.9" height="33.3" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="-28.5" y="22.85" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="24" fill="#000000" xml:space="preserve">'.$curing_method.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -243.5,-61.7) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="490.5" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇棟</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">33</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 31.15,-30) ">
              <g>
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -82.6,47.95) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="101.8" height="33.3" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="22.85" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="24" fill="#000000" xml:space="preserve">'.$management.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -243.5,-39.5) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-2" y="-2" width="95.05" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$driving_date.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -256.6,-312.75) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 172 396.5
      L 11.1 396.5" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -256.6,-312.75) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 273.8 396.5
      L 172 396.5" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -256.6,-312.75) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 502.1 396.5
      L 273.8 396.5" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -256.6,-312.75) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 502.1 269.05
      L 502.1 396.5" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 179.6,-79) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="64.2" height="34" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="0" y="25.8" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">立写</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -250.2,-89) ">
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 4.7 73.7
      L 4.7 45.3" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -215,15.1) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-30.5" y="-2" width="160.9" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="-28.5" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$key.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -82.6,15.1) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-2" y="-2" width="101.8" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="0" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$test_day.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -243.5,-11.1) ">
              <clipPath id="Mask_Mask_9">
                <rect x="-2" y="-2" width="170.4" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_9)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">00-000</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">、</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$curing_method_alias.'</tspan>
              </text>
            </g>
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M -245.5 13.1
      L -245.5 -15.3" />
              </g>
            </g>
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M -84.6 41.5
      L -84.6 83.75" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -137.95,-39.5) ">
              <clipPath id="Mask_Mask_10">
                <rect x="-2" y="-2" width="51" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_10)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$how_to_call_nominal_intensity.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -20.15,-39.5) ">
              <clipPath id="Mask_Mask_11">
                <rect x="-58.15" y="-2" width="47.85" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_11)" writing-mode="lr">
                <tspan x="-56.15" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">ロット</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -243.5,-101.7) ">
              <clipPath id="Mask_Mask_12">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_12)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$company_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 2,-101.7) ">
              <clipPath id="Mask_Mask_13">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_13)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">〇〇〇〇</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$label.'</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, -21.65,-39.5) ">
              <clipPath id="Mask_Mask_14">
                <rect x="-6.3" y="-2" width="43.3" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_14)" writing-mode="lr">
                <tspan x="-4.3" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$lot_no.'</tspan>
              </text>
            </g>
          </g>
        </g>
      </svg>';
    }
}
