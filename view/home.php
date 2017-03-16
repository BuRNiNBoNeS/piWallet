<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <!--<h1><?php echo $lang['PAGE_HEADER']; ?></h1>-->
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>