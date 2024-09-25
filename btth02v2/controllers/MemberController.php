<?php
require_once '../services/MemberService.php';

class MemberController {
    private $memberService;

    public function __construct() {
        $this->memberService = new MemberService();
    }

    public function login() {
        $error = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Vui lòng nhập cả tên đăng nhập và mật khẩu.";
            } else {
                $member = $this->memberService->getMemberByUsername($username);
                if ($member && $password == $member->getPassword()) {
                    // $_SESSION['member_id'] = $member->getId();
                    // $_SESSION['username'] = $member->getUsername();
                    header("Location: admin/index.php");
                    exit();
                } else {
                    $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                }
            }
        }

        include '../views/member/login.php';
    }
}
?>
