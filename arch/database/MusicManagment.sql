CREATE DATABASE if NOT EXISTS MusicManagement ;
USE MusicManagement ;

CREATE Table if NOT exists Artists (
    id INT auto_increment PRIMARY KEY,
    ArtistName VARCHAR(50) not NULL,
    dateOfCreation TIMESTAMP DEFAULT Current_timestamp,
    ProfilePicture VARCHAR(255) 
);

CREATE Table if NOT exists Genre (
    id int auto_increment PRIMARY KEY,
    genreName VARCHAR(50) not null
);

CREATE Table if NOT exists Songs (
    id INT auto_increment PRIMARY KEY,
    SongTitle VARCHAR(50) not NULL,
    dateOfCreation TIMESTAMP DEFAULT Current_timestamp,
    ProfilePicture VARCHAR(255) not Null,
    songFilePath VARCHAR(255) not Null,
    status Enum('Draft','published') DEFAULT 'Draft',
    dateOfPublication dateTime DEFAULT Null,
    artist_id int ,
    genre_id int,
    Foreign Key (artist_id) REFERENCES Artists(id),
    Foreign Key (genre_id) REFERENCES Genre(id)
);


