<?php

if(!function_exists('Barcodeコンクリート1')) {
    function Barcodeコンクリート1($data, $lot = 1)
    {
        // $code = $data->barcode;
        // $code1 = $data->barcode_1;

        $A = \Carbon\Carbon::parse($data->created_at)->format('y');
        $B = prepand_zero($data->id, 7);
        $C = prepand_zero($data->barcode_curing_method,3);

        $code = "$A$B$C".'1';
        // echo $code;
        // $code = implode('', [$code, $code1]);

        $driving = "";
        $driving .= $data->driving_place_building ? ''.$data->driving_place_building : ''; //
        $driving .= " ";
        $driving .= $data->driving_place_construction_zone ? ''.$data->driving_place_construction_zone : ''; //
        $driving .= " ";
        $driving .= $data->driving_location ? ''.$data->driving_location : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_pile_no ? ''.$data->driving_location_pile_no : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_upstream ? ''.$data->driving_location_upstream : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_floor ? ''.$data->driving_location_floor : ''; //
        $driving .= " ";
        $driving .= $data->driving_location_other ? ''.$data->driving_location_other : ''; //
        $driving .= " ";

        $driving = preg_replace('/[^\p{L}\p{N}\s]/u', '', $driving);
        $driving = preg_replace('/\s+/', ' ', $driving);

        // ruled like this as PPT.
        $curing_method_alias = "-";
        switch ($data->curing_method) {
            case '標準':
                $curing_method_alias = "青";
                break;
            case '現場水中':
                $curing_method_alias = "赤";
                break;
            case '封かん':
                $curing_method_alias = "緑";
                break;
            case 'その他':
                $curing_method_alias = "黒";
                break;
        }

        $company_name = $data->company_name ? $data->company_name : '';
        $company_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $company_name);
        $company_name = preg_replace('/\s+/', ' ', $company_name);

        $label = $data->label ? $data->label : '';
        $label = preg_replace('/[^\p{L}\p{N}\s]/u', '', $label);
        $label = preg_replace('/\s+/', ' ', $label);

        $construction_name = $data->construction_name ? $data->construction_name : '';
        $construction_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $construction_name);
        $construction_name = preg_replace('/\s+/', ' ', $construction_name);

        $test_day = $data->test_day ? str_replace('/','.',$data->test_day) : '-';

        $driving_date = $data->driving_date ? str_replace('/','.',$data->driving_date) : '-';

        $how_to_call_nominal_intensity = $data->how_to_call_nominal_intensity ? $data->how_to_call_nominal_intensity : '-';

        $lot_no = $lot; //$data->lot_no ? $data->lot_no : '-';

        $curing_method = $data->curing_method ? $data->curing_method : '-';

        $management = '-';
        switch ($data->management) {
            case '28日':
                $management = 28;
                break;
            case '日':
                $management = $data->management_day;
                break;
        }

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
          <g id="Layer_1">
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 245.5 5
      L 478.55 5 478.55 29.65 478.55 56.3 478.55 83.8 478.55 234.3 261.95 234.3 173.75 234.3 10.25 234.3 10.25 179.45 10.25 146.95 10.25 115.3 10.25 83.8 10.25 56.3 10.25 29.65 10.25 5 245.5 5 245.5 29.65 478.55 29.65
      M 261.95 146.95
      L 164.4 146.95 164.4 179.45 173.75 179.45 261.95 179.45 261.95 146.95 261.95 115.3 169 115.3 110.45 115.3 10.25 115.3
      M 10.25 83.8
      L 110.45 83.8 169 83.8 261.95 83.8 478.55 83.8
      M 169 83.8
      L 169 115.3
      M 261.95 83.8
      L 261.95 115.3
      M 110.45 83.8
      L 110.45 115.3
      M 10.25 29.65
      L 245.5 29.65
      M 173.75 179.45
      L 173.75 234.3
      M 261.95 179.45
      L 261.95 234.3
      M 10.25 179.45
      L 164.4 179.45
      M 10.25 146.95
      L 164.4 146.95
      M 10.25 56.3
      L 478.55 56.3" />
              </g>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 12.15,35.05) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="488.7" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$construction_name.'</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 12.15,61.7) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-2" y="-2" width="488.7" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">棟</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$driving.'</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 275.3,106.05) ">
              <g transform="matrix( 1, 0, 0, 1.1399993896484375, 0,0) ">
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 12.15,89.75) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="102.35" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$driving_date.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.95819091796875, 0, 0, 0.95819091796875, 369.1,36.75) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="104.2" height="54" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="42.95" baseline-shift="0%" font-family="MS UI Gothic" font-size="50" fill="#A6A6A6" xml:space="preserve">立写</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 5.75,19.05) ">
              <g transform="matrix( 1.0436553955078125, 0, 0, 1.043609619140625, -6,-19.85) ">
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 10.253353881835938 89.66979522705078
      L 10.253353881835938 62.4567398071289" />
              </g>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 39.45,151.25) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-30.5" y="-2" width="160.9" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="-28.5" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$key.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 166.3,151.25) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="101.8" height="28.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="0" y="19.05" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="20" fill="#000000" xml:space="preserve">'.$test_day.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 12.15,121.55) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-2" y="-2" width="258.25" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$A.'-'.$C.'</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">、</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$curing_method_alias.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 245.45,104.35) ">
              <g transform="matrix( 1.0436553955078125, 0, 0, 1.043609619140625, -256.15,-108.9) ">
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 10.221621704101551 116.90250091552734
      L 10.221621704101551 89.68944549560547" />
              </g>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 112.35,89.75) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-2" y="-2" width="58.75" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="0" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">'.$how_to_call_nominal_intensity.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 224.7,89.75) ">
              <clipPath id="Mask_Mask_9">
                <rect x="-58.15" y="-2" width="93.65" height="24" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_9)" writing-mode="lr">
                <tspan x="-56.15" y="17.2" baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve">ロット</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="20" fill="#000000" xml:space="preserve"> '.$lot_no.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 12.15,9.4) ">
              <clipPath id="Mask_Mask_10">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_10)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$company_name.'</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
            <g transform="matrix( 0.958160400390625, 0, 0, 0.9582061767578125, 247.35,9.9) ">
              <clipPath id="Mask_Mask_11">
                <rect x="-2" y="-2" width="242.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_11)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$label.'</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
            <g transform="matrix( 0.95819091796875, 0, 0, 0.95819091796875, 39.45,185.6) ">
              <clipPath id="Mask_Mask_12">
                <rect x="-30.5" y="-2" width="176" height="52.85" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_12)" writing-mode="lr">
                <tspan x="-28.5" y="38.1" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="40" fill="#000000" xml:space="preserve">'.$curing_method.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.95819091796875, 0, 0, 0.95819091796875, 189,185.6) ">
              <clipPath id="Mask_Mask_13">
                <rect x="-11.2" y="-2" width="81.65" height="50.4" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_13)" writing-mode="lr">
                <tspan x="-9.2" y="36.2" baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="38" fill="#000000" xml:space="preserve">'.$management.'</tspan>
                <tspan baseline-shift="0%" font-family="Calibri" font-weight="bold" font-size="38" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
          </g>
        </g>
      </svg>';
    }
}
