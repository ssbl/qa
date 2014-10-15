INSERT INTO category (name) VALUES ('Sports');
INSERT INTO category (name) VALUES ('Politics');
INSERT INTO category (name) VALUES ('Physics');
INSERT INTO category (name) VALUES ('Chemistry');
INSERT INTO category (name) VALUES ('Programming');
INSERT INTO category (name) VALUES ('Computer Science');

INSERT INTO questions (qid,name,qtext,userID) VALUES (1232, 'Computer Science','What is the scope of Computer Science?', 1234);
INSERT INTO questions (name,qtext,userID) VALUES ('Computer Science','What is RAID?', 1234);
INSERT INTO questions (name,qtext,userID) VALUES ('Computer Science','How do you use FTP?', 1234);

INSERT INTO questions (name,qtext,userID) VALUES ('Chemistry','What are the uses of sulphuric acid?', 1234);
INSERT INTO questions (name,qtext,userID) VALUES ('Chemistry','What are the uses of hydrochloric acid?', 1234);
INSERT INTO questions (name,qtext,userID) VALUES ('Chemistry','What is the composition of diamond?', 1234);

INSERT INTO answers (answer_id,answer_text,name,qtext,userID) VALUES (1232,'It has a vast scope.','Computer Science','What is the scope of Computer Science?', 1234);
INSERT INTO answers (answer_text,name,qtext,userID) VALUES ('Redundant array of Independent disks','Computer Science','What is RAID?', 1234);
INSERT INTO answers (answer_text,name,qtext,userID) VALUES ('explanation','Computer Science','How do you use FTP?', 1234);

INSERT INTO answers (answer_text,name,qtext,userID) VALUES ('uses','Chemistry','What are the uses of sulphuric acid?', 1234);
INSERT INTO answers (answer_text,name,qtext,userID) VALUES ('uses again','Chemistry','What are the uses of hydrochloric acid?', 1234);
INSERT INTO answers (answer_text,name,qtext,userID) VALUES ('composition','Chemistry','What is the composition of diamond?', 1234);

UPDATE answers
SET qid = 1232
WHERE answer_id = 1232;

UPDATE answers
SET qid = 1233
WHERE answer_id = 1233;

UPDATE answers
SET qid = 1234
WHERE answer_id = 1234;

UPDATE answers
SET qid = 1235
WHERE answer_id = 1235;

UPDATE answers
SET qid = 1236
WHERE answer_id = 1236;

UPDATE answers
SET qid = 1237
WHERE answer_id = 1237;
