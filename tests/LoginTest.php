<?php 

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    private $conn;

    protected function setUp(): void { // Hàm này chạy trước mỗi test case (Trước mỗi phương thức test, phương thức setUp() được gọi.)
        putenv('DB_NAME=laptrinhweb2_test');
        
        // Sử dụng biến môi trường để lấy tên cơ sở dữ liệu
        $dbname = getenv('DB_NAME');
        
        // Tạo kết nối với cơ sở dữ liệu test
        $this->conn = new mysqli("localhost", "root", "", $dbname);
        
        // Tạo bảng và thêm dữ liệu mẫu
        $this->conn->query("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255),
            password VARCHAR(255),
            role VARCHAR(50)
        )");

        $this->conn->query("INSERT INTO users (username, password, role) VALUES 
            ('testuser', '" . password_hash('correct_password', PASSWORD_DEFAULT) . "', 'user'),
            ('adminuser', '" . password_hash('admin_password', PASSWORD_DEFAULT) . "', 'admin')");
    }

    protected function tearDown(): void { // Hàm này chạy sau mỗi test case (Sau mỗi phương thức test, phương thức tearDown() được gọi.)
        $this->conn->query("DROP TABLE users");
        $this->conn->close();
    }

    public function testUsernameDoesNotExist() {
        $_POST['username'] = 'nonexistent';
        $_POST['password'] = 'password';
        ob_start();
        include 'D:\\xampp\\htdocs\\ProjectWeb\\xulyLogin.php'; // Path to xulyLogin.php
        $output = ob_get_clean();
    
        $this->assertEquals('failure', trim($output));
    }

    public function testWrongPassword() {
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'wrong_password';
        ob_start();
        include 'D:\\xampp\\htdocs\\ProjectWeb\\xulyLogin.php'; // Path to xulyLogin.php
        $output = ob_get_clean();

        $this->assertEquals('failure', trim($output));
    }

    public function testLoginSuccessUser() {
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'correct_password';
        ob_start();
        include 'D:\\xampp\\htdocs\\ProjectWeb\\xulyLogin.php'; // Path to xulyLogin.php
        $output = ob_get_clean();

        $this->assertEquals('success', trim($output));
        $this->assertFalse($_SESSION['isAdmin']);
    }

    public function testLoginSuccessAdmin() {
        $_POST['username'] = 'adminuser';
        $_POST['password'] = 'admin_password';
        ob_start();
        include 'D:\\xampp\\htdocs\\ProjectWeb\\xulyLogin.php'; // Path to xulyLogin.php
        $output = ob_get_clean();

        $this->assertEquals('success', trim($output));
        $this->assertTrue($_SESSION['isAdmin']);
    }

    public function testSQLInjection() {
        $_POST['username'] = "'; DROP TABLE users; --";
        $_POST['password'] = 'password';
        ob_start();
        include 'D:\\xampp\\htdocs\\ProjectWeb\\xulyLogin.php'; // Path to xulyLogin.php
        $output = ob_get_clean();

        $this->assertEquals('failure', trim($output));
    }
}
// ./vendor/bin/phpunit tests/LoginTest.php
?>