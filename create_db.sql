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

INSERT INTO sentences (text) VALUES
("De zomers in Nederland worden steeds heter en het is belangrijk dat mensen, vooral degenen met een kwetsbare gezondheid or mensen die buiten werken, goed zijn beschermd tijdens periodes van hitte."),
("Als dieren die hierdoor getroffen worden niet behandeld worden, kan zo'n infectie in nog geen twee weken tot de dood leiden."),
("In het verleden heeft de vlieg zo voor tientallen miljoenen dollars schade aangericht aan de Amerikaanse veestapel. In zeldzame gevallen kunnen ook mensen getroffen worden."),
("De vlieg is ongeveer zo groot als een huisvlieg, maar heeft een veel langere snuit die gebruikt wordt om bloed te zuigen van dieren zoals runderen, paarden en schapen."),
("Tijdens de expeditie werden onder meer acht nog niet beschreven libellesoorten gevonden, drie nieuwe sprinkhaansoorten en ongeveer zestig motten- en vlindersoorten die tot nu toe nog onbekend waren voor de wetenschap."),
("De expeditie vond plaats in het kader van het project 'Biodiversiteit van de Amazone', dat gericht is op het in kaart brengen van de biodiversiteit in dit gebied en het identificeren van bedreigde soorten.");
