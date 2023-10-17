<?php

class DbHelper {

    public static function tryCreateDB() {
        $db = DB_NAME;
        $pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS);
        $query = "CREATE DATABASE IF NOT EXISTS $db";
        $pdo->exec($query);
    }

    public static function deploy($db) {
        $query = $db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if ( count($tables) == 0 ) {
            $hash = '$2y$10$bFU9Mj1GMR6yzxoQ06i.8Oc6B6x1ZYCAtOop7LzXDvJxlee29KA9W';
            $sql = <<<END
            -- phpMyAdmin SQL Dump
            -- version 5.2.1
            -- https://www.phpmyadmin.net/
            --
            -- Host: 127.0.0.1
            -- Generation Time: Oct 17, 2023 at 08:59 AM
            -- Server version: 10.4.28-MariaDB
            -- PHP Version: 8.2.4
            
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            START TRANSACTION;
            SET time_zone = "+00:00";
            
            
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;
            
            --
            -- Database: `musica`
            --
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `albumes`
            --
            
            CREATE TABLE `albumes` (
              `album_id` int(3) NOT NULL,
              `album_nombre` varchar(50) NOT NULL,
              `artista` varchar(50) NOT NULL,
              `anio` int(4) NOT NULL,
              `discografica` varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
            
            --
            -- Dumping data for table `albumes`
            --
            
            INSERT INTO `albumes` (`album_id`, `album_nombre`, `artista`, `anio`, `discografica`) VALUES
            (20, 'The Piper at the Gates of Dawn', 'Pink Floyd', 1967, 'EMI Columbia'),
            (23, 'Black Album', 'Metallica', 1991, 'Elektra Records');
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `canciones`
            --
            
            CREATE TABLE `canciones` (
              `cancion_id` int(4) NOT NULL,
              `cancion_nombre` varchar(50) NOT NULL,
              `album` int(3) NOT NULL,
              `duracion` int(4) NOT NULL,
              `track` int(2) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
            
            --
            -- Dumping data for table `canciones`
            --
            
            INSERT INTO `canciones` (`cancion_id`, `cancion_nombre`, `album`, `duracion`, `track`) VALUES
            (29, 'Sad but True', 23, 331, 2);
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `usuarios`
            --
            
            CREATE TABLE `usuarios` (
              `user_id` int(3) NOT NULL,
              `user` varchar(50) NOT NULL,
              `password` varchar(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
            
            --
            -- Dumping data for table `usuarios`
            --
            
            INSERT INTO `usuarios` (`user_id`, `user`, `password`) VALUES
            (1, 'webadmin', '$hash');
            
            --
            -- Indexes for dumped tables
            --
            
            --
            -- Indexes for table `albumes`
            --
            ALTER TABLE `albumes`
              ADD PRIMARY KEY (`album_id`);
            
            --
            -- Indexes for table `canciones`
            --
            ALTER TABLE `canciones`
              ADD PRIMARY KEY (`cancion_id`),
              ADD KEY `FK_album` (`album`);
            
            --
            -- Indexes for table `usuarios`
            --
            ALTER TABLE `usuarios`
              ADD PRIMARY KEY (`user_id`);
            
            --
            -- AUTO_INCREMENT for dumped tables
            --
            
            --
            -- AUTO_INCREMENT for table `albumes`
            --
            ALTER TABLE `albumes`
              MODIFY `album_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
            
            --
            -- AUTO_INCREMENT for table `canciones`
            --
            ALTER TABLE `canciones`
              MODIFY `cancion_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
            
            --
            -- AUTO_INCREMENT for table `usuarios`
            --
            ALTER TABLE `usuarios`
              MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            
            --
            -- Constraints for dumped tables
            --
            
            --
            -- Constraints for table `canciones`
            --
            ALTER TABLE `canciones`
              ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`album`) REFERENCES `albumes` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
            COMMIT;
            
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            END;
            $db->query($sql);
        }
    }
}