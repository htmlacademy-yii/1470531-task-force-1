CREATE DATABASE taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

# USE taskforce;

CREATE TABLE city
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title      TEXT   NOT NULL,
    lat        DOUBLE NOT NULL,
    `long`     DOUBLE NOT NULL
);

CREATE TABLE category
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title      TEXT NOT NULL
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
    last_login TIMESTAMP,
    name       TEXT         NOT NULL,
    email      VARCHAR(250) NOT NULL UNIQUE,
    password   TEXT         NOT NULL,
    birthday   TIMESTAMP,
    about      TEXT,
    phone      VARCHAR(15),
    skype      VARCHAR(250),
    telegram   VARCHAR(250),
    avatar     TEXT,
    city_id    BIGINT UNSIGNED,
    FOREIGN KEY (city_id) REFERENCES city (id)
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
    id             BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_on     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title          TEXT         NOT NULL,
    description    TEXT         NOT NULL,
    budget         INT UNSIGNED NOT NULL,
    execution_date TIMESTAMP    NOT NULL,
    category_id    BIGINT UNSIGNED,
    city_id        BIGINT UNSIGNED,
    owner_id       BIGINT UNSIGNED,
    FOREIGN KEY (category_id) REFERENCES category (id)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (city_id) REFERENCES city (id)
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
