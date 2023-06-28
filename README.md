
Daniel Santiago Gómez Abril Y1 Apolo11

<!-- CREACION DE TABLAS -->

CREATE DATABASE campuslands;
SHOW DATABASES;

CREATE TABLE country(
id_country int NOT NULL,
name_country varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
id_states int NOT NULL
) charset utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE states(
id_states int NOT NULL,
name_states varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
id_regions int NOT NULL
) charset utf8mb4;

CREATE TABLE regions(
id_regions int NOT NULL,
name_regions varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
id_camper int NOT NULL 
) charset utf8mb4;

CREATE TABLE campers(
id_campers varchar(20) NOT NULL,
name_camper varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
lastname_camper varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
birthdate DATE NOT NULL
)charset utf8mb4;

<!-- MODIFICACION DE TABLAS -->

ALTER TABLE country
ADD PRIMARY KEY (id_country);
ALTER TABLE country
MODIFY id_country int NOT NULL AUTO_INCREMENT;

ALTER TABLE states
ADD PRIMARY KEY (id_states);
ALTER TABLE states
MODIFY id_states int NOT NULL AUTO_INCREMENT;

ALTER TABLE regions
ADD PRIMARY KEY (id_regions);
ALTER TABLE regions
MODIFY id_regions int NOT NULL AUTO_INCREMENT;

ALTER TABLE campers
ADD PRIMARY KEY (id_campers);
ALTER TABLE campers
MODIFY id_campers int NOT NULL AUTO_INCREMENT;

ALTER TABLE states
ADD CONSTRAINT id_states_country FOREIGN KEY id_states REFERENCES country (id_country);

ALTER TABLES regions
ADD CONSTRAIN id_regions_states FOREIGN KEY id_regions REFERENCES states (id_states);

ALTER TABLES campers
ADD CONSTRAIN id_campers_regions FOREIGN KEY id_camper REFERENCES regions (id_regions);