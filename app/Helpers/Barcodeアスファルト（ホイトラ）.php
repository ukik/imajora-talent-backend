<?php

if(!function_exists('Barcodeアスファルト（ホイトラ）')) {
    function Barcodeアスファルト（ホイトラ）($data)
    {
        // $code1 = $data->barcode_1;
        // $code2 = $data->barcode_2;
        // $code3 = $data->barcode_3;

        // $code = implode('', [$code1, $code2, $code3]);

        // $driving = "";
        // $driving_upstream = "";
        // $driving_place_other = "";

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
        '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="437px" height="185px" viewBox="0 0 437 185">
  <defs>
    <image id="barcode_mortar_svg_Layer_1__Image_" x="0" y="0" width="334" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAU4AAAAeCAYAAABDqvcqAAAA0ElEQVR4nO3UMQ7CMBAAQcP/
/wwNFFhYzhKlQJppEOD4TET2NsZ4jE+31+tjej82n89W+66+362bzzWvr/PqnN28o+vO/o63
q+/DVfuevX9Hz/Vv/4fV3Nnuufx1Xj3P0Xln991dv5t/9PlZ7fN13/viYgAWhBMgEk6ASDgB
IuEEiIQTIBJOgEg4ASLhBIiEEyASToBIOAEi4QSIhBMgEk6ASDgBIuEEiIQTIBJOgEg4ASLh
BIiEEyASToBIOAEi4QSIhBMgEk6ASDgBIuEEiJ5bLC47VcgmmAAAAABJRU5ErkJggg==" />
  </defs>
  <g id="Layer_2" />
  <g id="barcode_mortar_svg">
    <g id="Layer_2" transform="matrix( 1, 0, 0, 1, 250.2,129) ">
      <g>
        <g>
          <g>
            <path fill="#FFFFFF" stroke="none" d="
M -250.2 -129
L -250.2 56.85 187.25 56.85 187.25 -129 -250.2 -129 Z" />
          </g>
        </g>
      </g>
    </g>
    <g id="Layer_1" transform="matrix( 1, 0, 0, 1, 250.2,129) ">
      <g>
        <g>
          <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
M -245.5 50.1
L -245.5 -83.7 -245.5 -103.7 -245.5 -123.7 181.5 -123.7 181.5 -103.7 181.5 -83.7 181.5 50.1
M 181.5 -103.7
L -245.5 -103.7
M 181.5 -83.7
L -245.5 -83.7" />
        </g>
      </g>
      <g transform="matrix( 1, 0, 0, 1, -243.5,-121.7) ">
        <clipPath id="Mask_Mask_1">
          <rect x="-2" y="-2" width="427" height="20" fill="#FFFFFF" stroke="none" />
        </clipPath>
        <text clip-path="url(#Mask_Mask_1)" writing-mode="lr">
          <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">ポーラス</tspan>
          <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">13</tspan>
          <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">　パーミバインダー</tspan>
          <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve"></tspan>
          <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#FF0000" xml:space="preserve">（混合物の名称）</tspan>
        </text>
      </g>
      <g transform="matrix( 1, 0, 0, 1, -243.5,-101.7) ">
        <clipPath id="Mask_Mask_2">
          <rect x="-2" y="-2" width="427" height="20" fill="#FFFFFF" stroke="none" />
        </clipPath>
        <text clip-path="url(#Mask_Mask_2)" writing-mode="lr">
          <tspan x="0" y="13.75" baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#000000" xml:space="preserve">No.010 </tspan>
          <tspan baseline-shift="0%" font-family="MS UI Gothic" font-size="16" fill="#FF0000" xml:space="preserve">（測点）</tspan>
        </text>
      </g>
      <g transform="matrix( 0.5985870361328125, 0, 0, 3.33331298828125, -110.55,-66.95) ">
        <use xlink:href="#barcode_mortar_svg_Layer_1__Image_" />
      </g>
      <g transform="matrix( 1, 0, 0, 1, -153.05,-49.35) ">
        <clipPath id="Mask_Mask_3">
          <rect x="-2" y="-2" width="34" height="68.8" fill="#FFFFFF" stroke="none" />
        </clipPath>
        <text clip-path="url(#Mask_Mask_3)" writing-mode="lr">
          <tspan x="0" y="25.8" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#000000" xml:space="preserve">事</tspan>
          <tspan x="0" y="60.6" baseline-shift="0%" font-family="MS UI Gothic" font-size="30" fill="#000000" xml:space="preserve">抽</tspan>
        </text>
      </g>
      <g>
        <g>
          <path stroke="#000000" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" fill="none" d="
M 181.5 50.1
L -245.5 50.1" />
        </g>
      </g>
    </g>
  </g>
</svg>';
    }
}
