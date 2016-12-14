<?
    $personal_website   = $member_info['personal_website'];
    $is_musician        = $member_info['is_musician'];
    $instruments        = $member_info['instruments'];
    $favorite_genres    = $member_info['favorite_genres'];
    $collab_status      = $member_info['collab_status'];
    $additional_info    = $member_info['additional_info'];
?>

<p>
    <? if ($personal_website): ?>
        Personal website: <a href="<?= $personal_website ?>"><?= $personal_website ?></a>
    <? endif; ?>
</p>
<p>
    <? if ($is_musician && is_array($instruments)): ?>
        Instruments:
        <ul>
            <? foreach ($instruments as $instr): ?>
            <li> <?= $instr ?> </li>
            <? endforeach; ?>
        </ul>
    <? else: ?>
        Music appreciator
    <? endif; ?>
</p>
<p>
    Favorite genres:
    <? if (is_array($favorite_genres)): ?>
        <ul>
            <? foreach ($favorite_genres as $genre): ?>
            <li> <?= $genre ?> </li>
            <? endforeach; ?>
        </ul>
    <? else: ?>
        None
    <? endif; ?>
</p>
<? if ($is_musician):
    if ($collab_status): ?>
        <p>Open to collaboration</p>
    <? else: ?>
        <p>Not open to collaboration</p>
    <? endif;
endif; ?>
<? if ($additional_info): ?>
<p>
    <h3>More about me:</h3>
    <div id='additional-personal-info'>
        <?= $additional_info ?>
    </div>
</p>
<? endif; ?>
