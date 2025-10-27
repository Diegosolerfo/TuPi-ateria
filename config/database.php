<?php
return [
    'host' => 'localhost',
    'dbname' => 'proyecto_pi',
    'username' => 'root',
    'password' => 'contra123P*w', // Dejar vacío o poner la contraseña que uses localmente
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];
