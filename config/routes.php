<?php

$routes -> get('/', function() {
    MainController::index();
});

// -------------- TOPIC GROUPS ------------------
// temp address
$routes -> get('/topic-groups/1', function() {
    TopicGroupController::topicGroupShow();
});

// temp address
$routes -> get('/topic-groups/1/edit', function() {
    TopicGroupController::topicGroupEdit();
});

$routes -> get('/topic-groups/new', function() {
    TopicGroupController::topicGroupNew();
});

// -------------- THREADS ------------------
// temp address
$routes -> get('/threads/1', function() {
    ThreadController::threadShow();
});

// temp address
$routes -> get('/threads/1/edit', function() {
    ThreadController::threadEdit();
});

$routes -> get('/threads/new', function() {
    ThreadController::threadNew();
});

// -------------- Users ------------------
$routes -> get('/users/1', function() {
    UserController::userShow();
});

// temp address
$routes -> get('/users/1/edit', function() {
    UserController::userEdit();
});

$routes -> get('/users/new', function() {
    UserController::userNew();
});

$routes -> get('/users/', function() {
    UserController::userList();
});

// -------------- Posts ------------------
// temp address
$routes -> get('/posts/1', function() {
    PostController::postShow();
});

// temp address
$routes -> get('/posts/1/edit', function() {
    PostController::postEdit();
});

// temp address
$routes -> get('/threads/1/posts/new', function() {
    PostController::postNew();
});