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

                    if(isset($_SESSION['user_id'])){

                      echo "<li class=\"dropdown\">
                      <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Account
                      <b class=\"caret\"></b></a>
                      <ul class=\"dropdown-menu\">
                        <li><a href=\"logout.php\">Logout</a></li>
                        <li><a href=\"renew.php\">Renew</a></li>
                        <li><a href=\"change_password.php\">Change Password</a></li>
                        <li><a href=\"favorites.php\">Favorites</a></li>
                        <li><a href=\"recommendations.php\">Recommendations</a></li>
                        </ul>
                      </li>";

                    }

                    if(isset($_SESSION['user_admin'])){

                      echo "
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Admin <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                          <li><a href=\"add_page.php\">Add Page</a></li>
                          <li><a href=\"add_pdf.php\">Add PDF</a></li>
                          <li><a href=\"#\">Something else here</a></li>
                        </ul>
                      </li>";

                    }

                    if(!isset($_SESSION['user_id'])){
                      require('./login_form.inc.php');
                    }

                   
                ?>