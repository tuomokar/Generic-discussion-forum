<?php

$routes -> get('/', function() {
    MainController::index();
});

// temp address
$routes -> get('/topic-groups/1', function() {
    TopicGroupController::topicGroupShow();
});

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