-- Create the database
DROP DATABASE IF EXISTS college;
CREATE DATABASE college;

-- Use the database
USE college;

-- Create the table for student details
CREATE TABLE student_details (
    uid INT PRIMARY KEY,          -- Unique ID for the student
    student_name VARCHAR(100) NOT NULL,
    ph_no VARCHAR(15),
    address TEXT,
    year INT,                     -- Year of enrollment
    age INT,
    gender CHAR(1)                -- 'm' for male, 'f' for female
);

-- Create the table for courses
CREATE TABLE course (
    course_code VARCHAR(10) PRIMARY KEY,   -- Unique course code
    course_name VARCHAR(100),              -- Course name
    fees DECIMAL(10, 2)                    -- Course fee
);

-- Create an enrollment table to manage course enrollments
CREATE TABLE enrollment (
    uid INT,                              -- Foreign key from student_details
    course_code VARCHAR(10),              -- Foreign key from course
    PRIMARY KEY (uid, course_code),       -- Composite primary key
    FOREIGN KEY (uid) REFERENCES student_details(uid),
    FOREIGN KEY (course_code) REFERENCES course(course_code)
);

-- Create a table for fees with uid as a foreign key
CREATE TABLE fees (
    uid INT,                             -- Foreign key from student_details
    course_code VARCHAR(10),             -- Reference to the course
    amount_paid DECIMAL(10, 2),
    amount_pending DECIMAL(10, 2),
    PRIMARY KEY (uid, course_code),      -- Composite primary key
    FOREIGN KEY (uid) REFERENCES student_details(uid),
    FOREIGN KEY (course_code) REFERENCES course(course_code)  -- Linking course_code from course table
);

-- Create the table for student grades
CREATE TABLE student_grades (
    uid INT,                             -- Foreign key from student_details
    course_code VARCHAR(10),             -- Course reference
    marks_subject1 INT,                  -- Marks for subject 1
    marks_subject2 INT,                  -- Marks for subject 2
    marks_subject3 INT,                  -- Marks for subject 3
    marks_subject4 INT,                  -- Marks for subject 4
    PRIMARY KEY (uid, course_code),      -- Composite primary key
    FOREIGN KEY (uid) REFERENCES student_details(uid),
    FOREIGN KEY (course_code) REFERENCES course(course_code)  -- Linking to course
);

