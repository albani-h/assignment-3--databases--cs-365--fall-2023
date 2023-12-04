DROP DATABASE IF EXISTS student_passwords;
CREATE DATABASE  student_passwords;
DROP USER IF EXISTS 'passwords_user'@'localhost';
CREATE USER 'passwords_user'@'localhost'IDENTIFIED BY '123';
GRANT ALL ON student_passwords. * TO 'passwords_user'@'localhost';
USE student_passwords;
