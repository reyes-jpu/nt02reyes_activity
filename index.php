<?php
include 'phpfiles/auth.php';          // loads settings + redirects to login.php if not logged in
include 'phpfiles/sample_data.php';   // demo content used by the sections below
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'phpfiles/head.php'; ?>
    </head>
    <body>

    <div class="app-shell">

        <?php include 'phpfiles/navigation.php'; ?>

        <div class="main-col">

            <?php include 'phpfiles/header.php'; ?>

            <main class="content">
                <div class="container-fluid p-0 grid-12">

                    <?php include 'phpfiles/hero.php'; ?>
                    <?php include 'phpfiles/stats.php'; ?>
                    <?php include 'phpfiles/services.php'; ?>
                    <?php include 'phpfiles/announcements.php'; ?>
                    <?php include 'phpfiles/requests.php'; ?>

                </div>
            </main>

            <?php include 'phpfiles/footer.php'; ?>

        </div>
    </div>

    <?php include 'phpfiles/scripts.php'; ?>

    </body>
</html>
