<?php

use App\Helper\Bank;

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
