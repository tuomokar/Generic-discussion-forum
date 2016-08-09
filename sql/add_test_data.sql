INSERT INTO Forum_user (username, password, info, created, edited) VALUES ('user1', 'user1', 'Man, 40-year-old, accountant', '2016-07-31', '2016-07-31');
INSERT INTO Forum_user (username, password, info, created, edited) VALUES ('user2', 'user2', 'Woman, 41 years old, IT worker', '2016-07-31', '2016-07-31');
INSERT INTO Forum_user (username, password, info, created, edited) VALUES ('user3', 'user3', 'Man, 39-year-old, drunk', '2016-07-31', '2016-07-31');

INSERT INTO User_group (name, info, created, edited) VALUES ('Truly generic', 'Users who have achieved the state of true genericity.', '2016-07-31', '2016-07-31');
INSERT INTO User_group (name, info, created, edited) VALUES ('Naughty users', 'Bad, bad users.', '2016-07-31', '2016-07-31');

INSERT INTO Membership (forum_user_id, user_group_id) VALUES ('1', '1');
INSERT INTO Membership (forum_user_id, user_group_id) VALUES ('2', '1');

INSERT INTO Topic_group (name, info, created, edited) VALUES ('Generic discussion', 'This is where the real magic of this forum lies!', '2016-07-31', '2016-07-31');
INSERT INTO Topic_group (name, info, created, edited) VALUES ('More specific discussion', 'For those rare times you might wanna talk about something a bit more specific! ', '2016-07-31', '2016-07-31');

INSERT INTO Thread (topic_group_id, title, created, edited) VALUES ('1', 'Generic people', '2016-07-31', '2016-07-31');
INSERT INTO Thread (topic_group_id, title, created, edited) VALUES ('1', 'Generic functions', '2016-07-31', '2016-07-31');
INSERT INTO Thread (topic_group_id, title, created, edited) VALUES ('1', 'Generic trademarks', '2016-07-31', '2016-07-31');

INSERT INTO Post (user_id, thread_id, message, created, edited) VALUES ('1', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin condimentum ex nibh, sed vulputate nulla lacinia et. Donec placerat fermentum sollicitudin. Nunc vitae leo urna. Etiam sed nulla in risus pretium hendrerit. Pellentesque feugiat dui in condimentum varius. Maecenas egestas elit at aliquam mattis. Nullam porttitor, neque sed egestas gravida, mi libero vehicula urna, id malesuada justo nisi id tellus. Sed ut interdum arcu. Proin laoreet molestie elementum. Vestibulum tristique, tortor eget luctus faucibus, erat risus varius erat, id viverra mauris justo vehicula risus.

Vivamus varius varius odio, non accumsan quam tincidunt cursus. Phasellus consectetur leo eu ligula sollicitudin, elementum accumsan quam molestie. Phasellus maximus mattis massa, vel convallis erat porta eget. Nunc congue lacus augue, at scelerisque tortor elementum vel. Nam posuere est sed ante dictum dapibus. Sed ut velit et nisi convallis luctus. Cras sodales augue eget nulla viverra blandit. Quisque et massa placerat, lobortis nisl vel, ultrices urna. Vivamus egestas dolor a tellus vestibulum, quis fermentum ipsum gravida. Morbi rhoncus ultrices elit fringilla convallis.

Morbi et augue ex. Donec eget nibh iaculis, varius lorem in, rutrum mauris. Duis feugiat tortor tortor, a pretium tellus convallis tempor. Maecenas a odio quis lorem volutpat imperdiet eget eget metus. Vivamus lobortis, metus quis dictum posuere, risus velit ultricies lorem, quis gravida sem neque tristique massa. Sed lacus metus, fermentum nec pulvinar et, fringilla et justo. Cras sit amet venenatis dui. Curabitur turpis ligula, porta in commodo nec, sollicitudin eget felis. Sed condimentum dui vel magna congue, a commodo nunc molestie. Nullam dui quam, suscipit at tristique nec, mollis sit amet tellus.', '2016-08-01', '2016-08-01');
INSERT INTO Post (user_id, thread_id, message, created, edited) VALUES ('2', '1', 'Generic second post here.', '2016-08-01', '2016-08-01');

INSERT INTO Post (user_id, thread_id, message, created, edited) VALUES ('2', '2', 'Generic functions are so cool aren''t they?', '2016-07-31', '2016-07-31');
INSERT INTO Post (user_id, thread_id, message, created, edited) VALUES ('3', '3', 'Trademarks suck!', '2016-07-31', '2016-07-31');