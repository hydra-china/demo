<?php
/**
 * @author Phạm Quang Linh <linhpq@getflycrm.com>
 * @since 26/02/2024 2:50 pm
 */

namespace App\Helper;

class Bank
{
    public static function all()
    {
        return [
            0 => [
                'name' => 'BIDV',
                'code' => 'BIDV',
                'label' => 'Ngân hàng Đầu tư và Phát triển Việt Nam',
                'image' => asset('img/logo/logo-ngan-hang-BIDV.png'),
                'banner' => asset('img/logo/logo-ngan-hang-BIDV.png'),
            ],
            1 => [
                'name' => 'ACB',
                'code' => 'ACB',
                'label' => 'Ngân hàng Á Châu',
                'image' => asset('img/logo/logo-ngan-hang-ACB.png'),
                'banner' => asset('img/logo/logo-ngan-hang-ACB.png')
            ],
            2 => [
                'name' => 'MB',
                'code' => 'MB',
                'label' => 'Ngân hàng Quân Đội',
                'image' => asset('img/logo/logo-ngan-hang-MB-new2020.gif'),
                'banner' => asset('img/logo/logo-ngan-hang-MB-new2020.gif')
            ],
            3 => [
                'name' => 'VPBank',
                'code' => 'VPBank',
                'label' => 'Ngân hàng Thương mại cổ phần Việt Nam Thịnh Vượng',
                'image' => asset('img/logo/logo-ngan-hang-VPBank.png'),
                'banner' => asset('img/logo/logo-ngan-hang-VPBank.png'),
            ],
            4 => [
                'name' => 'TPBank',
                'code' => 'TPBank',
                'label' => 'Ngân hàng Tiên Phong TPBank',
                'image' => asset('img/logo/TPbank-logo.png'),
                'banner' => asset('img/logo/TPbank-logo.png')
            ],
            5 => [
                'name' => 'Vietinbank',
                'code' => 'Vietinbank',
                'label' => 'Ngân hàng công thương Việt Nam',
                'image' => asset('img/logo/logo-ngan-hang-Vietinbank.png'),
                'banner' => asset('img/logo/logo-ngan-hang-Vietinbank.png')
            ],
            6 => [
                'name' => 'Agribank',
                'code' => 'Agribank',
                'label' => 'Ngân hàng NN & PTNT VN',
                'image' => asset('img/logo/Agribank-logo.png'),
                'banner' => asset('img/logo/Agribank-logo.png'),
            ],
            7 => [
                'name' => 'Techcombank',
                'code' => 'Techcombank',
                'label' => 'Ngân hàng Kỹ thương Việt Nam',
                'image' => asset('img/logo/logo-ngan-hang-Techcombank.png'),
                'banner' => asset('img/logo/logo-ngan-hang-Techcombank.png'),
            ],
            8 => [
                'name' => 'Vietcombank',
                'code' => 'Vietcombank',
                'label' => 'Ngân hàng TMCP Ngoại Thương',
                'image' => asset('img/logo/logo-ngan-hang-Vietcombank.png'),
                'banner' => asset('img/logo/logo-ngan-hang-Vietcombank.png'),
            ],
            9 => [
                'name' => 'ABBank',
                'code' => 'ABBank',
                'label' => 'Ngân hàng An Bình',
                'image' => '',
                'banner' => ''
            ],
            10 => [
                'name' => 'Baoviet Bank',
                'code' => 'Baoviet Bank',
                'label' => 'Ngân hàng TMCP Bảo Việt',
                'image' => asset('img/logo/BAOVIET-bank-logo.png'),
                'banner' => asset('img/logo/BAOVIET-bank-logo.png'),
            ],
            11 => [
                'name' => 'CIMB',
                'code' => 'CIMB',
                'label' => 'Ngân hàng TNHH MTV CIMB Việt Nam',
                'image' => '',
                'banner' => ''
            ],
            12 => [
                'name' => 'Eximbank',
                'code' => 'Eximbank',
                'label' => 'Ngân hàng Xuất nhập khẩu Việt Nam',
                'image' => asset('img/logo/Eximbank.jpg'),
                'banner' => asset('img/logo/Eximbank.jpg'),
            ],
            13 => [
                'name' => 'GP Bank',
                'code' => 'GP Bank',
                'label' => 'Ngân hàng Dầu khí Toàn cầu',
                'image' => asset('img/logo/GPBANK-logo.png'),
                'banner' => asset('img/logo/GPBANK-logo.png'),
            ],
            14 => [
                'name' => 'HDBank',
                'code' => 'HDBank',
                'label' => 'Ngân hàng Phát triển TP HCM',
                'image' => asset('img/logo/HDBank.png'),
                'banner' => asset('img/logo/HDBank.png'),
            ],
            15 => [
                'name' => 'HLO',
                'code' => 'HLO',
                'label' => 'Ngân hàng Hong Leong Viet Nam',
                'image' => '',
                'banner' => ''
            ],
            16 => [
                'name' => 'Kienlongbank',
                'code' => 'Kienlongbank',
                'label' => 'Ngân hàng Kiên Long',
                'image' => asset('img/logo/KienLongBank-logo.png'),
                'banner' => asset('img/logo/KienLongBank-logo.png'),
            ],
            17 => [
                'name' => 'Lienvietbank',
                'code' => 'Lienvietbank',
                'label' => 'Ngan hàng TMCP Bưu điện Liên Việt',
                'image' => asset('img/logo/LienVietPostBank-logo.png'),
                'banner' => asset('img/logo/LienVietPostBank-logo.png'),
            ],
            18 => [
                'name' => 'MSB',
                'code' => 'MSB',
                'label' => 'Ngân hàng Hàng Hải Việt Nam',
                'image' => asset('img/logo/MSB-bank-logo.png'),
                'banner' => asset('img/logo/MSB-bank-logo.png'),
            ],
            19 => [
                'name' => 'Nam A Bank',
                'code' => 'Nam A Bank',
                'label' => 'Ngân hàng Nam Á',
                'image' => asset('img/logo/NAMA-Bank-logo.png'),
                'banner' => asset('img/logo/NAMA-Bank-logo.png'),
            ],
            20 => [
                'name' => 'NASBank',
                'code' => 'NASBank',
                'label' => 'Ngân hàng Bắc Á',
                'image' => asset('img/logo/BACA-bank-logo.png'),
                'banner' => asset('img/logo/BACA-bank-logo.png'),
            ],
            21 => [
                'name' => 'NCB',
                'code' => 'NCB',
                'label' => 'Ngân hàng Quoc Dan',
                'image' => asset('img/logo/NCB-Bank-logo.png'),
                'banner' => asset('img/logo/NCB-Bank-logo.png'),
            ],
            22 => [
                'name' => 'OCBC',
                'code' => 'OCBC',
                'label' => 'Oversea - Chinese Bank',
                'image' => '',
                'banner' => ''
            ],
            23 => [
                'name' => 'Ocean Bank',
                'code' => 'Ocean Bank',
                'label' => 'Ngân hàng Đại Dương',
                'image' => asset('img/logo/Oceanbank-logo.png'),
                'banner' => asset('img/logo/Oceanbank-logo.png'),
            ],
            24 => [
                'name' => 'OCB',
                'code' => 'OCB',
                'label' => 'Ngân hàng Phương Đông',
                'image' => asset('img/logo/OCB-bank-logo.png'),
                'banner' => asset('img/logo/OCB-bank-logo.png'),
            ],
            25 => [
                'name' => 'PG Bank',
                'code' => 'PG Bank',
                'label' => 'Ngân hàng Xăng dầu Petrolimex',
                'image' => asset('img/logo/PG-bank-logo.png'),
                'banner' => asset('img/logo/PG-bank-logo.png'),
            ],
            26 => [
                'name' => 'PVcombank',
                'code' => 'PVcombank',
                'label' => 'NH TMCP Đại Chúng Viet Nam',
                'image' => asset('img/logo/PVcom-bank-logo.png'),
                'banner' => asset('img/logo/PVcom-bank-logo.png'),
            ],
            27 => [
                'name' => 'QTDCS',
                'code' => 'QTDCS',
                'label' => 'Quỹ tín dụng cơ sở',
                'image' => '',
                'banner' => ''
            ],
            28 => [
                'name' => 'Sacombank',
                'code' => 'Sacombank',
                'label' => 'Ngân hàng Sài Gòn Thương Tín',
                'image' => asset('img/logo/logo-ngan-hang-Sacombank.png'),
                'banner' => asset('img/logo/logo-ngan-hang-Sacombank.png'),
            ],
            29 => [
                'name' => 'Saigonbank',
                'code' => 'Saigonbank',
                'label' => 'Ngân hàng Sài Gòn Công Thương',
                'image' => asset('img/logo/Saigonbank-logo.png'),
                'banner' => asset('img/logo/Saigonbank-logo.png'),
            ],
            30 => [
                'name' => 'SCB',
                'code' => 'SCB',
                'label' => 'Ngân hàng TMCP Sài Gòn',
                'image' => asset('img/logo/logo-ngan-hang-SCB.png'),
                'banner' => asset('img/logo/logo-ngan-hang-SCB.png'),
            ],
            31 => [
                'name' => 'SCBank',
                'code' => 'SCBank',
                'label' => 'Ngân hàng Standard Chartered Bank Việt Nam',
                'image' => '',
                'banner' => ''
            ],
            32 => [
                'name' => 'SCBank HN',
                'code' => 'SCBank HN',
                'label' => 'Ngân hàng Standard Chartered Bank HN',
                'image' => '',
                'banner' => ''
            ],
            33 => [
                'name' => 'SCSB',
                'code' => 'SCSB',
                'label' => 'The Shanghai Commercial & Savings Bank CN Đồng Nai',
                'image' => '',
                'banner' => ''
            ],
            34 => [
                'name' => 'SeABank',
                'code' => 'SeABank',
                'label' => 'Ngân hàng TMCP Đông Nam Á',
                'image' => asset('img/logo/SeABank-logo.png'),
                'banner' => asset('img/logo/SeABank-logo.png'),
            ],
            35 => [
                'name' => 'SHB',
                'code' => 'SHB',
                'label' => 'Ngân hàng Sài Gòn - Hà Nội',
                'image' => asset('img/logo/logo-ngan-hang-SHB.png'),
                'banner' => asset('img/logo/logo-ngan-hang-SHB.png'),
            ],
            36 => [
                'name' => 'Shinhan Bank',
                'code' => 'Shinhan Bank',
                'label' => 'Ngân hàng TNHH MTV Shinhan Việt Nam',
                'image' => asset('img/logo/Shinhan-bank-logo.png'),
                'banner' => asset('img/logo/Shinhan-bank-logo.png'),
            ],
            37 => [
                'name' => 'SIAM',
                'code' => 'SIAM',
                'label' => 'Ngân hàng The Siam Commercial Public',
                'image' => '',
                'banner' => ''
            ],
            38 => [
                'name' => 'SMBC',
                'code' => 'SMBC',
                'label' => 'Sumitomo Mitsui Banking Corporation HCM',
                'image' => '',
                'banner' => ''
            ],
            39 => [
                'name' => 'SMBC HN',
                'code' => 'SMBC HN',
                'label' => 'Sumitomo Mitsui Banking Corporation HN',
                'image' => '',
                'banner' => ''
            ],
            40 => [
                'name' => 'SPB',
                'code' => 'SPB',
                'label' => 'Ngân hàng SinoPac',
                'image' => '',
                'banner' => ''
            ],
            41 => [
                'name' => 'TFCBHN',
                'code' => 'TFCBHN',
                'label' => 'Taipei Fubon Commercial Bank Ha Noi',
                'image' => '',
                'banner' => ''
            ],
            42 => [
                'name' => 'TFCBTPHCM',
                'code' => 'TFCBTPHCM',
                'label' => 'Taipei Fubon Commercial Bank TP Ho Chi Minh',
                'image' => '',
                'banner' => ''
            ],
            43 => [
                'name' => 'VBSP',
                'code' => 'VBSP',
                'label' => 'Ngân hàng Chính sách xã hội Việt Nam',
                'image' => '',
                'banner' => ''
            ],
            44 => [
                'name' => 'VDB',
                'code' => 'VDB',
                'label' => 'Ngân hàng Phát triển Việt Nam',
                'image' => '',
                'banner' => ''
            ],
            45 => [
                'name' => 'VIB',
                'code' => 'VIB',
                'label' => 'Ngân hàng Quốc tế',
                'image' => asset('img/logo/VIB-bank-logo.png'),
                'banner' => asset('img/logo/VIB-bank-logo.png'),
            ],
            46 => [
                'name' => 'VID public',
                'code' => 'VID public',
                'label' => 'Ngân hàng VID Public',
                'image' => '',
                'banner' => ''
            ],
            47 => [
                'name' => 'Viet Hoa Bank',
                'code' => 'Viet Hoa Bank',
                'label' => 'Ngân hàng Việt Hoa',
                'image' => '',
                'banner' => ''
            ],
            48 => [
                'name' => 'VietA Bank',
                'code' => 'VietA Bank',
                'label' => 'Ngân hàng Việt Á',
                'image' => '',
                'banner' => ''
            ],
            49 => [
                'name' => 'Vietbank',
                'code' => 'Vietbank',
                'label' => 'Ngân hàng Việt Nam Thương Tín',
                'image' => asset('img/logo/VIETBANK-logo.png'),
                'banner' => asset('img/logo/VIETBANK-logo.png')
            ],
            50 => [
                'name' => 'VietCapital Bank',
                'code' => 'VietCapital Bank',
                'label' => 'NHTMCP Bản Việt',
                'image' => asset('img/logo/VietCapitalBank-logo.png'),
                'banner' => asset('img/logo/VietCapitalBank-logo.png'),
            ],
            51 => [
                'name' => 'VNCB',
                'code' => 'VNCB',
                'label' => 'NH TMCP Xây dựng Việt Nam',
                'image' => '',
                'banner' => ''
            ],
            52 => [
                'name' => 'VRB',
                'code' => 'VRB',
                'label' => 'Ngân hàng Liên doanh Việt Nga',
                'image' => '',
                'banner' => ''
            ],
            53 => [
                'name' => 'Vung Tau',
                'code' => 'Vung Tau',
                'label' => 'Ngân hàng Vũng Tàu',
                'image' => '',
                'banner' => ''
            ],
            54 => [
                'name' => 'WHHCM',
                'code' => 'WHHCM',
                'label' => 'NH Woori HCM',
                'image' => '',
                'banner' => ''
            ],
            55 => [
                'name' => 'WHHN',
                'code' => 'WHHN',
                'label' => 'WOORI BANK Hà Nội',
                'image' => '',
                'banner' => ''
            ],
            56 => [
                'name' => 'Dong A Bank',
                'code' => 'Dong A Bank',
                'label' => 'Ngân hàng Đông Á',
                'image' => asset('img/logo/DongA-bank-logo.png'),
                'banner' => asset('img/logo/DongA-bank-logo.png')
            ],
        ];
    }
}
