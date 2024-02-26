<?php

use App\Helper\Bank;
use Illuminate\Support\Facades\Storage;

if (! function_exists('backpack_pro')) {
    function backpack_pro(): bool
    {
        return true;
    }
}

if (! function_exists('hide_numbers')) {
    function hide_numbers($number, $numToKeepStart = 3, $numToKeepEnd = 3, $maskCharacter = '*'): array|string
    {
        $totalLength = strlen($number);
        $visiblePart = $numToKeepStart + $numToKeepEnd;

        // Tạo chuỗi mới với các ký tự ẩn
        return substr_replace($number, str_repeat($maskCharacter, $totalLength - $visiblePart), $numToKeepStart, -$numToKeepEnd);
    }
}

if (! function_exists('bankOptions')) {
    function bankOptions(): array
    {
        foreach (Bank::all() as $maNganHang => $thongTinNganHang) {
            $formattedArray[$maNganHang] = $thongTinNganHang['code'] . '-' . $thongTinNganHang['label'];
        }

        return $formattedArray;
    }
}

if (! function_exists('bank_info')) {
    function bank_info($bankId): array
    {
        return Bank::all()[$bankId] ?? [];
    }
}


if (!function_exists('saveImgBase64')) {
    function saveImgBase64($param, $folder): string
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk();

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $folder.'/'.$fileName;
    }
}
