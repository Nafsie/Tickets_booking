<header id="header">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="./index.php?page=home">Administrator</a></h1>

      <nav class="nav-menu d-none d-lg-block" id='top-nav'>
        <ul>
          
          <li class="nav-schedule"><a href="./index.php?page=home">EVENTS</a></li>
           <li class="nav-booked"><a href="./index.php?page=booked">RESERVATIONS</a></li>
           <li class="nav-booked"><a href="./logout.php">LOGOUT</a></li>
          </li>
          
          
            
          </li>
        </ul>
      </nav><!-- .nav-menu -->


    </div>
  </header>
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
      if(page != ''){
        $('#top-nav li').removeClass('active')
        $('#top-nav li.nav-'+page).addClass('active')
      }
      $('#manage_account').click(function(){
      uni_modal('Manage Account','manage_account.php')
  })
    })

  </script>