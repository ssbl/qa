INSERT INTO category (name) VALUES ('Sports');
INSERT INTO category (name) VALUES ('Politics');
INSERT INTO category (name) VALUES ('Physics');
INSERT INTO category (name) VALUES ('Chemistry');
INSERT INTO category (name) VALUES ('Programming');
INSERT INTO category (name) VALUES ('Computer Science');
INSERT INTO category (name) VALUES ('Miscellaneous');

INSERT INTO user (UserId,Password,Username) VALUES (1234, 'xyzzy', 'root');

INSERT INTO questions (qid,name,qtext,userID) VALUES (1232, 'Computer Science','What is the scope of Computer Science?', 1234);
INSERT INTO questions (qid,name,qtext,userID) VALUES (1233, 'Computer Science','What is RAID?', 1234);
INSERT INTO questions (qid,name,qtext,userID) VALUES (1234,'Computer Science','How do you use FTP?', 1234);

INSERT INTO questions (qid,name,qtext,userID) VALUES (1235,'Chemistry','What are the uses of sulphuric acid?', 1234);
INSERT INTO questions (qid,name,qtext,userID) VALUES (1236,'Chemistry','What are the uses of hydrochloric acid?', 1234);
INSERT INTO questions (qid,name,qtext,userID) VALUES (1237,'Chemistry','What is the composition of diamond?', 1234);

INSERT INTO answers (answer_id,answer_text,name,userID,qid) VALUES (0001,'It has a vast scope.','Computer Science', 1234, 1232);
INSERT INTO answers (answer_id,answer_text,name,userID,qid) VALUES (0002,'Redundant array of Independent disks','Computer Science', 1234, 1233);
INSERT INTO answers (answer_id, answer_text,name,userID,qid) VALUES (0003,'explanation','Computer Science', 1234, 1234);
INSERT INTO answers (answer_id, answer_text,name,userID,qid) VALUES (0004,'uses','Chemistry', 1234, 1235);
INSERT INTO answers (answer_id, answer_text,name,userID,qid) VALUES (0005,'uses again','Chemistry', 1234, 1236);
INSERT INTO answers (answer_id, answer_text,name,userID,qid) VALUES (0006,'composition','Chemistry', 1234, 1237);
