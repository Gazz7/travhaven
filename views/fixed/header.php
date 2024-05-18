<?php

$nav = getAll('navigation');

?>


<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <h1><a href="index.php">Traveler's Haven</a></h1>
            <nav class="links">
                <ul id='nav-lista'>

                    <?php
                    foreach ($nav as $link) :

                    ?>

                        <li><a href="index.php?page=<?= $link->links ?>"><?= $link->name ?></a></li> <?php
                                                                                                    endforeach;

                                                                                                        ?>
                    <input type="search" name="search" id="search">
                </ul>
            </nav>
            <nav class="main">
                <ul>

                    <li class="menu">
                        <a class="fa-bars" href="#menu">Menu</a>
                    </li>
                </ul>
            </nav>
        </header>