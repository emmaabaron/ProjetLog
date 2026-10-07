<?php
require_once __DIR__ . '/logger.php';
require_login();
$user = current_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $bio = trim($_POST['bio'] ?? '');
    $avatar_url = trim($_POST['avatar_url'] ?? '');
    if (mb_strlen($bio) > 280) $bio = mb_substr($bio, 0, 280);
    if ($avatar_url === '') $avatar_url = null;

    $stmt = $pdo->prepare('UPDATE users SET bio = ?, avatar_url = ? WHERE id = ?');
    $stmt->execute([$bio, $avatar_url, $user['id']]);
    header('Location: /profile.php?saved=1');
    write_log("EDIT PROFIL",
            "",
            "",
            "La modification du profil de ".current_user()['username']." a réussie.");

    exit;
}

include __DIR__ . '/partials_header.php';
$user = current_user(); // refresh
?>
<section class="card" style="max-width:720px;margin:20px auto">
  <h2 class="section-title">Mon profil</h2>
  <form method="post">
    <?php csrf_input(); ?>
    <label>Bio (280)</label>
    <textarea name="bio" maxlength="280" placeholder="Quelques mots…"><?php echo h($user['bio']); ?></textarea>
    <label>URL de l'avatar (optionnel)</label>
    <input name="avatar_url" placeholder="https://…" value="<?php echo h($user['avatar_url']); ?>">
    <div style="margin-top:12px;display:flex;justify-content:flex-end;gap:8px">
      <button class="button" type="submit">Enregistrer</button>
    </div>
  </form>
</section>
<?php include __DIR__ . '/partials_footer.php'; ?>
