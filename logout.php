<?php
require_once __DIR__ . '/logger.php';
session_destroy();
write_log("DECONNEXION",
    "",
    "",
    "La déconnexion de ".current_user()['username']." a réussie.");
header('Location: /');
exit;
