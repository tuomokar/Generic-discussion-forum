# Introduction

This app is for a discussion forum, written with PHP using PostgreSQL as the database. The application runs at the users.cs.helsinki.fi server of the Department of Computer science of University of Helsinki.

People can create new posts and read existing ones. Posts can be replies to another post.

Posts can be searched by the poster's name or by the subject or age of the post. Readers can also follow the reply chain.
By default only posts young enough are shown, along with information on whether or not the reader or other people of the community have read it. This information is viewable by any reader. Readers always identify themselves.

The administrator of the system has their own user interface through which they can administrate the user information of the users and what groups they belong to. They can also clean up the database and define topics the posts can be grouped by.

# Use cases

![Use cases](/use_case_diagram.png)
_Done with [creatly](http://creately.com/)_
