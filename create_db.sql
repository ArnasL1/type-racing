CREATE DATABASE IF NOT EXISTS type_racing;

USE type_racing;

CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sentence_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    time_taken BIGINT NOT NULL,
    mistakes INT NOT NULL,
    created_at DATETIME NOT NULL
    );

CREATE TABLE IF NOT EXISTS sentences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sentence TEXT NOT NULL
    );
