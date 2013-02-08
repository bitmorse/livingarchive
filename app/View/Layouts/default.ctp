<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js" lang="en">
<head>
    <title>LivingArchive - A search engine for Open Data</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="http://localhost:8888/bm/livingarchive/css/style.css" rel="stylesheet" type="text/css" />
</head>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="/bm/livingarchive/js/d3.layout.cloud.js"></script>
<body class="index home no-sidebar">
<div id="wrapper">
  <div class="lsize relative">
        <!-- HEADER START HERE -->
    <div id="header">
		<a href="/" id="logo" title="Living Archive"></a>
		    <div class="fr">
		      
		      <span class="searchbg">
		      

		      </span>

		      <div class="account">
		        <span>
		          <a href="/users/login">Login</a>
		          <a href="/users/register">Register</a>
		        </span>
		      </div>
		    </div>
		<!-- MENU START HERE -->
		<div id="menu">
		    <ul>
		        <li><a class="active" href="/">Home</a> |</li>
		        <li><a href="/dataset?q=">Datasets</a> |</li>
		        <li><a href="/dataset?q=">Visualisations</a> |</li>
		        <li><a href="/dataset?q=">Feedback</a></li>


		    </ul>
        </div>
      <!-- MENU END HERE -->
    </div>
  </div>
  <!-- HEADER END HERE -->
  <!-- MAIN BOX START HERE -->
  <div id="main">
        <div class="lsize clearfix">


			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>


            <!-- end content -->
        </div>
  </div>
  <!-- MAIN BOX END HERE -->
    <!-- footer -->
  <div id="footer" class="lsize">
      <div class="ftrbg">
          <div class="clear copyright">
              © 2013 Living Archive
            </div>
            <ul class="footer-nav">
              <li>
                <a href="/user">
                  Users
                </a> |
              </li>
              <li>
                <a href="/tag">
                  Tags
                </a> |
              </li>
              <li>
                <a href="/stats">
                  Statistics
                </a> |
              </li>
              <li>
                <a href="/revision">
                  Revisions
                </a> |
              </li>
              <li>
                <a href="/ckan-admin">
                  Site Admin
                </a> |
              </li>
            </ul>
          <ul class="footer-nav">
              <li><a href="#">Home</a> |</li>
                <li><a href="#">About Us</a> |</li>
                <li><a href="#">Datasets</a> |</li>
                <li><a href="#">Contact Us</a> | </li>
            </ul>
        </div>
    </div>
    <!-- end footer -->
</div>
<!-- Load jQuery and the plug-in -->


<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35992461-1']);
  _gaq.push(['_setDomainName', 'livingarchive.eu']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</body>
</html>
