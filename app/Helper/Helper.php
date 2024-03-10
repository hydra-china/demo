<?php

use App\Helper\Bank;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

if (!function_exists('backpack_pro')) {
    function backpack_pro(): bool
    {
        return true;
    }
}

if (!function_exists('hide_numbers')) {
    function hide_numbers($number, $numToKeepStart = 3, $numToKeepEnd = 3, $maskCharacter = '*'): array|string
    {
        $totalLength = strlen($number);
        $visiblePart = $numToKeepStart + $numToKeepEnd;

        // Tạo chuỗi mới với các ký tự ẩn
        return substr_replace($number, str_repeat($maskCharacter, $totalLength - $visiblePart), $numToKeepStart, -$numToKeepEnd);
    }
}

if (!function_exists('bankOptions')) {
    function bankOptions(): array
    {
        foreach (Bank::all() as $maNganHang => $thongTinNganHang) {
            $formattedArray[$maNganHang] = "<b>AAA</b>" . $thongTinNganHang['code'] . '-' . $thongTinNganHang['label'];
        }

        return $formattedArray;
    }
}

if (!function_exists('bankOptionsWithIcon')) {
    function bankOptionsWithIcon(): array
    {
        foreach (Bank::all() as $maNganHang => $thongTinNganHang) {
            $formattedArray[$maNganHang] = [
                'label' => $thongTinNganHang['label'] == '' ? asset('img/logo/empty-bank.png') : $thongTinNganHang['label'],
                'image' => $thongTinNganHang['image'] == '' ? asset('img/logo/empty-bank.png') : $thongTinNganHang['image']
            ];
        }

        return $formattedArray;
    }
}

if (!function_exists('bank_info')) {
    function bank_info($bankId): array
    {
        $data = Bank::all()[$bankId] ?? [];

        if ($data['image'] == '') {
            $data['image'] = 'https://cdn-icons-png.flaticon.com/512/4770/4770298.png';
            $data['banner'] = 'https://cdn-icons-png.flaticon.com/512/4770/4770298.png';
        }

        return $data;
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

        return $folder . '/' . $fileName;
    }
}

if (!function_exists('has_permission')) {
    function has_permission($permissionName): bool
    {
        if (!backpack_auth()->check()) {
            return false;
        }

        $userId = backpack_user()->id;

        $user = User::query()->where('id', $userId);

        if (backpack_user()->name == 'admin') {
            return true;
        }

        $permission = DB::table('permissions')->where('key', $permissionName)->first();

        $permissionExist = DB::table('department_permission')
            ->where('department_id', $user->department_id)
            ->where('permission_id', $permission->getAttribute('id'))
            ->get();

        if ($permissionExist) {
            return true;
        }

        return false;
    }
}
