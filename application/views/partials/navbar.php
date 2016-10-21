<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('Main'); ?>">Seen A Kitten?</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo site_url('Main'); ?>">Home</a></li>
            <li><a href="<?php echo site_url('Main/about'); ?>">About</a></li>
            <li><a href="<?php echo site_url('Main/tips'); ?>">Tips</a></li>
            
            <?php 
              if($this->aauth->is_loggedin())
              {
            ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('Report'); ?>">Filed reports</a></li>
                    <li><a href="<?php echo site_url('Report/map'); ?>">File a report</a></li>
                  </ul>
                </li>

                <li><a href="<?php echo site_url('Analytics'); ?>">Analytics</a></li>
            <?php 
              }
              else
              {
            ?>
              <li><a href="<?php echo site_url('Auth/login'); ?>">Login</a></li>
            <?php 
              }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>