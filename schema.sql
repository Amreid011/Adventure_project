CREATE TABLE user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(40) NOT NULL,
    dob DATE NOT NULL,
    info TEXT,
    cash INT DEFAULT 0,
    type ENUM('admin','host','traveller') NOT NULL,
    image_path VARCHAR(150) 
);

-- real_estate = posts 
CREATE TABLE real_estate(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    rent INT NOT NULL,
    location VARCHAR(120) NOT NULL,
    description TEXT,
    image_path VARCHAR(120) NOT NULL,
    owner_id INT,
    type ENUM('hotel','volunteering','competition') DEFAULT 'hotel',
    FOREIGN KEY(owner_id) REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE review(
    id INT PRIMARY KEY AUTO_INCREMENT,
    rate INT NOT NULL,
    feedback TEXT,
    user_id INT NOT NULL,
    estate_id INT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(estate_id) REFERENCES real_estate(id) ON DELETE CASCADE
);
CREATE TABLE favorite(
    user_id INT NOT NULL,
    estate_id INT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(estate_id) REFERENCES real_estate(id) ON DELETE CASCADE,
    PRIMARY KEY(user_id,estate_id)
);

CREATE TABLE booking(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    estate_id INT NOT NULL,
    status ENUM('Pending','Accepted','Canceled') DEFAULT 'Pending',
    enter_date DATE NOT NULL,
    exit_date DATE NOT NULL,
    createdAt DATETIME DEFAULT NOW(),
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(estate_id) REFERENCES real_estate(id) ON DELETE CASCADE
);

CREATE TABLE transaction(
    id INT PRIMARY KEY AUTO_INCREMENT,
    amount INT NOT NULL,
    user_id INT NOT NULL,
    booking_id INT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(booking_id) REFERENCES booking(id) ON DELETE CASCADE
);

CREATE TABLE chat(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_1 INT NOT NULL,
    user_2 INT NOT NULL,
    FOREIGN KEY(user_1) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(user_2) REFERENCES user(id) ON DELETE CASCADE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY(user_1,user_2)
);

CREATE TABLE message(
    id INT PRIMARY KEY AUTO_INCREMENT,
    chat_id INT,
    sender_id INT,
    msg TEXT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(sender_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY(chat_id) REFERENCES chat(id) ON DELETE CASCADE
);