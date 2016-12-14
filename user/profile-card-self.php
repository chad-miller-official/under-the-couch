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
        Personal website: <a href="javascript:void(0);"><?= $personal_website ?></a>
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
