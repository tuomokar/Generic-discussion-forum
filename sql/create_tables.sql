-- noinspection SqlNoDataSourceInspectionForFile
CREATE TABLE Forum_user(
  id SERIAL PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  info VARCHAR(400),
  created DATE NOT NULL,
  edited DATE
);

CREATE TABLE User_group(
  id SERIAL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  info VARCHAR(400) NOT NULL,
  created DATE NOT NULL,
  edited DATE
);

CREATE TABLE Membership(
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES Forum_user(id) ON DELETE CASCADE,
  user_group_id INTEGER REFERENCES User_group(id) ON DELETE CASCADE,
  created DATE NOT NULL
);

CREATE TABLE Topic_group(
  id SERIAL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  info VARCHAR(400) NOT NULL,
  created DATE NOT NULL,
  edited DATE
);

CREATE TABLE Thread(
  id SERIAL PRIMARY KEY,
  topic_group_id INTEGER REFERENCES Topic_group(id) ON DELETE CASCADE,
  title VARCHAR(50),
  created DATE NOT NULL,
  edited DATE
);

CREATE TABLE Post(
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES Forum_user(id) ON DELETE CASCADE,
  thread_id INTEGER REFERENCES Thread(id) ON DELETE CASCADE,
  message TEXT,
  created TIMESTAMP NOT NULL,
  edited TIMESTAMP
);