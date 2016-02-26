<?
session_start();
$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
?>
<!DOCTYPE html>
<meta charset="utf-8" />
<title>jQuery 로그인</title>
<link rel="stylesheet" href="<?=$ref_css?>" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

<script type="text/javascript" src="<?=$ref_logincheck_js?>" ></script>
<body>
    <div id="login_logout_div">
      <ul>
        <li id="login">
          <a id="login-trigger" href="#">
            Log in <span>&#x25BC;</span>
          </a>
          <div id="login-content">
            <form id="loginform">
              <fieldset id="inputs">
              	<label for="username">Username</label>
                <input id="username" type="text" autofocus placeholder="Your username" required>
                <label for="password">Password</label>   
                <input id="password" type="password" placeholder="Your password" required>
              </fieldset>
             <fieldset id="actions">
                <input type="submit" id="insubmit" value="Log in"  class="logit">
                <input type="button" id="incancel" value="Cancel"  class="forgetit">
                <!-- <label><input type="checkbox" checked="checked"> Keep me signed in</label> -->
              </fieldset>
             </form>
          </div>                     
        </li>
        <li id="logout">
          <a id="logout-trigger" href="#">
            Log out <span>&#x25BC;</span>
          </a>
          <div id="logout-content">
            <form id="logoutform">
             <fieldset id="actions">
             	<input id="name" type="text" value="Firstname Lastname (username)" readonly>
                <input type="submit" id="outsubmit" value="Log out" class="logit">
                <input type="reset" id="outcancel" value="Cancel"  class="forgetit">
                <!-- <label><input type="checkbox" checked="checked"> Keep me signed in</label> -->
              </fieldset>
             </form>
          </div>                     
        </li>
      </ul>
    </div>
</body>