<?php

if(!function_exists('Barcodeモルタル')) {
    function Barcodeモルタル($data)
    {
        // $code = $data->barcode;
        // $code1 = $data->barcode_1;

        $A = \Carbon\Carbon::parse($data->created_at)->format('y');
        $B = prepand_zero($data->id, 7);
        $C = prepand_zero($data->quantity,3);

        $code = "$A$B$C".'1';
        // $code = implode('', [$code, $code1]);

        $construction_name = $data->construction_name ? $data->construction_name : '';
        $construction_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $construction_name);
        $construction_name = preg_replace('/\s+/', ' ', $construction_name);

        $driving_location = $data->driving_location ? $data->driving_location : '';
        $driving_location = preg_replace('/[^\p{L}\p{N}\s]/u', '', $driving_location);
        $driving_location = preg_replace('/\s+/', ' ', $driving_location);

        $test_day = $data->test_day ? str_replace('/','.',$data->test_day) : '-';

        $driving_date = $data->driving_date ? str_replace('/','.',$data->driving_date) : '-';

        $age = $data->age ? $data->age : '-';

        $curing_method = $data->curing_method ? $data->curing_method : '-';

        $key = $code; //substr($data->created_at, -2).prepand_zero($data->id,9).'001'.'A';

        return
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="488px" height="239px" viewBox="0 0 488 239">
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
          <g id="barcode_1">
            <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 267.85,105.4) ">
              <g transform="matrix( 1, 0, 0, 1.1399993896484375, 0,0) ">
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
          </g>
          <g id="Layer_1">
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 10.25 43.4
      L 10.25 5.05 478.55 5.05 478.55 46.25 478.55 90.35 478.55 234.35 256.5 234.35 178.25 234.35 10.25 234.35 10.25 139.6 10.25 90.35 10.25 70.6
      M 178.25 139.6
      L 256.5 139.6 256.5 90.35 164.45 90.35 164.45 139.6 178.25 139.6 178.25 234.35
      M 478.55 46.25
      L 113.2 46.25 113.2 90.35 164.45 90.35
      M 113.2 46.25
      L 10.25 46.25
      M 113.2 90.35
      L 10.25 90.35
      M 10.25 139.6
      L 164.45 139.6
      M 256.5 139.6
      L 256.5 234.35
      M 478.55 90.35
      L 256.5 90.35" />
              </g>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 12.15,15.1) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="487" height="26" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="18.9" baseline-shift="0%" font-family="MS UI Gothic" font-size="22" fill="#000000" xml:space="preserve">'.$construction_name.'</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="22" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 12.15,57.75) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-2" y="-2" width="101.1" height="26" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="0" y="18.9" baseline-shift="0%" font-family="MS UI Gothic" font-size="22" fill="#000000" xml:space="preserve">'.$driving_date.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 115.1,57.25) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="336.3" height="26" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="18.9" baseline-shift="0%" font-family="MS UI Gothic" font-size="22" fill="#000000" xml:space="preserve">'.$driving_location.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 166.3,104.1) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="96.1" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$test_day.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 12.15,105.05) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-2" y="-2" width="160.9" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$key.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 369.1,36.75) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="104.2" height="54" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="0" y="42.95" baseline-shift="0%" font-family="MS UI Gothic" font-size="50" fill="#A6A6A6" xml:space="preserve">立写</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 5.7,0) ">
              <g transform="matrix( 1.043609619140625, 0, 0, 1.043609619140625, -5.9,0) ">
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 10.20356903076172 70.61979522705079
      L 10.20356903076172 43.4067398071289" />
              </g>
            </g>
            <g transform="matrix( 0.9582061767578125, 0, 0, 0.9582061767578125, 39.45,166.55) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-30.5" y="-2" width="176" height="52.85" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="-28.5" y="38.1" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="40" fill="#000000" xml:space="preserve">'.$curing_method.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.95819091796875, 0, 0, 0.95819091796875, 189,166.55) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-11.2" y="-2" width="81.65" height="50.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="-9.2" y="36.2" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="38" fill="#000000" xml:space="preserve">'.$age.'</tspan>
                <tspan baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="38" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
          </g>
        </g>
      </svg>';
    }
}
