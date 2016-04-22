/*This is the .sql file to create the users table wihtin our database for project 2*/

DROP TABLE IF EXISTS users;

CREATE TABLE users(
       /*ALL the fields for the table:*/
       person_id INTEGER PRIMARY KEY ASC,
       first_name varchar(10),
       middle_name varchar(15),
       last_name varchar(15),
       phone_number int(15),
       email varchar(20),
       user_name varchar(20),
       password varchar(45),
       prior_petsD varchar(3),
       prior_petsc varchar(3),
       prior_petsT varchar(3),
       foster_pet varchar(3),
       pet_needing_home varchar(3),
       pnh_response varchar(145),
       other_pet_needing_home varchar(3)
);
