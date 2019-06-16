CREATE TABLE actor (
    act_id varchar(50) NOT NULL,
    act_fname varchar(20),
    act_lname varchar(20),
    act_gender char(1),
    PRIMARY KEY (act_id)
);

CREATE TABLE director (
    dir_id varchar(50) NOT NULL,
    dir_fname varchar(20),
    dir_lname varchar(20),
    PRIMARY KEY (dir_id)
);

CREATE TABLE movie (
    mov_id varchar(50) NOT NULL,
    mov_title varchar(50),
    mov_year integer,
    mov_time integer,
    mov_lang varchar(15),
    mov_overview varchar(200),
    PRIMARY KEY (mov_id)
);

CREATE TABLE genres (
    gen_id varchar(50),
    gen_title varchar(30),
    PRIMARY KEY (gen_id)
);

CREATE TABLE movie_cast (
    act_id varchar(50) NOT NULL,
    mov_id varchar(50) NOT NULL,
    FOREIGN KEY(mov_id) REFERENCES movie(mov_id) ON DELETE CASCADE,
    FOREIGN KEY(act_id) REFERENCES actor(act_id) ON DELETE CASCADE
);

CREATE TABLE movie_direction (
    dir_id varchar(50) NOT NULL,
    mov_id varchar(50) NOT NULL,
    FOREIGN KEY(dir_id) REFERENCES director(dir_id) ON DELETE CASCADE,
    FOREIGN KEY(mov_id) REFERENCES movie(mov_id) ON DELETE CASCADE
);

CREATE TABLE movie_genres (
    mov_id varchar(50) NOT NULL,
    gen_id varchar(50) NOT NULL,
    FOREIGN KEY(mov_id) REFERENCES movie(mov_id) ON DELETE CASCADE,
    FOREIGN KEY(gen_id) REFERENCES genres(gen_id) ON DELETE CASCADE
);
CREATE TRIGGER `check_date`
    BEFORE INSERT
    ON `movie`
    FOR EACH ROW IF NEW.mov_year < 1900 THEN SET NEW.mov_year = 1900; END IF;

CREATE FUNCTION max_movie() RETURNS INT
    RETURN (SELECT MAX(mov_year)
            FROM movie);

