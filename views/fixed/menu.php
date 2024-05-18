<section id="menu">
    <section id='resNav'>
        <span id="user"><img src="images/download.png" alt=""></span>
    </section>

    <!-- Links -->
    <section>
        <?php if (isset($_SESSION['user'])) : ?>
            <div class="profile-image">
                <a href="index.php?page=userPanel"> <img src="assets/images/<?= $_SESSION["user"]->image ?>" class="img" /></a>
            </div>
            <span><?= $_SESSION['user']->username ?></span>
        <?php endif ?>
        <ul class="links" id='responsiveLinks'>
            <?php
            $menu = getAll('navigation');
            foreach ($menu as $link) :

            ?>
                <li>
                    <a href="index.php?page=<?= $link->links ?>">
                        <h3><?= $link->name ?></h3>
                    </a>
                </li>

            <?php
            endforeach;
            ?>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li>
                    <a href="index.php?page=adminPanel">
                        <h3>Admin Panel</h3>
                    </a>
                </li>
            <?php endif ?>
            <?php if (isset($_SESSION['user'])) : ?>
                <li>
                    <a href="index.php?page=userPanel">
                        <h3>User Panel</h3>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </section>

    <section>
        <form action="models/login.php" method="post">
            <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) : ?>
                <ul class="actions stacked">
                    <li>
                        <label for="email">E-mail</label>
                        <input type="email" id="uName2" name="email" placeholder="Your e-mail..">
                        <div class=""></div>
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" id="Password2" name="password" placeholder="Your Password">
                        <div class=""></div>
                    </li>

                    <li><input type='button' id='logIn' value="Log In"></li>
                    <li><a href="index.php?page=registration"><input type='button' id='logIn' value="Sign In"></a></li>
                <?php endif; ?>

                </ul>

        </form>
        <div class="errors"></div>
        <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) : ?>
            <form action="models/logout.php" method="post">
                <ul class="actions stacked">
                    <li><input type='submit' id='logIn' value="Log Out"></li>
                </ul>
            </form>
        <?php endif; ?>

    </section>
</section>
<!-- Main -->
<div id="main">

    <!-- Pagination -->
    <!-- <ul class="actions pagination">
        <li><a href="" class="disabled button large previous">Previous Page</a></li>
        <li><a href="#" class="button large next">Next Page</a></li>
    </ul>

</div> -->

    <!-- Sidebar -->
    <section id="sidebar">