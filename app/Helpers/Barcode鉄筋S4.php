<?php

if(!function_exists('Barcode鉄筋S4')) {
    function Barcode鉄筋S4($data)
    {
        $code = implode('', [2, 123456, 123456]);

        // $code1 = $data->barcode_1;
        // $code2 = $data->barcode_2;
        // $code3 = $data->barcode_3;

        // $code = implode('', [$code1, $code2, $code3]);

        // $driving = "";
        // $driving_upstream = "";
        // $driving_place_other = "";

        // $driving .= $data->driving_place_building ? ''.$data->driving_place_building : ''; //棟
        // $driving .= " ";
        // $driving .= $data->driving_place_construction_zone ? ''.$data->driving_place_construction_zone : ''; //工区
        // $driving .= " ";
        // $driving .= $data->driving_place_pile_no == 1 ? '杭' : ''; //杭
        // $driving .= " ";
        // $driving .= $data->driving_place_pressurepot == 1 ? '耐圧盤' : ''; //
        // $driving .= " ";
        // $driving .= $data->driving_place_underground_beam == 1 ? '地中梁' : ''; //地中梁
        // $driving .= " ";
        // $driving_upstream .= $data->driving_place_upstream == 1 ? '階立上り' : '-'; //階立上り
        // $driving_upstream .= " ";
        // $driving_upstream .= $data->driving_place_upstream_input ? ''.$data->driving_place_upstream_input : ''; //階立上り
        // $driving_upstream .= " ";
        // $driving .= $data->driving_place_floor == 1 ? '階床' : ''; //階床
        // $driving .= " ";
        // $driving_place_other .= $data->driving_place_other == 1 ? '他' : '-'; //他
        // $driving_place_other .= " ";
        // $driving_place_other .= $data->driving_place_other_input ? ''.$data->driving_place_other_input : ''; //他

        // $driving = preg_replace('/[^\p{L}\p{N}\s]/u', '', $driving);
        // $driving = preg_replace('/\s+/', ' ', $driving);

        // // $code = "12345678940";
        // $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG(); // Pixel based PNG

        // $barcode = $generatorPNG->getBarcode($code, $generatorPNG::TYPE_CODE_128);

        // $barcode_encode = base64_encode($barcode);

        // $width = 136.75;
        // $height = 66.145833333;

        // // $management_1 = '日';
        // // $management_2 = '';
        // // if (str_contains($data->management, '28')) {
        // //     $management_1 = 28;
        // //     $management_2 = '日';
        // // }

        // // If chosen was '封かん' is '緑’ , ’現場水中’ is ’赤’, ruled like this as PPT.
        // $curing_method_alias = $data->curing_method == '封かん' ? "緑" : "赤";

        // $company_name = $data->company_name ? $data->company_name : '';
        // $company_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $company_name);
        // $company_name = preg_replace('/\s+/', ' ', $company_name);

        // $label = $data->label ? $data->label : '';
        // $label = preg_replace('/[^\p{L}\p{N}\s]/u', '', $label);
        // $label = preg_replace('/\s+/', ' ', $label);

        // $construction_name = $data->construction_name ? $data->construction_name : '';
        // $construction_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $construction_name);
        // $construction_name = preg_replace('/\s+/', ' ', $construction_name);

        // $how_to_call_nominal_intensity = $data->how_to_call_nominal_intensity ? $data->how_to_call_nominal_intensity : '-';
        // $lot_no = $data->lot_no ? $data->lot_no : '-';
        // $curing_method = $data->curing_method ? $data->curing_method : '-';

        return
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="279px" height="386px" viewBox="0 0 279 386">
        <defs>
          <image id="Bitmap_1X" x="0" y="0" width="200" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAABkCAYAAADDhn8LAAABG0lEQVR4nO3TsRHAIBDAsIf9
      d04W4NxCIU3gxmtmvgGO9u0AeJlBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgE
      gkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAY
      BIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEg
      GASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJB
      IBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEgkEgGASCQSAYBIJBIBgEwg8ykQHH
      iOZGpgAAAABJRU5ErkJggg==" />
        </defs>

        <defs>
            <image id="Bitmap_1" x="0" y="0" width="200" height="100"
            xlink:href="data:image/png;base64,' . imagick_code_128_鉄筋($code) . '"
            />
        </defs>
        <g id="Layer_2" />
        <g id="barcode_mortar_svg">
          <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 0,0.05) ">
            <g>
              <g>
                <g>
                  <path fill="#FFFFFF" stroke="none" d="
      M 279.5 -0.05
      L 0 -0.05 0 386.55 279.5 386.55 279.5 -0.05 Z" />
                </g>
              </g>
            </g>
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 274.1 132.95
      L 274.1 5.5 5.6 5.5 5.6 132.95
      M 274.1 132.95
      L 274.1 380.4 233.9 380.4 5.6 380.4 5.6 360.4 5.6 340.4 5.6 320.4 5.6 300.4 5.6 280.4 5.6 260.4 5.6 132.95" />
              </g>
              <g>
                <path stroke="#000000" stroke-opacity="0.00784313725490196" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 5.6 132.95
      L 274.1 132.95
      M 5.6 280.4
      L 233.9 280.4 233.9 260.4 5.6 260.4
      M 233.9 280.4
      L 233.9 300.4 233.9 320.4 233.9 340.4 233.9 360.4 233.9 380.4
      M 233.9 360.4
      L 5.6 360.4
      M 233.9 340.4
      L 5.6 340.4
      M 233.9 320.4
      L 5.6 320.4
      M 233.9 300.4
      L 5.6 300.4" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,262.4) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">1</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">株式会社建設</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 57.8,19.2) ">
              <g>
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 238.4,262.4) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-2" y="-2" width="34.2" height="68.8" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="0" y="25.8" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">立</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve"></tspan>
                <tspan x="0" y="60.6" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">写</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 57.8,146.7) ">
              <g>
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,282.4) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">2</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">株式会社コンクリート</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,302.4) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">3</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">様邸新築工事</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,322.4) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">4</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">様邸新築工事</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,342.4) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">_</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 7.6,362.4) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-2" y="-2" width="114.25" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">5</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">様邸</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 235.9,343.4) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-2" y="-2" width="40.25" height="39" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="0" y="30.1" baseline-shift="0%" font-family="MS UI Gothic" font-size="35" fill="#000000" xml:space="preserve">1</tspan>
              </text>
            </g>
            <g transform="matrix( 1, 0, 0, 1, 121.85,362.4) ">
              <clipPath id="Mask_Mask_9">
                <rect x="-2" y="-2" width="114.25" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_9)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">6</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">様邸</tspan>
              </text>
            </g>
          </g>
        </g>
      </svg>';
    }
}
