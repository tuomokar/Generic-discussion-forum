<?php

$routes -> get('/', function() {
    MainController::index();
});

$routes -> get('/topic-groups/1', function() {
    TopicGroupController::topicGroupShow();
});

$routes -> get('/threads/1', function() {
    ThreadController::threadShow();
});