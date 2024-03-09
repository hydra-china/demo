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
                'banner' => asset('img/logo/logo-ngan-hang-Vietcombank.png')
            ],
            1 => [
                'name' => 'VietinBank',
                'code' => 'CTG',
                'label' => 'Ngân hàng Công thương Việt Nam (VietinBank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-VietinBank-CTG-Ori.png',
                'banner' => asset('img/logo/logo-ngan-hang-Vietinbank.png')
            ],
            2 => [
                'name' => 'ACB',
                'code' => 'ACB',
                'label' => 'Ngân hàng Á Châu (ACB)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-ACB-Ori.png',
                'banner' => asset('img/logo/logo-ngan-hang-ACB.png')
            ],
            3 => [
                'name' => 'MBBank',
                'code' => 'MBB',
                'label' => 'Ngân hàng Quân đội (MBBank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png',
                'banner' => asset('img/logo/logo-ngan-hang-MB-new2020.gif')
            ],
            4 => [
                'name' => 'TPBank',
                'code' => 'TPB',
                'label' => 'Ngân hàng Tiền Phong (TPBank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-TPBank.png',
                'banner' => asset('img/logo/TPbank-logo.png')
            ],
            5 => [
                'name' => 'BIDV',
                'code' => 'BID',
                'label' => 'Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/01/Icon-BIDV-.png',
                'banner' => asset('img/logo/logo-ngan-hang-BIDV.png')
            ],
            6 => [
                'name' => 'Sacombank',
                'code' => 'STB',
                'label' => 'Ngân hàng Sài Gòn Thương Tín (Sacombank)',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Logo-Sacombank-new.png',
                'banner' => asset('img/logo/logo-ngan-hang-Sacombank.png')
            ],
            7 => [
                'name' => 'Techcombank',
                'code' => 'TCB',
                'label' => 'Ngân hàng Techcombank',
                'image' => 'https://img7.thuthuatphanmem.vn/uploads/2023/07/06/mau-logo-techcombank-dep_045648494.png',
                'banner' => asset('img/logo/logo-ngan-hang-Techcombank.png')
            ],
            8 => [
                'name' => 'DongA',
                'code' => 'DAB',
                'label' => 'Ngân hàng Đông Á',
                'image' => 'https://media.licdn.com/dms/image/C510BAQH3oVF-9d7uGg/company-logo_200_200/0/1631360798710?e=2147483647&v=beta&t=iY4gtgTY2ByZNhmzMyIvqk9ZE-m1qyNEt4Oh7Kk8fqw',
                'banner' => asset('img/logo/DongA-bank-logo.png')
            ],
            9 => [
                'name' => 'Eximbank',
                'code' => 'EIB',
                'label' => 'Ngân hàng Xuất nhập khẩu (Eximbank)',
                'image' => 'https://play-lh.googleusercontent.com/ku03AFfcKRFoAZCg-coMNJdVFQ0pcDWwRxy416NMd4OJ7TlD21Ia3MyqrdN8LgJTOw',
                'banner' => asset('img/logo/Eximbank.jpg')
            ],
            10 => [
                'name' => 'MSBBank',
                'code' => 'MSB',
                'label' => 'Ngân hàng Hàng Hải (MaritimeBank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MSB.png',
                'banner' => asset('img/logo/MSB-bank-logo.png')
            ],
            11 => [
                'name' => 'NamABank',
                'code' => 'NAM',
                'label' => 'Ngân hàng Nam Á (NamABank)',
                'image' => 'https://play-lh.googleusercontent.com/w0Gx3O5kKOS1rbBANy741z15yQR4diJMXw6UHnVGNp3PCBTpEiNvCpt0dPCAHMtQBvw',
                'banner' => asset('img/logo/NAMA-Bank-logo.png')
            ],
            12 => [
                'name' => 'Agribank',
                'code' => 'AGR',
                'label' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn (Agribank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/01/Icon-Agribank.png',
                'banner' => asset('img/logo/Agribank-logo.png')
            ],
            13 => [
                'name' => 'VIB',
                'code' => 'VIB',
                'label' => 'Ngân hàng Quốc tế (VIB)',
                'image' => 'https://www.saokim.com.vn/wp-content/uploads/2023/01/Bieu-Tuong-Logo-Ngan-Hang-VIB.png',
                'banner' => asset('/img/logo/VIB-bank-logo.png')
            ],
            14 => [
                'name' => 'SHB',
                'code' => 'SHB',
                'label' => 'Ngân hàng Sài Gòn Hà Nội (SHB)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-SHB.png',
                'banner' => asset('img/logo/logo-ngan-hang-SHB.png')
            ],
            15 => [
                'name' => 'VPBank',
                'code' => 'VPB',
                'label' => 'Ngân hàng Việt Nam Thịnh Vượng (VPBank)',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/01/Icon-VPBank.png',
                'banner' => asset('img/logo/logo-ngan-hang-VPbank.png')
            ],
            16 => [
                'name' => 'SeABank',
                'code' => 'SEA',
                'label' => 'Ngân hàng Đông Nam Á (SeABank)',
                'image' => 'https://brademar.com/wp-content/uploads/2022/09/SeABank-Logo-PNG-3.png',
                'banner' => asset('img/logo/SeABank-logo.png')
            ],
        ];
    }
}
