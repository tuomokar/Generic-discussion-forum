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
$routes -> get('/users/', function() {
    UserController::userList();
});

$routes -> get('/users/new', function() {
    UserController::userNew();
});

$routes -> post('/users/new', function() {
    UserController::userSave();
});

$routes -> get('/users/:id', function($id) {
    UserController::userShow($id);
});

$routes -> get('/users/:id/edit', function($id) {
    UserController::userEdit($id);
});

$routes -> post('/users/:id/edit', function($id) {
    UserController::userUpdate($id);
});

$routes -> post('/users/:id/destroy', function($id) {
    UserController::userDestroy($id);
});

// -------------- Posts ------------------
$routes -> get('/posts/:id', function($id) {
    PostController::postShow($id);
});

$routes -> get('/posts/:id/edit', function($id) {
    PostController::postEdit($id);
});

$routes -> post('/posts/:id/edit', function($id) {
    PostController::postUpdate($id);
});

$routes -> get('/threads/:threadId/posts/new', function($threadId) {
    PostController::postNew($threadId);
});

$routes -> post('/threads/:threadId/posts/new', function($threadId) {
    PostController::postSave($threadId);
});

$routes -> post('posts/:id/destroy', function($id) {
   PostController::postDestroy($id);
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