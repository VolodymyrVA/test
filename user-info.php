<?php

require_once('./global.php');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $data = $_POST;

    $id = !empty($data['id']) ? $data['id'] : '';
    $email = !empty($data['email']) ? $data['email'] : '';
    $name = !empty($data['name']) ? $data['name'] : '';
    $surname = !empty($data['surname']) ? $data['surname'] : '';
    $age = !empty($data['age']) ? $data['age'] : '';
    $country = !empty($data['country']) ? $data['country'] : '';
    $job = !empty($data['job']) ? $data['job'] : '';
    $img = !empty($data['img']) ? $data['img'] : '';

    // Fields validation needs here

    $stmt = $pdo->prepare('
        UPDATE users
        SET
            name = :name,
            surname = :surname,
            img = :img,
            age = :age,
            job = :job,
            country = :country
        WHERE id = :id'
    );

    $status = $result = $stmt->execute([
        ':name' => $name,
        ':surname' => $surname,
        ':img' => $img,
        ':age' => $age,
        ':country' => $country,
        ':job' => $job,
        ':id' => $id
    ]);

    echo json_encode([
        'status' => $status,
    ]);

} else {
     $stmt = $pdo->prepare('SELECT id, name, surname, img, age, job, country FROM users WHERE id = :id');
     $stmt->execute([
        ':id' => $_GET['id']
     ]);
     $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $user = current($user);
     echo json_encode([
         'user' => $user
     ]);
}
