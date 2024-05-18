
<form id="search-form">

    <input type="text" placeholder="Search..." id='searchA' />

</form>
<?php if (isset($_SESSION['user'])) : ?>
    <input type="hidden" value="<?= $_SESSION['user']->ID ?>" id="userID">
<?php endif ?>

<div class="post-flex">

</div>