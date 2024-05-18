<?php
$blogs = getBlogData();
$comments = getComments();
$users = getAll('users');
$messages = getAll('messages');
?>



<?php
if (isset($_SESSION['admin'])) :

?>
    <div id="container">
        <h1>Admin Panel</h1>
        <div class="tabs-5">
            <ul class="tabs">
                <li><a href="#tab13">Delete Post</a></li>
                <li><a href="#tab14">Delete Comment</a></li>
                <li><a href="#tab15">Useres Status and Roles</a></li>
                <li><a href="#tab16">Messages</a></li>

            </ul>
            <section class="tab_content_wrapper">
                <article class="tab_content" id="tab13">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Post ID</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Delete Post</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($blogs as $blog) : ?>
                                    <tr>
                                        <th scope="row"><?= $blog->blog_ID ?></th>
                                        <td><?= $blog->title ?></td>
                                        <td><?= $blog->username ?></td>
                                        <td>
                                            <form action="models/deletePost.php" method="post"><input type="submit" value="delete">
                                                <input type="hidden" value="<?= $blog->blog_ID ?> " name="ID">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>
                <article class="tab_content" id="tab14">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Comment ID</th>
                                    <th scope="col">Content </th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Delete Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $c) : ?>
                                    <tr>
                                        <th scope="row"><?= $c->comment_ID ?></th>
                                        <td><?= $c->content ?></td>
                                        <td><?= $c->username ?></td>
                                        <td>
                                            <form action="models/deleteComment.php" method="post"><input type="submit" value="delete">
                                                <input type="hidden" value="<?= $c->comment_ID ?> " name="ID">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>
                <article class="tab_content" id="tab15">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">User Name </th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $u) : ?>
                                    <?php if ($_SESSION['admin']->ID == $u->ID) {
                                        continue;
                                    } ?>
                                    <tr>
                                        <th scope="row"><?= $u->ID ?></th>
                                        <td><?= $u->username ?></td>

                                        <td>
                                            <form action="models/changeRole.php" method="post">

                                                <?php if ($u->role == 1) : ?>
                                                    <input type="submit" value="User">
                                                    <input type="hidden" value="2" name="ID">
                                                <?php else : ?>
                                                    <input type="submit" value="Admin">
                                                    <input type="hidden" value="1" name="ID">
                                                <?php endif ?>
                                                <input type="hidden" value="<?= $u->ID ?> " name="userID">

                                            </form>
                                        </td>
                                        <td>
                                            <form action="models/changeStatus.php" method="post">
                                                <?php if ($u->status == 1) : ?>
                                                    <input type="submit" value="Active">
                                                    <input type="hidden" value="0" name="ID">
                                                <?php else : ?>
                                                    <input type="submit" value="Disabled">
                                                    <input type="hidden" value="1 " name="ID">
                                                <?php endif ?>
                                                <input type="hidden" value="<?= $u->ID ?> " name="userID">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>
                <article class="tab_content" id="tab16">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $m->email ?></th>
                                        <td><?= $m->subject ?></td>
                                        <td><?= $m->content ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </article>

            </section>
        </div>
    </div>
    <!-- jQueryTab.js -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="assets/js/jQueryTab.js"></script>

    <script type="text/javascript">
        // initializing jQueryTab plugin 
        $('.tabs-1').jQueryTab({
            initialTab: 2, // tab to open initially; start count at 1 not 0
            tabInTransition: 'fadeIn',
            tabOutTransition: 'scaleUpOut',
            cookieName: 'active-tab-1',
            tabPosition: 'bottom'
        });
        $('.tabs-2').jQueryTab({
            initialTab: 3,
            openOnhover: true,
            tabInTransition: 'flipIn',
            tabOutTransition: 'flipOut',
            cookieName: 'active-tab-2'

        });
        $('.tabs-3').jQueryTab({
            responsive: false,
            useCookie: false,
            initialTab: 1,
            tabInTransition: 'rotateIn',
            tabOutTransition: 'rotateOut',
            before: function() {
                console.log('Hello from before!');
            }, // function to call before tab is opened
            after: function() {
                console.log('Hello from after!')
            } // function to call after tab is opened

        });
        $('.tabs-4').jQueryTab({
            openOnhover: true,
            collapsible: false,
            initialTab: 4,
            tabInTransition: 'slideUpIn',
            tabOutTransition: 'slideUpOut',
            cookieName: 'active-tab-4'

        });
        $('.tabs-5').jQueryTab({
            initialTab: 3,
            tabInTransition: 'slideRightIn',
            tabOutTransition: 'slideRightOut',
            cookieName: 'active-tab-5'

        });
        $('.tabs-6').jQueryTab({
            initialTab: 4,
            tabInTransition: 'scaleDownIn',
            tabOutTransition: 'scaleDownOut',
            cookieName: 'active-tab-6'

        });
        $('.tabs-7').jQueryTab({
            initialTab: 2,
            tabInTransition: 'fadeIn',
            tabOutTransition: 'fadeOut',
            cookieName: 'active-tab-7'

        });
    </script>
<?php else :
    header("location:index.php?page=home") ?>

<?php endif ?>