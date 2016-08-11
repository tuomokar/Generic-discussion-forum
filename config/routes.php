<?php

// for testing purposes
$routes -> get('/testingtesting', function() {
    TestController::sandbox();
});

$routes -> get('/', function() {
    MainController::index();
});

// -------------- TOPIC GROUPS ------------------

$routes -> get('/topic-groups/new', function() {
    TopicGroupController::topicGroupNew();
});

$routes -> post('/topic-groups/new', function() {
    TopicGroupController::topicGroupSave();
});

$routes -> get('/topic-groups/:id', function($id) {
    TopicGroupController::topicGroupShow($id);
});

$routes -> get('/topic-groups/:id/edit', function($id) {
    TopicGroupController::topicGroupEdit($id);
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

// -------------- Groups ------------------
// temp address
$routes -> get('/user-groups/1', function() {
    UserGroupController::userGroupShow();
});

// temp address
$routes -> get('/user-groups/1/edit', function() {
    UserGroupController::userGroupEdit();
});

// temp address
$routes -> get('/user-groups/new', function() {
    UserGroupController::userGroupNew();
});

$routes -> get('/user-groups', function() {
    UserGroupController::userGroupList();
});