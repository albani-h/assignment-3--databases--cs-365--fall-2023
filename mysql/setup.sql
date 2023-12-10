DROP DATABASE IF EXISTS student_passwords;
CREATE DATABASE  student_passwords;
DROP USER IF EXISTS 'passwords_user'@'localhost';
CREATE USER 'passwords_user'@'localhost'IDENTIFIED BY '123';
GRANT ALL ON student_passwords. * TO 'passwords_user'@'localhost';
USE student_passwords;
CREATE TABLE user_info(
                        user_id INT NOT NULL AUTO_INCREMENT,
                        email varchar(75),
                        PRIMARY KEY (user_id)

);

CREATE TABLE account_entry(
                            user_ip INT NOT NULL AUTO_INCREMENT,
                            website_url VARCHAR(100),
                            website_name VARCHAR (100) NOT NULL,
                            username varchar(15)NOT NULL,
                            user_password VARBINARY(30),
                            account_comment VARCHAR (250)NOT NULL,
                            PRIMARY KEY (user_ip,username, website_name)
);

INSERT INTO user_info (email) VALUES ( "cset@yahoo.com");
INSERT INTO user_info (email) VALUES ( "emgil@yahoo.com");
INSERT INTO user_info (email) VALUES ("rchad@yahoo.com");
INSERT INTO user_info (email) VALUES ("arusso@outlook.com");
INSERT INTO user_info (email) VALUES ( "jrusso@yahoo.com");
INSERT INTO user_info (email) VALUES ("mrusso@yahoo.com");
INSERT INTO user_info (email) VALUES ("hmon@gmail.com");
INSERT INTO user_info (email) VALUES ("rbax@bing.com");
INSERT INTO user_info (email) VALUES ("cwilde@yahoo.com");
INSERT INTO user_info (email) VALUES ("idaniels@yahoo.com");

INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ( "https://www.disneyplus.com","Disney+", "cset",AES_ENCRYPT("red","key"),"password created for Cleo Setori" );
INSERT INTO account_entry(website_url,website_name,username,user_password,account_comment)  VALUES ( "http://www.sephora.com","Sephora.com","emgil", AES_ENCRYPT("orange","key"),"password created for emgil");
INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ( "https://www.youtube","YouTube", "rchad",AES_ENCRYPT("yellow","key"), "password created for username rchad");
INSERT INTO account_entry(website_url,website_name,username,user_password,account_comment)  VALUES ( "http://max.com","max.com ","arusso", AES_ENCRYPT("green","key"), "password created for hbomax user: arusso");
INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ( "http://www.wordpress.com","WordPress.com","jrusso", AES_ENCRYPT("blue","key"),"password created for WordPress user :jrusso" );
INSERT INTO account_entry(website_url,website_name,username,user_password,account_comment)  VALUES ( "http://www.amazon.com","amazon.com","mrusso", AES_ENCRYPT("indigo","key"),"new amazon account registered");
INSERT INTO account_entry(website_url,website_name,username,user_password,account_comment)  VALUES ( "http://www.paramountplus.com","Paramount Plus","hannahmontana", AES_ENCRYPT("violet","key"), "password created for Paramount Plus user Max Russo");
INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ("http://www.bhphotovideo.com","B&H","rbaxter", AES_ENCRYPT("sage","key"),"new account for Raven Baxter");
INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ("http://www.apple.com","Apple.com","cwilde", AES_ENCRYPT("lavender777","key"), "Apple password for user: cwilde created.");
INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment) VALUES ("http://www.soundcloud.com","SoundCloud.com","idaniels", AES_ENCRYPT("dogs1234","key"),"Soundcloud user idaniels has created password.");

CREATE VIEW EVERYTHING AS SELECT * FROM USER_INFO,ACCOUNT_ENTRY WHERE user_info.user_id=account_entry.user_ip;
