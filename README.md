# Database application - a discussion forum

This repository is for the course Database application, done in summer 2016 at Helsinki University.

The subject is a discussion forum.

Links:

* [The application](http://tuomokar.users.cs.helsinki.fi/tsoha/)
* [Documentation](https://github.com/tuomokar/Tsoha-Bootstrap/tree/master/doc/documentation.pdf)

Note that for now only the pages directly related to topic groups, threads and posts are fully functional (as in not finished though - for example validations are missing and things are still up to change) - you can edit and remove them and see them listed and checkout any of their page.

To see other pages you can navigate through the links at the pages or parts of the pages that are or have still mockup data - for example the 'Users' link at the top takes you to a page listing users as mockup data (instead of fetching the data from the database) and you can click on the first user's username to see mockup data for the user page.

# Project description

The key function of the forum is to have discussion threads that can contain multiple posts. Any non logged in user (from now on referring to them as 'visitors' any documentation) can read any of these threads and posts and also register and log in. Logged in users can also create new threads and posts. Users can edit their own posts and see and edit their user info. Posts can be replies to another post. Users can also see each other's user info.

Admin users can remove and edit posts made by anyone. They can also delete threads completely and edit user info of any user. Besides that, they can also group users and topics. Both of the group styles can be edited and removed. When editing a topic group, admin can only edit its info, but when editing a user group, admin can also add to and remove users from it.




