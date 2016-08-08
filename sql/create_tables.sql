CREATE TABLE Forum_user(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(100) NOT NULL,
  info varchar(400),
  created date,
  edited date
);

CREATE TABLE User_group(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(400) NOT NULL,
  created date,
  edited date
);

CREATE TABLE Membership(
  forum_user_id INTEGER REFERENCES Forum_user(id),
  user_group_id INTEGER REFERENCES User_group(id)
);

CREATE TABLE Topic_group(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(400) NOT NULL,
  created DATE,
  edited DATE
);

CREATE TABLE Thread(
  id SERIAL PRIMARY KEY,
  topic_group_id INTEGER REFERENCES Topic_group(id),
  title VARCHAR(50),
  created DATE,
  edited DATE
);

CREATE TABLE Post(
  user_id INTEGER REFERENCES Forum_user(id),
  thread_id INTEGER REFERENCES Thread(id),
  message TEXT,
  created DATE,
  edited DATE
);