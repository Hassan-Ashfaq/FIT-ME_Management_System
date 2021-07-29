drop table member_plan;
drop table exercises;
drop table body_muscle;
drop table equipment;
drop table logs;
drop table gym_member;
drop table gym_plan;
drop table gym_diet;

drop sequence gym_member_sequence;
drop sequence gym_diet_sequence;
drop sequence logs_sequence;

create table gym_member(
  member_id NUMBER,
  first_name VARCHAR2(25),
  last_name VARCHAR2(25),
  age NUMBER,
  bmi NUMBER,
  weight NUMBER,
  gender VARCHAR2(10),
  member_password VARCHAR2(25),
  CONSTRAINT member_id_pk PRIMARY KEY(member_id)
);

CREATE SEQUENCE gym_member_sequence
START WITH 1
INCREMENT BY 1;

CREATE OR REPLACE TRIGGER gym_member_trigger
BEFORE INSERT
ON gym_member
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
SELECT gym_member_sequence.nextval INTO :NEW.member_id FROM dual;
END;
/

CREATE TABLE gym_diet(
  dietID NUMBER,
  calories NUMBER,
  protein NUMBER,
  carbohydrates NUMBER,
  fat NUMBER,
  gym_diet_name VARCHAR2(25),
  CONSTRAINT diet_pk PRIMARY KEY(dietID)
);

CREATE SEQUENCE gym_diet_sequence
START WITH 1
INCREMENT BY 1;

CREATE OR REPLACE TRIGGER gym_diet_trigger
BEFORE INSERT
ON gym_diet
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
SELECT gym_diet_sequence.nextval INTO :NEW.dietID FROM dual;
END;
/

CREATE TABLE body_muscle(
  body_muscle_name VARCHAR2(25) PRIMARY KEY
);

CREATE TABLE equipment(
  equipment_name VARCHAR2(25) PRIMARY KEY
);

CREATE TABLE gym_plan(
  planName VARCHAR2(25),
  planDiet NUMBER,
  description VARCHAR2(25),
  CONSTRAINT planName_pk PRIMARY KEY(planName),
  CONSTRAINT  planDiet_fk FOREIGN KEY(planDiet) REFERENCES gym_diet(dietID)
);

CREATE TABLE member_plan(
  member_plan_id NUMBER,
  member_plan_name VARCHAR2(25),
  targetHours NUMBER,
  targetWeight NUMBER,
  targetProtein NUMBER,
  targetFat NUMBER,
  targetCarbohydrates NUMBER,
  targetCalories NUMBER,
  targetBMI NUMBER,
  CONSTRAINT member_plan_id_fk FOREIGN KEY(member_plan_id) REFERENCES gym_member(member_id),
  CONSTRAINT member_plan_name_fk FOREIGN KEY(member_plan_name) REFERENCES gym_plan(planName),
  CONSTRAINT member_plan_pk PRIMARY KEY(member_plan_id, member_plan_name)
);

CREATE TABLE logs(
  logID NUMBER,
  log_member_id NUMBER,
  log_planName VARCHAR2(25),
  hoursDone NUMBER,
  currentWeight NUMBER,
  proteinIntake NUMBER,
  fatIntake NUMBER,
  carbsIntake NUMBER,
  caloriesIntake NUMBER,
  currentBMI NUMBER,
  CONSTRAINT log_member_id_fk FOREIGN KEY(log_member_id) REFERENCES gym_member(member_id),
  CONSTRAINT log_planName_fk FOREIGN KEY(log_planName) REFERENCES gym_plan(planName),
  CONSTRAINT logID_pk PRIMARY KEY(logID)
);

CREATE SEQUENCE logs_sequence
START WITH 1
INCREMENT BY 1;

CREATE OR REPLACE TRIGGER logs_trigger
BEFORE INSERT
ON logs
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
SELECT logs_sequence.nextval INTO :NEW.logID FROM dual;
END;
/

CREATE TABLE exercises(
  exercises_planName VARCHAR2(25),
  exercises_body_muscle_name VARCHAR2(25),
  exercises_equipment_name VARCHAR2(25),
  excercise_sets NUMBER,
  excercise_reps NUMBER,
  CONSTRAINT exercises_planName_fk FOREIGN KEY(exercises_planName) REFERENCES gym_plan(planName),
  CONSTRAINT exercises_body_muscle_fk FOREIGN KEY(exercises_body_muscle_name) REFERENCES body_muscle(body_muscle_name),
  CONSTRAINT exercises_equipment_fk FOREIGN KEY(exercises_equipment_name) REFERENCES equipment(equipment_name),
  CONSTRAINT workout_pk PRIMARY KEY(exercises_planName, exercises_body_muscle_name, exercises_equipment_name)
);

INSERT INTO body_muscle VALUES ('Arms');
INSERT INTO body_muscle VALUES ('Chest');
INSERT INTO body_muscle VALUES ('Legs');
INSERT INTO body_muscle VALUES ('Abs');
INSERT INTO body_muscle VALUES ('Wings');
INSERT INTO body_muscle VALUES ('Tricep');

INSERT INTO equipment VALUES ('Weight Machines');
INSERT INTO equipment VALUES ('Treadmill');
INSERT INTO equipment VALUES ('Cycle');
INSERT INTO equipment VALUES ('Free Weights');
INSERT INTO equipment VALUES ('Rowing Machines');
INSERT INTO equipment VALUES ('Squat Rack');

INSERT INTO gym_diet(dietID, calories, protein, carbohydrates, fat, gym_diet_name) VALUES (1, 2500, 100, 100, 10, 'Weight Loss');
INSERT INTO gym_diet(dietID,calories, protein, carbohydrates, fat, gym_diet_name) VALUES (2, 1000, 50, 200, 30, 'Body Building');
INSERT INTO gym_diet(dietID,calories, protein, carbohydrates, fat, gym_diet_name) VALUES (3, 500, 80, 250, 20, 'Boxing');

INSERT INTO gym_plan(planName, planDiet, description)
  SELECT 'Weight Loss', dietID, 'Burn fat quickly.' FROM gym_diet WHERE gym_diet_name = 'Weight Loss';
INSERT INTO gym_plan(planName, planDiet, description) 
  SELECT 'Body Building', dietID, 'Build strong muscles.' FROM gym_diet WHERE gym_diet_name = 'Body Building';
INSERT INTO gym_plan(planName, planDiet, description) 
  SELECT 'Boxing', dietID, 'Train for boxing.' FROM gym_diet WHERE gym_diet_name = 'Boxing';

INSERT INTO exercises VALUES ('Weight Loss', 'Arms', 'Squat Rack', 8, 12);
INSERT INTO exercises VALUES ('Weight Loss', 'Chest', 'Free Weights', 7, 14);
INSERT INTO exercises VALUES ('Weight Loss', 'Legs', 'Rowing Machines', 6, 17);
INSERT INTO exercises VALUES ('Body Building', 'Chest', 'Free Weights', 5, 11);
INSERT INTO exercises VALUES ('Body Building', 'Legs', 'Free Weights', 4, 8);
INSERT INTO exercises VALUES ('Body Building', 'Abs', 'Free Weights', 3, 4);
INSERT INTO exercises VALUES ('Boxing', 'Wings', 'Squat Rack', 2, 2);
INSERT INTO exercises VALUES ('Boxing', 'Tricep', 'Cycle', 1, 20);

INSERT INTO gym_member VALUES (1, 'Saif', 'Sadiq', 20, 80, 81, 'Male', '111aaa');

INSERT INTO member_plan VALUES (1, 'Boxing', 60, 61, 62, 63, 64, 65, 66);

INSERT INTO logs VALUES (1, 1, 'Boxing', 2, 79, 78, 77, 76, 75, 74);
INSERT INTO logs VALUES (2, 1, 'Boxing', 3, 70, 71, 72, 73, 74, 75);

commit;