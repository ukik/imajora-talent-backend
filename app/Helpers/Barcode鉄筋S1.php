<?php

if(!function_exists('Barcode鉄筋S1')) {
    function Barcode鉄筋S1($data)
    {
        $A = \Carbon\Carbon::parse($data->created_at)->format('y');
        $B = prepand_zero($data->id, 7);
        $C = prepand_zero(1,3);

        $code = "$A$B$C".'1';
        // echo $code;22 726825 0011

        $driving = "";
        $driving .= $data->driving_place_building ? ''.$data->driving_place_building : ''; //
        $driving .= " ";
        $driving .= $data->driving_place_construction_zone ? ''.$data->driving_place_construction_zone : ''; //
        $driving .= " ";
        $driving = preg_replace('/[^\p{L}\p{N}\s]/u', '', $driving);
        $driving = preg_replace('/\s+/', ' ', $driving);

        $company_name = $data->company_name ? $data->company_name : '';
        $company_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $company_name);
        $company_name = preg_replace('/\s+/', ' ', $company_name);

        $manager_name = $data->manager_name ? $data->manager_name : '';
        $manager_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $manager_name);
        $manager_name = preg_replace('/\s+/', ' ', $manager_name);

        $construction_name = $data->construction_name ? $data->construction_name : '';
        $construction_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $construction_name);
        $construction_name = preg_replace('/\s+/', ' ', $construction_name);

        $pressurized_skill_person_name = $data->pressurized_skill_person_name ? $data->pressurized_skill_person_name : '';
        $pressurized_skill_person_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $pressurized_skill_person_name);
        $pressurized_skill_person_name = preg_replace('/\s+/', ' ', $pressurized_skill_person_name);

        $examination_number_input = $data->examination_number_input ? $data->examination_number_input : '';
        $examination_number_input = preg_replace('/[^\p{L}\p{N}\s]/u', '', $examination_number_input);
        $examination_number_input = preg_replace('/\s+/', ' ', $examination_number_input);

        $date_of_collection = $data->date_of_collection ? $data->date_of_collection : '';
        $date_of_collection = preg_replace('/[^\p{L}\p{N}\s]/u', '', $date_of_collection);
        $date_of_collection = preg_replace('/\s+/', ' ', $date_of_collection);

        $scheduled_to_drive_concrete = $data->scheduled_to_drive_concrete ? $data->scheduled_to_drive_concrete : '';
        $scheduled_to_drive_concrete = preg_replace('/[^\p{L}\p{N}\s]/u', '', $scheduled_to_drive_concrete);
        $scheduled_to_drive_concrete = preg_replace('/\s+/', ' ', $scheduled_to_drive_concrete);

        return
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="240px" height="489px" viewBox="0 0 240 489">
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
          <g id="Layer_3" transform="matrix( 1, 0, 0, 1, 0.5,0.55) ">
            <g>
              <g>
                <g>
                  <path fill="#FFFFFF" stroke="none" d="
      M 239.3 -0.05
      L 0 -0.05 0 488.7 239.3 488.7 239.3 -0.05 Z" />
                </g>
              </g>
            </g>
          </g>
          <g id="Layer_2" transform="matrix( 1, 0, 0, 1, 0.5,0.55) ">
            <g>
              <g>
                <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 228.3 488.75
      L 239.3 488.75 239.3 -0.05 0 -0.05 0 348.75
      M 228.3 488.75
      L 0 488.75 0 468.75 0 448.75 0 428.75 0 408.75 0 388.75 0 368.75 0 348.75" />
              </g>
              <g>
                <path stroke="#252525" stroke-opacity="0.00784313725490196" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
      M 0 348.75
      L 228.3 348.75 228.3 368.75 228.3 388.75 228.3 408.75 228.3 428.75 228.3 448.75 228.3 468.75 228.3 488.75
      M 228.3 368.75
      L 0 368.75
      M 228.3 388.75
      L 0 388.75
      M 228.3 468.75
      L 0 468.75
      M 228.3 408.75
      L 0 408.75
      M 228.3 428.75
      L 0 428.75
      M 228.3 448.75
      L 0 448.75" />
              </g>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,370.7) ">
              <clipPath id="Mask_Mask_1">
                <rect x="-2" y="-2" width="198.3" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$company_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 203.5,370.7) ">
              <clipPath id="Mask_Mask_2">
                <rect x="-2" y="-2" width="34.2" height="68.8" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
                <tspan x="0" y="25.8" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">立</tspan>
                <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve"></tspan>
                <tspan x="0" y="60.6" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#A6A6A6" xml:space="preserve">写</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,390.7) ">
              <clipPath id="Mask_Mask_3">
                <rect x="-2" y="-2" width="198.3" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$construction_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,410.7) ">
              <clipPath id="Mask_Mask_4">
                <rect x="-2" y="-2" width="198.3" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_4)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$driving.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,430.7) ">
              <clipPath id="Mask_Mask_5">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_5)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve"></tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 201,450.7) ">
              <clipPath id="Mask_Mask_6">
                <rect x="-2" y="-2" width="40.25" height="39" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_6)" writing-mode="lr">
                <tspan x="9.35" y="30.1" baseline-shift="0%" font-family="MS UI Gothic" font-size="35" fill="#000000" xml:space="preserve">1</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 116.2,470.7) ">
              <clipPath id="Mask_Mask_7">
                <rect x="-2" y="-2" width="88.5" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_7)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$scheduled_to_drive_concrete.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,470.7) ">
              <clipPath id="Mask_Mask_8">
                <rect x="-2" y="-2" width="114.25" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_8)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$date_of_collection.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 116.2,450.7) ">
              <clipPath id="Mask_Mask_9">
                <rect x="-2" y="-2" width="88.5" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_9)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$examination_number_input.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,450.7) ">
              <clipPath id="Mask_Mask_10">
                <rect x="-2" y="-2" width="114.25" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_10)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$pressurized_skill_person_name.'</tspan>
              </text>
            </g>
            <g transform="matrix( 0.9999847412109375, 0, 0, 1.000091552734375, 2,350.7) ">
              <clipPath id="Mask_Mask_11">
                <rect x="-2" y="-2" width="228.55" height="20" fill="#FFFFFF" stroke="none" />
              </clipPath>
              <text clip-path="url(#Mask_Mask_11)" writing-mode="lr">
                <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">'.$manager_name.'</tspan>
              </text>
            </g>
            <g id="Layer_1" transform="matrix( 0.9999847412109375, 0, 0, 1.325103759765625, 20.8,13.6) ">
              <g transform="matrix( 1, 0, 0, 1.1399993896484375, 0,0) ">
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
            <g id="Layer_1" transform="matrix( 0.9999847412109375, 0, 0, 1.325103759765625, 20.8,177.55) ">
              <g transform="matrix( 1, 0, 0, 1.1399993896484375, 0,0) ">
                <use xlink:href="#Bitmap_1" />
              </g>
            </g>
          </g>
        </g>
      </svg>';
    }
}
