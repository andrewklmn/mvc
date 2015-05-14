<?php

    if(!isset($c)) exit;  
    
?><nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand"><?php echo $program; ?></a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
          <ul class="nav navbar-nav">
            <?php 
                foreach ($menu as $key => $value) {
                    if (is_array($value[0])) {
                        
                        ?>
                            <li class="dropdown">
                              <a aria-expanded="false" role="button" data-toggle="dropdown" 
                                 class="dropdown-toggle" href="#"><?php echo $value[0][1]; ?>
                                  <span class="caret"></span>
                              </a>
                              <ul role="menu" class="dropdown-menu">
                                <?php 
                                    for ($i = 1; $i < count($value); $i++) {
                                        if ($value[$i][0]=='-') {
                                            ?>
                                                <li class="divider"></li>                                                
                                            <?php
                                        } else {
                                            ?>
                                                <li>
                                                    <a href="?c=<?php echo $value[$i][0]; ?>">
                                                        <?php echo $value[$i][1]; ?>
                                                    </a>
                                                </li>
                                            <?php
                                        };
                                    };
                                ?>
                              </ul>
                            </li>
                        <?php
                    } else {
                        if ($c==$value[0]) {
                            ?>
                                <li class="active">
                                    <a href="?c=<?php echo $value[0]; ?>">
                                        <?php echo $value[1]; ?>
                                    </a>
                                </li>
                            <?php
                        } else {
                            ?>
                                <li>
                                    <a href="?c=<?php echo $value[0]; ?>">
                                        <?php echo $value[1]; ?>
                                    </a>
                                </li>
                            <?php
                        };
                    };
                };
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>