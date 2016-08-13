CREATE TABLE Forum_user(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL UNIQUE,
  password varchar(100) NOT NULL,
  info varchar(400),
  created date,
  edited date DEFAULT current_date
);

CREATE TABLE User_group(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(400) NOT NULL,
  created date,
  edited date DEFAULT current_date
);

CREATE TABLE Membership(
  id SERIAL PRIMARY KEY,
  forum_user_id INTEGER REFERENCES Forum_user(id) ON DELETE CASCADE,
  user_group_id INTEGER REFERENCES User_group(id) ON DELETE CASCADE,
  created DATE DEFAULT current_date
);

CREATE TABLE Topic_group(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(400) NOT NULL,
  created DATE,
  edited DATE DEFAULT current_date
);

CREATE TABLE Thread(
  id SERIAL PRIMARY KEY,
  topic_group_id INTEGER REFERENCES Topic_group(id) ON DELETE CASCADE,
  title VARCHAR(50),
  created DATE,
  edited DATE DEFAULT current_date
);

CREATE TABLE Post(
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES Forum_user(id),
  thread_id INTEGER REFERENCES Thread(id)  ON DELETE CASCADE,
  message TEXT,
  created TIMESTAMP,
  edited TIMESTAMP DEFAULT current_date
);