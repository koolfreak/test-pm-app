<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- nice material design -->
  <!-- https://pixinvent.com/free-materialize-material-design-admin-template/ui-basic-buttons.html -->

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#"></a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <div class="row">
        <div class="col s12 m6">
          <div class="card light-blue lighten-4">
            <div class="card-content white-text">
              <span class="card-title">Login</span>
              
                <div class="row">
                    <form action="{{ route('main-login') }}" method="POST" class="col s12">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" name="email" class="validate">
                                    <label for="email">Email</label>
                                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="password" class="validate">
                                        <label for="email">Password</label>
                                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                        <i class="material-icons right">send</i>
                                      </button>
                    </form>
                </div>

            </div>
            
          </div>
        </div>
      </div>
      <br><br>

    </div>
  </div>


  

  


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/js/materialize.js"></script>
  <script src="/js/init.js"></script>

  </body>
</html>
