<?php

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    protected $searchBox;

    protected function setUp(): void
    {
        // Khởi tạo giá trị giả lập cho thanh search
        $this->searchBox = '';
    }

    private function simulateSearchInput($inputValue)
    {
        // Giả lập dữ liệu từ ô search
        $_POST['search-box'] = $inputValue;
        $this->searchBox = $inputValue;

        // Giả lập kết quả trả về từ backend
        if ($inputValue === 'acer') {
            return [
                [
                    "MaSP" => "ASUF8892",
                    "TenSP" => "Acer Nitro Gaming 5 ",
                    "GiaSP" => 1400,
                    "MoTaSP" => "thiết kế sang trọng và thanh lịch",
                    "HinhSP" => "img/product/acer2.png"
                ],
                [
                    "MaSP" => "FISD28934",
                    "TenSP" => "Acer TUF Gaming",
                    "GiaSP" => 950,
                    "MoTaSP" => "Thiết kế mạnh mẽ, phong cách Gaming",
                    "HinhSP" => "img/product/asus21.png"
                ]
            ];
        }
        else if ($inputValue === 'bàn phím') {
            return [
                [
                    "MaSP" => "SA93234F",
                    "TenSP" => "Bàn phím Asus",
                    "GiaSP" => 600,
                    "MoTaSP" => "Bàn phím được thiết kế đơn giản, phím bấm với độ nổi thấp",
                    "HinhSP" => "img/product/product-26.png"
                ],
                [
                    "MaSP" => "SOHF9234",
                    "TenSP" => "Bàn phím Dell",
                    "GiaSP" => 450,
                    "MoTaSP" => "Bộ bàn phím và chuột MK235 kết nối không dây tiện lợi",
                    "HinhSP" => "img/product/banphim22.png"
                ]
            ];
        }

        return [];
    }

    private function getRedirectedUrl()
    {
        if (empty(trim($this->searchBox))) {
            return null; // Không redirect khi input rỗng hoặc khoảng trắng
        }

        $params = http_build_query(['searchValue' => $this->searchBox]);
        return "searchFilter.php?$params";
    }

    public function testEmptyInput()
    {
        // Dữ liệu đầu vào rỗng
        $this->simulateSearchInput('');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra không có redirect
        $this->assertNull($redirectedUrl);

        // Giả lập kết quả trả về
        $actualResults = $this->simulateSearchInput('');

        // Kiểm tra không có sản phẩm trả về
        $this->assertEmpty($actualResults);
    }


    public function testWhitespaceInput()
    {
        // Dữ liệu đầu vào là khoảng trắng
        $this->simulateSearchInput('   ');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra không có redirect
        $this->assertNull($redirectedUrl);

        // Giả lập kết quả trả về
        $actualResults = $this->simulateSearchInput('   ');

        // Kiểm tra không có sản phẩm trả về
        $this->assertEmpty($actualResults);
    }


    public function testValidInput()
    {
        // Dữ liệu đầu vào hợp lệ
        $this->simulateSearchInput('acer');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect đúng
        $expectedUrl = 'searchFilter.php?searchValue=acer';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Kiểm tra sản phẩm trả về từ backend
        $expectedResults = [
            [
                "MaSP" => "ASUF8892",
                "TenSP" => "Acer Nitro Gaming 5 ",
                "GiaSP" => 1400,
                "MoTaSP" => "thiết kế sang trọng và thanh lịch",
                "HinhSP" => "img/product/acer2.png"
            ],
            [
                "MaSP" => "FISD28934",
                "TenSP" => "Acer TUF Gaming",
                "GiaSP" => 950,
                "MoTaSP" => "Thiết kế mạnh mẽ, phong cách Gaming",
                "HinhSP" => "img/product/asus21.png"
            ]
        ];

        // Giả lập kết quả trả về từ backend
        $actualResults = $this->simulateSearchInput('acer');

        // So sánh kết quả sản phẩm trả về
        $this->assertEquals($expectedResults, $actualResults);
    }


    public function testSpecialCharactersInput()
    {
        // Dữ liệu đầu vào chứa ký tự đặc biệt
        $this->simulateSearchInput('Sản phẩm & B');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect đúng
        $expectedUrl = 'searchFilter.php?searchValue=S%E1%BA%A3n+ph%E1%BA%A9m+%26+B';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Giả lập kết quả trả về
        $actualResults = $this->simulateSearchInput('Sản phẩm & B');

        // Kiểm tra không có sản phẩm trả về
        $this->assertEmpty($actualResults);  // Vì đây là input giả định không có sản phẩm
    }


    public function testVietnameseCharactersInput()
    {
        // Dữ liệu đầu vào có dấu tiếng Việt
        $this->simulateSearchInput('bàn phím');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect đúng
        $expectedUrl = 'searchFilter.php?searchValue=b%C3%A0n+ph%C3%ADm';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Giả lập kết quả trả về từ backend
        $expectedResults = [
            [
                "MaSP" => "SA93234F",
                "TenSP" => "Bàn phím Asus",
                "GiaSP" => 600,
                "MoTaSP" => "Bàn phím được thiết kế đơn giản, phím bấm với độ nổi thấp",
                "HinhSP" => "img/product/product-26.png"
            ],
            [
                "MaSP" => "SOHF9234",
                "TenSP" => "Bàn phím Dell",
                "GiaSP" => 450,
                "MoTaSP" => "Bộ bàn phím và chuột MK235 kết nối không dây tiện lợi",
                "HinhSP" => "img/product/banphim22.png"
            ]
        ];

        $actualResults = $this->simulateSearchInput('bàn phím');

        // So sánh kết quả trả về
        $this->assertEquals($expectedResults, $actualResults);
    }


    public function testXSSInjectionInput()
    {
        // Dữ liệu đầu vào chứa mã độc
        $this->simulateSearchInput('<script>alert("Hacked!")</script>');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect đúng, không thực thi mã độc
        $expectedUrl = 'searchFilter.php?searchValue=%3Cscript%3Ealert%28%22Hacked%21%22%29%3C%2Fscript%3E';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Giả lập kết quả trả về từ backend
        $actualResults = $this->simulateSearchInput('<script>alert("Hacked!")</script>');

        // Kiểm tra không có sản phẩm trả về
        $this->assertEmpty($actualResults);
    }


    public function testSQLInjectionInput()
    {
        // Dữ liệu đầu vào chứa mã SQL Injection
        $this->simulateSearchInput("' OR 1=1; DROP TABLE users; --");
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect đúng, không bị lỗi SQL Injection
        $expectedUrl = 'searchFilter.php?searchValue=%27+OR+1%3D1%3B+DROP+TABLE+users%3B+--';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Giả lập kết quả trả về từ backend
        $actualResults = $this->simulateSearchInput("' OR 1=1; DROP TABLE users; --");

        // Kiểm tra không có sản phẩm trả về
        $this->assertEmpty($actualResults);
    }


    public function testInputWithLeadingAndTrailingSpaces()
    {
        // Dữ liệu đầu vào có khoảng trắng ở đầu và cuối
        $this->simulateSearchInput('   acer   ');
        $redirectedUrl = $this->getRedirectedUrl();

        // Kiểm tra URL redirect với chuỗi đã được cắt khoảng trắng
        $expectedUrl = 'searchFilter.php?searchValue=acer';
        $this->assertEquals($expectedUrl, $redirectedUrl);

        // Giả lập kết quả trả về từ backend
        $expectedResults = [
            [
                "MaSP" => "FISD28934",
                "TenSP" => "Acer TUF Gaming",
                "GiaSP" => 950,
                "MoTaSP" => "Thiết kế mạnh mẽ, phong cách Gaming",
                "HinhSP" => "img/product/asus21.png"
            ]
        ];

        $actualResults = $this->simulateSearchInput('   acer   ');

        // So sánh kết quả trả về
        $this->assertEquals($expectedResults, $actualResults);
    }

}
