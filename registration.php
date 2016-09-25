<?php
require_once('./global.php');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
   $data = $_POST;

   $stmt = $pdo->prepare('INSERT INTO users SET email = :email, password = :password');

   $stmt->execute( [
        'email' => $data['email'],
        ':password' => md5($data['password'])
   ]);

   $stmt = $pdo->prepare('SELECT id, name, surname, img, age, job, country FROM users WHERE email = :email');
   $stmt->execute([
       ':email' => $email
   ]);

   $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $user = current($user);
   $status = 'success';

   if (empty($user)) {
       $status = 'error';
   }

   if ($status == 'success') {
       $_SESSION['identity'] = $user;
   }

   echo json_encode([
       'status' => $status,
       'user' => $user
   ]);

}
