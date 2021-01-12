<?php
                    $pages = array(
                        'Home'=> 'index.php',
                        'About' => '#',
                        'Contact' => '#',
                        'Register' => 'register.php'
                    );

                    $this_page = basename($_SERVER['PHP_SELF']);

                    foreach($pages as $k => $v){
                      echo "<li";
                      if($this_page == $v) echo "class=\"active\"";
                      echo "><a href=\"" . $v. "\">".$k."</a></li>";
                    }

                    if(isset($_SESSION['user_id']))
                ?>