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

# Project description

The key function of the forum is to have discussion threads that logged in users can create and participate in by making new posts into them. Users can edit their user info and of course see their and any other user's info. Non logged in visitors can't do any of these, but they can read the threads in the discussion forum. To be able to login you must register first (or hack someone's password - they're not very well protected for now).

Admin users can remove and edit posts made by anyone. They can also delete threads completely and edit user info of any user. Besides that, they can also group users and topics. Admins can edit a user group's info, remove it, and add and remove users to and from them. User groups are accessible only to admins. Topic groups are accessible to anyone and logged in users can create new threads to them. Admin can edit a topic group's info and remove them as they see fit.

# Some reflection on the project afterwards

Overall, I'm pretty satisfied with how I succeeded with the project and the course. I stayed on schedule, did work pretty evenly throughout the course, got a fairly functional little application done and managed to make it look pretty nice too. I think the code is also very readable and good in general, although there's always some things to refactor. It's a bit of shame that I didn't get any code reviews (as the two people who were assigned to do it for me didn't bother with it) so I didn't get any in-depth feedback, but I think it's pretty clear still that overall the app is pretty well done.

I didn't have any previous experience with PHP, and I had heard the usual horror stories about it, but I must say, I'm positively surprised by the language. Actually, I really liked it. Of course, this isn't an enterprise level app with tens of thousands of lines of code or anything like that, but at least for a small application like this, the language and the frameworks used felt pretty nice and flexible.

SQL went pretty easily too. I didn't have almost any experience with it beforehand (I didn't really take the introductory course on databases, I only took an exam to pass it). That said, the relations in the database of my app are fairly simple and as such, obviously majority of the queries are also pretty simple. But still, I'm confident I could do more complex queries too.

I have no big ambitions about making traditional kind of discussion forums the big thing again, so it's extremely likely that I won't be continuing with developing the application, but if I were to do it, some of the things I'd do first are:
- No hard deletes at least for users. Just sort of infinitely banning them / closing the account would be better.
- Speaking of banning, ability to temporarily ban accounts would be good.
- Ability to close down a thread (i.e. users not being able to post in it after that) would be pretty good too.
- Giving tags to users. At the moment when looking at posts in a thread, below each post's creator it always says "Member", but there could be a tag instead. This could be pretty easily done with the user groups and their memberships for example - have one group membership be the primary one and show that group's name there. Or then it could just be a separate table in the database.
- User avatars. Pretty obvious.
- Pagination to threads and for posts of a given user at their user page.
- Users being able to set in which format the forum displays the time for them.
- Making edits a table of their own, at least for posts. That way you could easily see if it's an admin or the creator of the post doing editing, and users could give a reason for their edits.
- Password protection! At the moment the passwords are just plain text in the database, which is horrible. Proper password protection wasn't required by the course, and it's not like the site is for any actual use, but ugh, it's just one of those things that are generally speaking important enough that it feels the site is missing an important feature, even if it might actually not be that important in this specific case.
- Quoting posts when replying. It was in my original plans, but I decided to scrap it because.. well, I dunno. It wouldn't have been hard to parse at least one time quote (as opposed to a quote chain), but I just didn't feel like it and there was no problem with leaving it out, so I did. I didn't really look for it, but there are probably some libraries that make it easy too.
- Users being able to style their posts at least a little, such as bolding text and such.s
- Some small changes to make the site more mobile friendly. It's actually pretty usable already from the little testing that I did on mobile, but there are some things that could be better and some things that aren't really necessary for small screen.
