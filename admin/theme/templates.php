<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="plugins/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="plugins/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Grade Tracking System Admin
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="<?php echo WEB_ROOT; ?>plugins/assets/css/bootstrap.min.css" rel="stylesheet" /> 
  <link href="<?php echo WEB_ROOT; ?>plugins/assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo WEB_ROOT; ?>plugins/assets/demo/demo.css" rel="stylesheet" />
  <link href="<?php echo WEB_ROOT; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo WEB_ROOT; ?>css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>css/responsive.css">
  <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>admin/navigation.css">
  <?php if (isset($content) && $content === 'home.php') { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>admin/dashboard.css">
  <?php } ?>
  <?php if (isset($content) && ($content === 'account_content.php' || $content === 'search_content.php')) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>admin/account.css">
  <?php } ?>
  <link rel="icon" type="image/png" href="../plugins/login/images/icons/WBGTS-logo.png"/>
<style type="text/css">
  table {
    font-size: 12px;
  }
  table tr td{
    font-size: 12px;
  }
  .sidebar,
  .sidebar:before,
  .sidebar:after,
  .sidebar .sidebar-wrapper {
      background: #1167b1 !important;  
      opacity: 1 !important;
      height: 100% !important;
  }
  .sidebar:after {
      display: none !important;
  }
  .sidebar .logo,
  .sidebar .logo:before,
  .sidebar .logo:after {
      background: #1167b1 !important;   
      opacity: 1 !important;
  }
  .sidebar .logo .simple-text,
  .sidebar .logo .simple-text.logo-normal {
      color: #ffffff !important;
  }
  .sidebar .nav li > a {
      color: #ffffff !important;
  }
  .sidebar .nav li > a:hover {
      background: #0f5b9c !important;   
      border-radius: 30px !important;
  }
  .sidebar .nav li.active > a {
      background: #0a4373 !important;   
      color: #ffffff !important;
      border-radius: 30px !important;
  }

</style>
</head>
  <?php
  //login confirmation
 confirm_logged_in();

  ?>
<body class="<?php echo (isset($content) && $content === 'home.php') ? 'admin-dashboard-page' : ''; ?>">
  <div class="wrapper ">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo" style="text-align: center;"> 
        <a href="<?php echo WEB_ROOT; ?>admin/index.php" class="simple-text logo-normal">
         Grade Tracking System
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="<?php echo (currentpage_admin() == '') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/index.php"> 
              <i class="now-ui-icons design_app"></i>
              <p>Home</p>
            </a></li> 
              <?php if($_SESSION['ACCOUNT_TYPE']=='Administrator'){ 
                ?>
              <!--
              <li class="<?php echo (currentpage_admin() == 'student') ? "active" : false;?>">
                <a href="<?php echo WEB_ROOT; ?>admin/modules/student/index.php">
                    <i class="now-ui-icons business_badge"></i>
                    <p>Students</p>
                </a>
              </li>
              <li class="<?php echo (currentpage_admin() == 'subject') ? "active" : false;?>">
                <a href="<?php echo WEB_ROOT; ?>admin/modules/subject/index.php">
                    <i class="now-ui-icons education_agenda-bookmark"></i>
                    <p>Subjects</p> 
                </a>
                
              </li>
              <li class="<?php echo (currentpage_admin() == 'course') ? "active" : false;?>">
                <a href="<?php echo WEB_ROOT; ?>admin/modules/course/index.php">
                    <i class="now-ui-icons business_chart-bar-32"></i>
                    <p>Year level</p>  
                </a>
              </li>
              -->
              <li class="<?php echo (currentpage_admin() == 'instructor') ? "active" : false;?>">
                <a href="<?php echo WEB_ROOT; ?>admin/modules/instructor/index.php">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p>Faculty</p>  
                </a>
              </li>
              <li class="<?php echo (currentpage_admin() == 'department') ? "active" : false;?>">
                <a href="<?php echo WEB_ROOT; ?>admin/modules/department/index.php">
                    <i class="now-ui-icons business_bank"></i>
                    <p>Department</p>  
                </a>
              </li>
                 <!--
                 <li  class="<?php echo (currentpage_admin() == 'class') ? "active" : false;?>">
                    <a href="<?php echo WEB_ROOT; ?>admin/modules/class/index.php">
                      <i class="now-ui-icons design_bullet-list-67"></i>
                      <p>Class</p>   
                   </a>
                 </li>  
                  -->
                
               <?php
              }?> 
                   
              <?php if($_SESSION['ACCOUNT_TYPE']=='Teacher'){ 
                ?> 
                   <li class="<?php echo (currentpage_admin() == 'inst_front') ? "active" : false;?>">
                    <a href="<?php echo WEB_ROOT; ?>admin/modules/inst_front/index.php?view=record">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>Record</p>    
                    </a>
                   </li>  
              <?php
              }?>        
                 <?php if($_SESSION['ACCOUNT_TYPE']=='Administrator'){ 
                ?>
                <li class="<?php echo (currentpage_admin() == 'user') ? "active" : false;?>">
                  <a href="<?php echo WEB_ROOT; ?>admin/modules/user/index.php">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>Manage Users</p>     
                  </a>
                </li>
                 <?php
              }?> 
                <!-- <li><a href="<?php echo WEB_ROOT; ?>admin/logout.php">Logout</a></li>  -->

          </ul> 
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler" aria-label="Open sidebar navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Online Grade Tracking System</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form class="admin-nav-search" action="<?php echo WEB_ROOT; ?>admin/search.php" method="get" role="search">
              <label class="sr-only" for="admin-global-search">Search the system</label>
              <input id="admin-global-search" type="search" name="q" class="form-control" placeholder="Search faculty, students..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8') : ''; ?>" autocomplete="off">
              <button type="submit" aria-label="Submit search">
                <i class="now-ui-icons ui-1_zoom-bold" aria-hidden="true"></i>
              </button>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle admin-profile-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02" aria-hidden="true"></i>
                  <span class="admin-profile-name"><?php echo htmlspecialchars($_SESSION['ACCOUNT_NAME'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>admin/account.php?tab=profile">Profile</a>
                  <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>admin/account.php?tab=password">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>admin/logout.php">Logout</a>
                </div>
              </li> 
            </ul>
          </div>
        </div>
      </nav>
        <div class="panel-header panel-header-sm">
      </div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
       <div class="container admin-responsive-content">
        <?php check_message(); ?>
        <?php require_once $content; ?>
         
       </div>
        </div>
    </div>
  </div>
</div>
      <!-- End Navbar -->
     
      
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/core/jquery.min.js"></script>
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/core/popper.min.js"></script>
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo WEB_ROOT; ?>plugins/assets/demo/demo.js"></script> 
    <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>js/jquery.dataTables.js"></script>
     <script src="<?php echo WEB_ROOT; ?>js/popover.js"></script>
     <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
     <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    
    <script type="text/javascript">
  $('.form_curdate').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_bdatess').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
</script>
<script>
  function checkall(selector)
  {
    if(document.getElementById('chkall').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }
   function checkNumber(textBox){
        while (textBox.value.length > 0 && isNaN(textBox.value)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
      //
      function checkText(textBox)
      {
        var alphaExp = /^[a-zA-Z]+$/;
        while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
      function calculate(){  

     var first = document.getElementById('first').value; 
     var second = document.getElementById('second').value; 
     var third = document.getElementById('third').value;  
     var fourth = document.getElementById('fourth').value;  

    var totalVal = parseInt(first) + parseInt(second) + parseInt(third) + parseInt(fourth) ;
    document.getElementById('finalave').value = totalVal;
     document.getElementById('finalave').value = Math.round((parseInt(totalVal)/4));  
        }
  </script>     
  <script>
    $(document).ready(function() {
      var dashboardCharts = $('#bigDashboardChart, #lineChartExample, #lineChartExampleWithNumbersAndGrid, #barChartSimpleGradientsNumbers');
      if (dashboardCharts.length === 4) {
        demo.initDashboardPageCharts();
      }

    });
  </script>

  <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 1
        } ],
        "order": [[ 3, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );

/*$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 2
        } ],
        //vertical scroll
         "scrollY":        "400px",
        "scrollCollapse": true,
        //ordering start at column 2
       "order": [[ 2, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
*/
/*$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers"
    } );
} );*/
/*$(document).ready(function() {
    $('#example').dataTable();
} );
*///scroll vertical
/*$(document).ready(function() {
    $('#example').dataTable( {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
*/       
    </script>
</body>

</html>