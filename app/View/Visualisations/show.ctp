<div id="content__">
    <div id="content_">

        <!-- end right panel -->
      <div class="row">
        <div class="span9 content-outer">

        	<div id="content">

            <h2><a style="color:black !important;" href="<?php echo $visualisation['link']; ?>" targe="_blank"><?php echo $visualisation['title'] ?></a></h2>
            <h4><a href="<?php echo $visualisation['link']; ?>" targe="_blank"><?php echo $visualisation['link']; ?></a></h4>
            <br />
            <a href="/files/visualisations/<?php echo $visualisation['image'] ?>" class="fancybox" title="<?php echo $visualisation['title']; ?>">
              <img src="/i.php?src=files/visualisations/<?php echo $visualisation['image'] ?>&w=670&h=200" />
            </a>
            <br /><br />
            <p>
              <?php echo $visualisation['description']; ?>
            </p>

            <br />
            <br />
            <br />
          	
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                var disqus_shortname = 'livingarchiveeu'; // required: replace example with your forum shortname

                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            

            

          	
          </div>

        </div>
        <div class="span3 sidebar-outer">
          <div id="sidebar">
            <ul class="widget-list">
              <primarysidebar>

                <b>Added on</b><br />
                <?php echo $visualisation['created']; ?>

               


              </primarysidebar>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
     $('.fancybox').fancybox();
  });
</script>
