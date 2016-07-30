# Introduction

This app is for a discussion forum database application. The key function of the app is to have users being able to create and read discussion threads and make posts in them for others to read.

The app is written in PHP using PostgreSQL as the database. The application runs at the users.cs.helsinki.fi server of the Department of Computer science of University of Helsinki.

# Use cases

Visitor is any user who hasn't logged in (and potentially hasn't registered).

Logged in users are basic users of the site.

Admin users are administrators with full rights to everything. They are also logged in users obviously.

![Use cases](./use_case_diagram.png)
_Done with [creately](http://creately.com/)_

#### Use case descriptions:

###### Visitor:
* Read discussion threads
  * Visitors can freely read any threads on the forum
* Other functions:
  * Registering 
  * Logging in

###### Logged in user:
* Read discussion threads
* Create thread
  * Users can post new threads that anyone can read
  * Thread must contain a post (that will be the first one in the thread)
  * Thread must contain a title
* Create post
  * Belongs to a thread
  * Can be a reply to another post within the thread
* Edit post
  * User can freely edit any post of their own
* Other functions:
  * Seeing user info (user's own and other's)
  * Editing user's own info

###### Admin:
* Edit posts
  * Admins can edit posts made by anyone
* Handle groups
  * Admins can create groups to which users can be put
  * Group info can be edited, and users can be removed from groups
* Other functions:
  * Edit any post
  * Edit any users' info
  * Remove any post
  * Remove any thread
