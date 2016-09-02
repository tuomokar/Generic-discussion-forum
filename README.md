# Database application - a discussion forum

This repository is for the course Database application, done in summer 2016 at Helsinki University.

The subject is a discussion forum.

Links:

* [The application](http://tuomokar.users.cs.helsinki.fi/tsoha/)
* [Documentation](https://github.com/tuomokar/Tsoha-Bootstrap/tree/master/doc/documentation.pdf)

Admin account access:
- username: admin
- password: admin1pass#

Basic user account access:
- username: user1
- password user1pass#

Everything should be more or less functional now. One thing that is missing is proper password security (hashing and salting) - that's not required in the course at all, but if I bother I'll do it anyway.

# Project description

The key function of the forum is to have discussion threads that logged in users can create and participate in by making new posts into them. Users can edit their user info and of course see their and any other user's info. Non logged in visitors can't do any of these, but they can read the threads in the discussion forum. To be able to login you must register first (or hack someone's password - they're not very well protected for now).

Admin users can remove and edit posts made by anyone. They can also delete threads completely and edit user info of any user. Besides that, they can also group users and topics. Admins can edit a user group's info, remove it, and add and remove users to and from them. User groups are accessible only to admins. Topic groups are accessible to anyone and logged in users can create new threads to them. Admin can edit a topic group's info and remove them as they see fit.
