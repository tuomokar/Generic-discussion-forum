<?php

  $routes -> get('/', function() {
      MainController::index();
  });
  $routes-> get('/topic-groups/1', function() {
      TopicGroupController::topicGroup1();
  });

