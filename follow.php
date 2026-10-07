<?php
require_once __DIR__ . '/logger.php';

require_login();
check_csrf();

$me = $_SESSION['user_id'];
$target = (int)($_POST['user_id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($target > 0) {
    if ($action === 'follow') {


        follow($me, $target);

        $follower = find_user_by_id($me);
        $followee =find_user_by_id($target);
        write_log("FOLLOW",
            "",
            $followee['username'],
            current_user()['username']." follow ".$followee['username']);

    }

    if ($action === 'unfollow') {

        unfollow($me, $target);
        $follower = find_user_by_id($me);
        $followee =find_user_by_id($target);
        write_log("UNFOLLOW",
            "",
            $followee['username'],
            current_user()['username']." unfollow ".$followee['username']);

    }
}
$ref = $_SERVER['HTTP_REFERER'] ?? '/users.php';
header('Location: ' . $ref);
exit;
