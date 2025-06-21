-- food_roulette.sql is an SQL script used to create tables for users and challenges and to populate the challenges table

-- this table is used to store user information including their ID, username, password and challenge information
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL DEFAULT "",
    completed_challenges INT DEFAULT 0,
    total_challenges INT DEFAULT 0
);

-- this table is used to store challenges of all difficulty levels
CREATE TABLE challenges(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  difficulty_level ENUM('Easy', 'Medium', 'Hard') NOT NULL
);

-- inserting a few cooking challenges of various difficulty levels
INSERT INTO challenges (name, difficulty_level) VALUES
('Use leftovers to create a new dish', 'Easy'),
('Boil eggs without using a timer', 'Easy'),
('Make a smoothie using a fruit and vegetable in your fridge ', 'Easy'),
('Bake a mug cake', 'Easy'),
('Pick the first 3 items you see in your fridge and use them in a dish', 'Medium'),
('Cook an entire dish using only 1 pot', 'Medium'),
('Make edible art on pancakes', 'Medium'),
('Make pasta from scratch', 'Hard'),
('Bake cookies without using measuring cups', 'Hard'),
('Use one star ingredient in 3 ways', 'Hard');