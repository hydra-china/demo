<?php
/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 26/02/2024 2:50 pm
 */

namespace App\Helper;

class Bank
{
    public static function all(): array
    {
        return [
            0 => [
                'name' => 'Vietcombank',
                'code' => 'VCB',
                'label' => 'Ngân hàng Ngoại thương Việt Nam (Vietcombank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-Vietcombank.png',
            ],
            1 => [
                'name' => 'VietinBank',
                'code' => 'CTG',
                'label' => 'Ngân hàng Công thương Việt Nam (VietinBank)',
                'image' => 'https://example.com/vietinbank.png',
            ],
            2 => [
                'name' => 'ACB',
                'code' => 'ACB',
                'label' => 'Ngân hàng Á Châu (ACB)',
                'image' => 'https://example.com/acb.png',
            ],
            3 => [
                'name' => 'MBBank',
                'code' => 'MBB',
                'label' => 'Ngân hàng Quân đội (MBBank)',
                'image' => 'https://example.com/mbbank.png',
            ],
            4 => [
                'name' => 'TPBank',
                'code' => 'TPB',
                'label' => 'Ngân hàng Tiền Phong (TPBank)',
                'image' => 'https://example.com/tpbank.png',
            ],
            5 => [
                'name' => 'BIDV',
                'code' => 'BID',
                'label' => 'Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)',
                'image' => 'https://example.com/bidv.png',
            ],
            6 => [
                'name' => 'Sacombank',
                'code' => 'STB',
                'label' => 'Ngân hàng Sài Gòn Thương Tín (Sacombank)',
                'image' => 'https://example.com/sacombank.png',
            ],
            7 => [
                'name' => 'Techcombank',
                'code' => 'TCB',
                'label' => 'Ngân hàng Techcombank',
                'image' => 'https://example.com/techcombank.png',
            ],
            8 => [
                'name' => 'DongA',
                'code' => 'DAB',
                'label' => 'Ngân hàng Đông Á',
                'image' => 'https://example.com/donga.png',
            ],
            9 => [
                'name' => 'Eximbank',
                'code' => 'EIB',
                'label' => 'Ngân hàng Xuất nhập khẩu (Eximbank)',
                'image' => 'https://example.com/eximbank.png',
            ],
            10 => [
                'name' => 'MaritimeBank',
                'code' => 'MSB',
                'label' => 'Ngân hàng Hàng Hải (MaritimeBank)',
                'image' => 'https://example.com/maritimebank.png',
            ],
            11 => [
                'name' => 'NamABank',
                'code' => 'NAM',
                'label' => 'Ngân hàng Nam Á (NamABank)',
                'image' => 'https://example.com/namabank.png',
            ],
            12 => [
                'name' => 'Agribank',
                'code' => 'AGR',
                'label' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn (Agribank)',
                'image' => 'https://example.com/agribank.png',
            ],
            13 => [
                'name' => 'VIB',
                'code' => 'VIB',
                'label' => 'Ngân hàng Quốc tế (VIB)',
                'image' => 'https://example.com/vib.png',
            ],
            14 => [
                'name' => 'SHB',
                'code' => 'SHB',
                'label' => 'Ngân hàng Sài Gòn Hà Nội (SHB)',
                'image' => 'https://example.com/shb.png',
            ],
            15 => [
                'name' => 'VPBank',
                'code' => 'VPB',
                'label' => 'Ngân hàng Việt Nam Thịnh Vượng (VPBank)',
                'image' => 'https://example.com/vpbank.png',
            ],
            16 => [
                'name' => 'SeABank',
                'code' => 'SEA',
                'label' => 'Ngân hàng Đông Nam Á (SeABank)',
                'image' => 'https://example.com/seabank.png',
            ],
        ];
    }
}
