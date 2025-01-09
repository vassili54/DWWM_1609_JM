/*
Mini faq
 */
 
-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS mini_faq;

-- CREER UNE BASE DE DONNEES
CREATE DATABASE IF NOT EXISTS mini_faq;

-- Sélectionner la base de données
USE mini_faq;

-- Créer la table des utilisateurs

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(128) NOT NULL UNIQUE,
    user_lastname VARCHAR(50) NOT NULL,
    user_firstname VARCHAR(50) NOT NULL
);

-- Créer la table des catégories

CREATE TABLE categories (
	category_name VARCHAR(30) PRIMARY KEY,
    category_description VARCHAR(255),
    category_order INT NOT NULL UNIQUE
);

-- Créer la table des questions

CREATE TABLE questions (
	question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_date DATE NOT NULL,
    question_label VARCHAR(255) NOT NULL,
    question_response TEXT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Créer la table de liaison entre les questions et les catégories

CREATE TABLE categories_questions (
	question_id INT,
    category_name VARCHAR(30),
    FOREIGN KEY (question_id) REFERENCES questions(question_id),
    FOREIGN KEY (category_name) REFERENCES categories(category_name),
    PRIMARY KEY (question_id, category_name)
);