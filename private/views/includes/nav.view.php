

<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <span class="text-center" style="margin:auto;">
      <a href="home" class="logo d-flex align-items-center  ">
        <img src="<?=ROOT?>/assets/img/logo.png" style="margin:auto" alt="Logo" class="task_max_time-3">
      <span><?=APP_NAME?></span>
    </a>
  </span>
      <nav id="navbar" class="navbar">
        <ul>
          <?php if(!Auth::logged_in()): ?>  
          <li><a class="nav-link scrollto <?=ActiveLinkSetter('home',$title)?>" href="<?=ROOT?>">Home</a></li>
          <li><a class="nav-link scrollto <?=ActiveLinkSetter('login',$title)?>" href="login">Sign in</a></li>
          <!-- <li><a class="nav-link scrollto <?=ActiveLinkSetter('signup',$title)?>" href="signup">Sign up</a></li> -->
          <li><a class="nav-link scrollto <?=ActiveLinkSetter('about',$title)?>" href="about">About</a></li>
          <?php else:?>
          <li><a class="nav-link scrollto <?=ActiveLinkSetter('home',$title)?>" href="<?=ROOT?>">Home</a></li>
          <?php if(Auth::getUser('role')==3): ?>
            <li><a class="nav-link scrollto <?=ActiveLinkSetter('your Project',$title)?>" href="<?=ROOT?>/projectupload">Your Project</a></li>
            
          <?php elseif(Auth::getUser('role')==1): ?>
            <li><a class="nav-link scrollto <?=ActiveLinkSetter('guide Assigment',$title)?>" href="<?=ROOT?>/assignguide">Assig Guides</a></li>
            <li><a class="nav-link scrollto <?=ActiveLinkSetter('fix Date',$title)?>" href="<?=ROOT?>/fixdate">Fix Date</a></li>
            <li><a class="nav-link scrollto <?=ActiveLinkSetter('student User Credentials',$title)?>" href="<?=ROOT?>/usercredentials">Assig Student User Credentials</a></li>
          <?php endif; ?>
          <!-- <?php if(Auth::getUser('role')==2 || Auth::getUser('role')==1): ?>
             <li><a class="nav-link scrollto <?=ActiveLinkSetter('uploads',$title)?>" href="<?=ROOT?>/uploads">Uploads</a></li>
          <?php endif; ?> -->
            <li><a class="nav-link scrollto <?=ActiveLinkSetter('projects',$title)?>" href="<?=ROOT?>/projects">All Projects</a></li>
          <li class="dropdown"><a href="#"><span><?=ucfirst(Auth::getUser('username'))?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?=ROOT."/".Auth::getUser('username')?>">Profile</a></li>
              
              <li><a href="<?=ROOT?>/home"><?=Auth::getUser('role') > 2 ? 'Project Progress' : 'Student Progress'?></a></li>
              <li><a href="<?=ROOT?>/logout">Log Out</a></li>
            </ul>
          </li>
      
        <?php endif; ?>
          </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->