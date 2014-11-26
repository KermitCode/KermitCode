<?php

	$redis = new Redis;

	$redis->connect('127.0.0.1', 6379);

	$redis->set('feima', '123456789');

	$feima = $redis->get('feima');

	print_r($feima);