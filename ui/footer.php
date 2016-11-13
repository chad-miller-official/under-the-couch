<footer>
    &copy; <? if (date ('Y') > 2016): ?>
        2016 &ndash; <?= date('Y') ?> Under the Couch
    <? else: ?>
        <?= date('Y') ?> Under the Couch
    <? endif ?>
</footer>
