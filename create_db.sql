CREATE DATABASE IF NOT EXISTS type_racing;

USE type_racing;

CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    time_seconds DECIMAL(8,2) NOT NULL,
    accuracy DECIMAL(5,2) NOT NULL,
    mistakes INT NOT NULL,
    created_at DATETIME NOT NULL
    );