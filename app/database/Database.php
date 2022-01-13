<?php

$ok = 'ok';

// class Database {

//     private $connection;

//     public function __construct(String $server, String $db, String $user, String $password){
//         try {
//             $connection = new PDO(
//                 'mysql:host='.$this->server.';dbname='.$this->db.';charset=utf8',
//                 $user,
//                 $password,
//                 [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//             );

//             $this->connection = $connection;
//         } catch (PDOException $excep) {
//             die('Erreur :' . $excep->getMessage());
//         }
//     }

//     public function getConnection() {
//         return $this->connection;
//     }

// }