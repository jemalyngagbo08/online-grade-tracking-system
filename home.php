<style>
  .btn-primary {
      background-color: #1167b1 !important;
      border-color: #1167b1 !important;
  }

  .btn-primary:hover {
      background-color: #0e5492 !important;
      border-color: #0e5492 !important;
  }

  .line-bottom:after {
      background-color: #1167b1 !important;
  }
</style>

<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay" style="background-image: url('images/ssufront.jpg')">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <h1 class="line-bottom">Online Grade Tracking System</h1>
        </div>
        <div class="col-lg-5 ml-auto"></div>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-5 pr-md-5 mr-auto">
        <h2 class="line-bottom">Logged In</h2>
        <p>This area is a student area that you can view a student profile and subject with grades</p>
      </div>

      <div class="col-md-6">
        <div class="quick-contact-form bg-white">
          <h2>Login Information</h2>
          <hr/>
          <span class="fa fa-user"></span>
          <label><?php echo $_SESSION['FNAME']; ?></label><br/>

          <span class="fa fa-cog"></span>
          <label><?php echo $_SESSION['LNAME']; ?></label><br/>
          <hr/>

          <!-- CHANGE PASSWORD BUTTON -->
          <div class="form-group">
            <button class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
              Change Password
            </button>
          </div>

          <div class="form-group">
            <a href="logout.php" class="btn btn-primary px-5">
              Logout <span class="fa fa-log-out"></span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="post" action="change_password.php">
        <div class="modal-body">

          <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="old_pass" class="form-control" required>
          </div>

          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_pass" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_pass" class="form-control" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="savepassword" class="btn btn-primary">
              Save Password
          </button>

        </div>
      </form>

    </div>
  </div>
</div>
