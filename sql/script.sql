DROP DATABASE IF EXISTS youdemy_db;
CREATE DATABASE youdemy_db;
USE youdemy_db;





CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Etudiant','Admin', 'Enseignant') NOT NULL ,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
);


CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
    
);


CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    contenu text  NOT NULL,
    description TEXT,
    video_path VARCHAR(255),
    document_path VARCHAR(255),
    photo_url VARCHAR(255),
    teacher_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT check_content CHECK (video_path IS NOT NULL OR document_path IS NOT NULL),
    price DECIMAL(10,2) DEFAULT 0.00
);


CREATE TABLE course_tags (
    course_id INT,
    tag_id INT,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

select * from users;