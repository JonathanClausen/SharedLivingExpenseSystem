
<div class="container">
<?php if (! empty($users) && is_array($users)) : ?>

    <h4>Hey <?php echo $email ;?></h4>
    <?php foreach ($users as $user): ?>

        <h3><?= esc($user->username) ?></h3>

        <div class="main">
            <?= esc($user->email) ?>
        </div>
        <p><a href="/users/<?= esc($user->id, 'url') ?>">View user</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
</div>