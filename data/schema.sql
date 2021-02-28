CREATE DATABASE taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

# USE taskforce;

CREATE TABLE city
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title      TEXT   NOT NULL,
    latitude   DOUBLE NOT NULL,
    longitude  DOUBLE NOT NULL
);

CREATE TABLE category
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title      TEXT NOT NULL,
    icon       TEXT NOT NULL
);

CREATE TABLE specialization
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title      TEXT NOT NULL
);

CREATE TABLE user
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name       TEXT         NOT NULL,
    email      VARCHAR(250) NOT NULL UNIQUE,
    password   TEXT         NOT NULL
);

CREATE TABLE profile
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    birthday   DATE,
    about      TEXT,
    phone      VARCHAR(15),
    skype      VARCHAR(250),
    telegram   VARCHAR(250),
    avatar     TEXT,
    user_id    BIGINT UNSIGNED,
    address    TEXT,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE user_specialization
(
    id                BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id           BIGINT UNSIGNED,
    specialization_id BIGINT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (specialization_id) REFERENCES specialization (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE photo_of_work
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    path       TEXT,
    user_id    BIGINT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE task
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title       TEXT         NOT NULL,
    description TEXT         NOT NULL,
    budget      INT UNSIGNED NOT NULL,
    expire      TIMESTAMP    NOT NULL,
    category_id BIGINT UNSIGNED,
    latitude    DOUBLE       NOT NULL,
    longitude   DOUBLE       NOT NULL,
    address     TEXT,
    owner_id    BIGINT UNSIGNED,
    FOREIGN KEY (category_id) REFERENCES category (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (owner_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE task_file
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    path       TEXT NOT NULL,
    task_id    BIGINT UNSIGNED,
    FOREIGN KEY (task_id) REFERENCES task (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE response
(
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    task_id     BIGINT UNSIGNED,
    executor_id BIGINT UNSIGNED,
    FOREIGN KEY (task_id) REFERENCES task (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (executor_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE review
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rate       TINYINT UNSIGNED NOT NULL,
    text       TEXT,
    task_id    BIGINT UNSIGNED,
    user_id    BIGINT UNSIGNED,
    FOREIGN KEY (task_id) REFERENCES task (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);

CREATE TABLE notification
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    text       TEXT,
    type       TEXT,
    task_id    BIGINT UNSIGNED,
    user_id    BIGINT UNSIGNED,
    FOREIGN KEY (task_id) REFERENCES task (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);
