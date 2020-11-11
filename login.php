<?php
// (A) REDIRECT USER IF ALREADY SIGNED IN
session_start();
if (isset($_SESSION['user'])) {
	header("Location: public/index.php");
	die();
}

// (B) OUTPUT HTML ?>
<html lang="en-US" class="fa-events-icons-ready">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Information Technology Services | University of Hawaii System  </title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="https://www.hawaii.edu/its/xmlrpc.php" />
<!-- get favicon -->
<link rel="shortcut icon" href="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon.png" />
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://www.hawaii.edu/its/wp-content/themes/system2018/js/menu.js"></script>
<!-- bootstrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- load google fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700|Source+Code+Pro" rel="stylesheet">
<!-- load font awesome icons -->
<script src="https://use.fontawesome.com/bfcbe1540c.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="https://www.hawaii.edu/its/wp-content/themes/system2018/style.css" />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Information Technology Services &raquo; Feed" href="https://www.hawaii.edu/its/feed/" />
<link rel="alternate" type="application/rss+xml" title="Information Technology Services &raquo; Comments Feed" href="https://www.hawaii.edu/its/comments/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/www.hawaii.edu\/its\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.5.3"}};
			!function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style> 

    <script>
    /* (D) JAVASCRIPT */
    function login () {
      // (D1) GET USER CREDENTIALS
      var data = new FormData();
      data.append('req', 'in');
      data.append('email', document.getElementById("uemail").value);
      data.append('password', document.getElementById("upass").value);

      // (D2) AJAX LOGIN
      var xhr = new XMLHttpRequest();
      xhr.open('POST', "3-ajax.php");

      // (D3) ON SERVER RESPONSE
      xhr.onload = function () {
        // HTTP RESPONSE CODE 200 = OK
        if (xhr.status==200) {
          let response = JSON.parse(this.response);
          if (response.status) {
            window.location.href = "public/index.php";
          } else {
            alert(response.msg);
          }
        }
        // SERVER RESPONDED WITH "NOT OK"
        // (404 NOT FOUND, 403 UNAUTHORIZED, ETC...)
        else {
          alert("SERVER ERROR");
          console.log(this.response);
        }
      };

      // (D4) SERVER DID NOT RESPOND
      xhr.onerror = function(e){
        alert("SERVER ERROR");
        console.log(e);
      };

      // (D5) GO!
      xhr.send(data);
      return false;
    }
    </script>
	<link rel='stylesheet' id='wp-block-library-css'  href='https://www.hawaii.edu/its/wp-includes/css/dist/block-library/style.min.css?ver=5.5.3' type='text/css' media='all' />
<link rel='stylesheet' id='super-rss-reader-css'  href='https://www.hawaii.edu/its/wp-content/plugins/super-rss-reader/public/css/style.min.css?ver=4.0' type='text/css' media='all' />
<link rel='stylesheet' id='authorizer-public-css-css'  href='https://www.hawaii.edu/its/wp-content/plugins/authorizer/css/authorizer-public.css?ver=2.8.0' type='text/css' media='all' />
<script type='text/javascript' src='https://www.hawaii.edu/its/wp-includes/js/jquery/jquery.js?ver=1.12.4-wp' id='jquery-core-js'></script>
<script type='text/javascript' src='https://www.hawaii.edu/its/wp-content/plugins/super-rss-reader/public/js/jquery.easy-ticker.min.js?ver=4.0' id='jquery-easy-ticker-js'></script>
<script type='text/javascript' src='https://www.hawaii.edu/its/wp-content/plugins/super-rss-reader/public/js/script.min.js?ver=4.0' id='super-rss-reader-js'></script>
<script type='text/javascript' id='auth_public_scripts-js-extra'>
/* <![CDATA[ */
var auth = {"wpLoginUrl":"https:\/\/www.hawaii.edu\/its\/wp-login.php?redirect_to=%2Fits%2F","publicWarning":"","anonymousNotice":"<p>Notice: You are browsing this site anonymously, and only have access to a portion of its content.<\/p>","logIn":"Log In"};
/* ]]> */
</script>
<script type='text/javascript' src='https://www.hawaii.edu/its/wp-content/plugins/authorizer/js/authorizer-public.js?ver=2.8.0' id='auth_public_scripts-js'></script>
<link rel="https://api.w.org/" href="https://www.hawaii.edu/its/wp-json/" /><link rel="alternate" type="application/json" href="https://www.hawaii.edu/its/wp-json/wp/v2/pages/29" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.hawaii.edu/its/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://www.hawaii.edu/its/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 5.5.3" />
<link rel="canonical" href="https://www.hawaii.edu/its/" />
<link rel='shortlink' href='https://www.hawaii.edu/its/' />
<link rel="alternate" type="application/json+oembed" href="https://www.hawaii.edu/its/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.hawaii.edu%2Fits%2F" />
<link rel="alternate" type="text/xml+oembed" href="https://www.hawaii.edu/its/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.hawaii.edu%2Fits%2F&#038;format=xml" />
  </head>
<body class="home page-template-default page page-id-29">
<header id="top">
  <a href="#main_area" id="skip2main">Skip to Main Content</a>
  <div id="header_top">
    <div id="header_top_content" class="container">
      <ul id="header_mainmenu">
        <li><a href="https://www.hawaii.edu/">UH Home</a></li>
        <li><a href="https://www.hawaii.edu/directory/">Directory</a></li>
        <li><a href="https://myuh.hawaii.edu/">MyUH</a></li>
        <li><a href="http://workatuh.hawaii.edu/">Work at UH</a></li>
        <li><a href="https://apply.hawaii.edu/">Apply</a></li>
      </ul>
      <div id="header_smrow">
        <a href="https://twitter.com/UHawaiiNews">
          <img src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon-twitter.png" alt="twitter" class="header_smicon" />
        </a> &nbsp;
        <a href="https://www.facebook.com/universityofhawaii">
          <img src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon-facebook.png" alt="facebook" class="header_smicon" />
        </a> &nbsp;
        <a href="https://instagram.com/uhawaiinews/">
          <img src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon-instagram.png" alt="instagram" class="header_smicon" />
        </a> &nbsp;
        <a href="http://www.flickr.com/photos/uhawaii">
          <img src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon-flickr.png" alt="flickr" class="header_smicon" />
        </a> &nbsp;
        <a href="https://www.youtube.com/user/uhmagazine">
          <img src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/icon-youtube.png" alt="youtube" class="header_smicon" />
        </a>
      </div>
    </div>
  </div>
  <div id="header_mid">
    <div class="container">
      <img id="header_mid_logo" src="https://www.hawaii.edu/its/wp-content/themes/system2018/images/uh-nameplate.png" srcset="https://www.hawaii.edu/its/wp-content/themes/system2018/images/uh-nameplate.png 1x, https://www.hawaii.edu/its/wp-content/themes/system2018/images/uh-nameplate-2x.png 2x" alt="University of Hawai&#699;i System" />
    </div>
  </div>
  <div id="department_name">
    <div class="container">
      <div class="site-name-description">
        <h1 id="header_sitename">
          <a href="https://www.hawaii.edu/its/" rel="home">Information Technology Services</a>
        </h1>
                  <div id="header_sitedescription">
            University of Hawaii System          </div>
              </div>
    </div>
  </div>
  <nav id="header_btm" role="navigation" aria-label="main navigation">
    <div class="container">
      <a class="menu-toggle" aria-expanded="false">Menu <span class="screen-reader-text">Open Mobile Menu</span></a>
      <a class="search-mobile" href="#" class="dropdown-toggle">Search <span class="fa fa-search" aria-hidden="true"></span></a>
      <div class="search-form-container container">
          <form method="get" class="search-form" id="searchform" action="https://www.hawaii.edu/its/">
    <label for="basic-site-search" class="assistive-text screen-reader-text">Search this site</label>
    <input type="search" class="search-field" name="s" id="basic-site-search" placeholder="Site search" />
    <button type="submit" class="search-submit" name="submit" id="searchsubmit" aria-label="search" value="Search"><span class="fa fa-search" aria-hidden="true"></span><span class="screen-reader-text">Site search</span></button>
  </form>
      </div>
      
        <div id="header_btm_content">
          <ul id="header_sitemenu" class="menu"><li id="menu-item-976" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-976"><a href="https://www.hawaii.edu/its/help-desk/">HELP DESK</a></li>
<li id="menu-item-977" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-977"><a href="https://www.hawaii.edu/its/services/">SERVICES</a></li>
<li id="menu-item-27" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-27"><a href="https://www.hawaii.edu/infosec/">INFORMATION SECURITY</a></li>
<li id="menu-item-2611" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2611"><a href="https://www.hawaii.edu/its/alerts/">ALERTS</a></li>
<li id="menu-item-2350" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2350"><a href="#">ABOUT</a>
<ul class="sub-menu">
	<li id="menu-item-979" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-979"><a href="https://www.hawaii.edu/its/about/">About</a></li>
	<li id="menu-item-981" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-981"><a href="https://www.hawaii.edu/its/about/about-cio/">VP for Information Technology and Chief Information Officer</a></li>
	<li id="menu-item-982" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-982"><a href="https://www.hawaii.edu/its/about/administrative-services/">Administrative Services</a></li>
	<li id="menu-item-980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-980"><a href="https://www.hawaii.edu/its/about/academic-technologies/">Academic Technologies</a></li>
	<li id="menu-item-983" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-983"><a href="https://www.hawaii.edu/its/about/csoc/">Client Service and Operations Center (CSOC)</a></li>
	<li id="menu-item-988" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-988"><a href="https://www.hawaii.edu/its/about/cyberinfrastructure/">Cyberinfrastructure</a></li>
	<li id="menu-item-984" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-984"><a href="https://www.hawaii.edu/its/about/enterprise-systems/">Enterprise Systems</a></li>
	<li id="menu-item-985" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-985"><a href="https://www.hawaii.edu/its/about/information-security/">Information Security</a></li>
	<li id="menu-item-986" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-986"><a href="https://www.hawaii.edu/its/about/technology-infrastructure-office/">Technology Infrastructure</a></li>
</ul>
</li>
<li id="menu-item-1693" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1693"><a href="https://www.hawaii.edu/askus/">ASK US</a></li>
<li id="menu-item-1616" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1616"><a href="https://www.hawaii.edu/its/contact/">CONTACT ITS</a></li>
</ul>        </div>

          </div>
  </nav>
</header>
  <body>
  <main id="main_area" class="front-page" role="main">
        <div id="main_content">

      <div class="container" id="content" role="main">

        
          
             <div class="row">
              <div class="col-lg-9 col-md-8">
    <!-- (E) LOGIN FORM -->
    <form id="login" onsubmit="return login();">
      <h1><strong>MEMBER LOGIN</strong></h1><br>
      <input type="email" id="uemail" placeholder="Email" required><br><br>
      <input type="password" id="upass" placeholder="Password" required><br><br>
      <input type="submit" id="ugo" value="Sign In">
    </form>
<?php require "public/templates/footer.php"; ?>
  </body>
</html>
