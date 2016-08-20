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
    TopicGroupController::createNew();
});

$routes -> post('/topic-groups/new', function() {
    TopicGroupController::save();
});

$routes -> get('/topic-groups/:id', function($id) {
    TopicGroupController::show($id);
});

$routes -> get('/topic-groups/:id/edit', function($id) {
    TopicGroupController::edit($id);
});

$routes -> post('/topic-groups/:id/edit', function($id) {
   TopicGroupController::update($id);
});

$routes -> post('/topic-groups/:id/destroy', function($id) {
    TopicGroupController::destroy($id);
});

// -------------- THREADS ------------------
$routes -> get('/threads/new', function() {
    ThreadController::createNew();
});

$routes -> post('/threads/new', function() {
    ThreadController::save();
});

$routes -> get('/threads/:id', function($id) {
    ThreadController::show($id);
});

$routes -> get('/threads/:id/edit', function($id) {
    ThreadController::edit($id);
});

$routes -> post('/threads/:id/edit', function($id) {
   ThreadController::update($id);
});

$routes -> post('/threads/:id/destroy', function($id) {
    ThreadController::destroy($id);
});

// -------------- Users ------------------
$routes -> get('/users/', function() {
    UserController::listAll();
});

$routes -> get('/users/new', function() {
    UserController::createNew();
});

$routes -> post('/users/new', function() {
    UserController::save();
});

$routes -> get('/users/:id', function($id) {
    UserController::show($id);
});

$routes -> get('/users/:id/edit', function($id) {
    UserController::edit($id);
});

$routes -> post('/users/:id/edit', function($id) {
    UserController::update($id);
});

$routes -> post('/users/:id/destroy', function($id) {
    UserController::destroy($id);
});

// -------------- Posts ------------------
$routes -> get('/posts/:id', function($id) {
    PostController::show($id);
});

$routes -> get('/posts/:id/edit', function($id) {
    PostController::edit($id);
});

$routes -> post('/posts/:id/edit', function($id) {
    PostController::update($id);
});

$routes -> get('/threads/:threadId/posts/new', function($threadId) {
    PostController::createNew($threadId);
});

$routes -> post('/threads/:threadId/posts/new', function($threadId) {
    PostController::save($threadId);
});

$routes -> post('posts/:id/destroy', function($id) {
   PostController::destroy($id);
});

// -------------- User groups ------------------

$routes -> get('/user-groups/new', function() {
    UserGroupController::createNew();
});

$routes -> post('/user-groups/new', function() {
    UserGroupController::userGroupSave();
});

$routes -> get('/user-groups/:id', function($id) {
    UserGroupController::show($id);
});

$routes -> get('/user-groups/:id/edit', function($id) {
    UserGroupController::edit($id);
});

$routes -> post('/user-groups/:id/edit', function($id) {
    UserGroupController::update($id);
});

$routes -> get('/user-groups', function() {
    UserGroupController::listAll();
});

$routes -> post('/user-groups/:id/destroy', function($id) {
    UserGroupController::destroy($id);
});

// -------------- Memberships ------------------
$routes -> post('/memberships/new', function() {
    MembershipController::save();
});

$routes -> post('/memberships/:id/destroy', function($id) {
    MembershipController::destroy($id);
});

// -------------- Session functions ------------------
$routes -> post('/login', function() {
    SessionController::login();
});

$routes -> post('/logout', function() {
    SessionController::logout();
});