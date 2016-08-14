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

$routes -> post('/topic-groups/:id/edit', function($id) {
   TopicGroupController::topicGroupUpdate($id);
});

$routes -> post('/topic-groups/:id/destroy', function($id) {
    TopicGroupController::topicGroupDestroy($id);
});

// -------------- THREADS ------------------
$routes -> get('/threads/new', function() {
    ThreadController::threadNew();
});

$routes -> post('/threads/new', function() {
    ThreadController::threadSave();
});

$routes -> get('/threads/:id', function($id) {
    ThreadController::threadShow($id);
});

$routes -> get('/threads/:id/edit', function($id) {
    ThreadController::threadEdit($id);
});

$routes -> post('/threads/:id/edit', function($id) {
   ThreadController::threadUpdate($id);
});

$routes -> post('/threads/:id/destroy', function($id) {
    ThreadController::threadDestroy($id);
});

// -------------- Users ------------------
// temp address
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
$routes -> get('/posts/:id', function($id) {
    PostController::postShow($id);
});

$routes -> get('/posts/:id/edit', function($id) {
    PostController::postEdit($id);
});

$routes -> get('/threads/:id/posts/new', function($threadId) {
    PostController::postNew($threadId);
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