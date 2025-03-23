<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $file = 'users.json';
    $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    if (isset($users[$username])) {
        echo json_encode(["status" => "error", "message" => "Логин уже занят!"]);
        exit;
    }

    $users[$username] = $password;
    file_put_contents($file, json_encode($users));

    echo json_encode(["status" => "success", "redirect" => "https://example.com"]);
}
?>
