<?php

require_once('./global.php');
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $data = $_POST;
    $email = !empty($data['email']) ? $data['email'] : '';
    $password = !empty($data['password']) ? md5($data['password']) : '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $stmt->execute([
        ':email' => $email
    ]);

    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $user = current($user);
    $status = 'success';

    if (empty($user) || $password !== $user['password']) {
        $status = 'error';
    }

    if ($status == 'success') {
        $_SESSION['identity'] = $user;
    }
    unset($user['password']);

    echo json_encode([
        'status' => $status,
        'user' => $user
    ]);

}







