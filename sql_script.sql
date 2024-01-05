
CREATE TABLE reader(
    reader_id INT NOT NULL AUTO_INCREMENT,
    reader_firstname varchar (70) NOT NULL,
    reader_lastname varchar (70) NOT NULL,
    reader_email varchar (70) NOT NULL,
    reader_password  varchar (70) NOT NULL,
    reader_contact_number varchar (70) NOT NULL,
    reader_address  varchar (255),
    PRIMARY KEY (reader_id)
)

CREATE TABLE admin(
    admin_id INT NOT NULL AUTO_INCREMENT,
    admin_firstname varchar (70) NOT NULL,
    admin_lastname varchar (70) NOT NULL,
    admin_email varchar (70) NOT NULL,
    admin_password  varchar (70) NOT NULL,
    admin_contact_number varchar (70) NOT NULL,
    admin_address  varchar (255),
    PRIMARY KEY (admin_id)
)

CREATE TABLE news(
    news_id INT NOT NULL AUTO_INCREMENT,
    news_header varchar(255) NOT NULL,
    news_body MEDIUMTEXT NOT NULL,
    upload_time datetime DEFAULT current_timestamp(),
    upload_date date DEFAULT NULL,
    news_img_1 varchar(255) NOT NULL,
    news_img_2 varchar(255) NOT NULL,
    admin_id INT,
    category_id INT, 
    PRIMARY KEY (news_id),
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id),
    FOREIGN KEY (category_id) REFERENCES category(category_id)
)

CREATE TABLE category(
    category_id INT NOT NULL AUTO_INCREMENT,
    category_name varchar(255) NOT NULL,
    upload_date date NOT NULL,
    admin_id INT,
    PRIMARY KEY (category_id),
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
)





 

