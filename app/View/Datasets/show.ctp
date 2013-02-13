<div id="content__">
    <div id="content_">

        <!-- end right panel -->
      <div class="row">
        <div class="span9 content-outer">

        	<div id="content">

            <h2><?php echo $dataset['title'] ?> <?php if($dataset['url']){echo '<a href="'.$dataset['url'].'"><img src="/img/link.png" alt="Link" /></a>';} ?></h2>
            <h4>
              <?php if(@$dataset['ckanSiteUrl']): ?>
              <a href="<?php echo $dataset['ckanSiteUrl']; ?>/dataset/<?php echo $dataset['ckanId']; ?>">
                catalogued by <?php echo $dataset['ckanSiteUrl']; ?>
                <?php $files = count($dataset['resources']); if($files){ echo ' • '.$files.' files'; } ?>
              </a>
            <?php else: ?>

              catalogued by livingarchive.eu

            <?php endif; ?>

            </h4>
            <br />
            <p>
              <?php if(@$dataset['notes_rendered']){ echo @$dataset['notes_rendered']; }else{ echo $dataset['notes']; }?>
            </p>

            <?php 

              if(@$dataset['dataset_url']){ 

                echo '<a href="'.$dataset['dataset_url'].'">Dataset Download</a>';

              } 

            ?>

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

                <b>License</b><br />
                <?php echo $dataset['license']; ?>

                <br /><br />


                <b>Last accessed</b><br />
                <?php echo @date('m.d.Y H:i', $dataset['lastCrawled']); ?>

                
                
                <br /><br />
                
                <?php if(count($mlt)): ?>
                <b>Similar datasets</b><br />
                <ul>
                <?php foreach ($mlt as $mlt) { ?>
                  <li><a href="/datasets/show/<?php echo $mlt['_source']['_id']; ?>"> <?php echo $mlt['_source']['title']; ?> </a></li>
                <?php } ?>
                </ul>
                <?php endif; ?> 


                <?php if(@$dataset['creator_ip'] == $_SERVER['REMOTE_ADDR']){ ?>

                  <br />
                  <br />
                  <br />
                  <a href="/datasets/delete/<?php echo $dataset['_id']; ?>" class="btn btn-large btn-danger" style="color:white !important;">Delete Dataset</a>

                <?php } ?>


              </primarysidebar>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
