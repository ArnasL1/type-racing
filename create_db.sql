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
    text TEXT NOT NULL
    );

UPDATE sentences SET text = "De zomers in Nederland worden steeds heter en het is belangrijk dat mensen, vooral degenen met een kwetsbare gezondheid or mensen die buiten werken, goed zijn beschermd tijdens periodes van hitte" WHERE id = 1;
UPDATE sentences SET text = "testing" WHERE id = 2;
UPDATE sentences SET text = "The quick brown fox jumps over the lazy dog" WHERE id = 3;