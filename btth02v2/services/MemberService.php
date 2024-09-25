<?php
require_once '../../configs/DBConnection.php';
require_once '../../models/Member.php';

class MemberService {
    private $conn;

    public function __construct() {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    public function getMemberByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch();
        if ($row) {
            return new Member($row['id'], $row['username'], $row['password'], $row['role']);
        }
        return null;
    }

    public function authenticate($username, $password) {
        $member = $this->getMemberByUsername($username);
        if ($member && $password == $member->getPassword()) {
            return $member;
        }
        return null;
    }

    public function countMembers() {
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM users");
        $row = $stmt->fetch();
        return $row['count'];
    }
}
?>
