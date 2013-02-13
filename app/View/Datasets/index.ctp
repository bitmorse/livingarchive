<div id="content__">
                <div id="content_">

                    <!-- end right panel -->
                  <div class="row">
                    <div class="span9 content-outer">

                    	<div id="content">
	                    	<form method="GET" class="dataset-search clearfix" id="dataset-search">
							  <input type="search" placeholder="Search..." results="0" autocomplete="off" value="<?php echo @$_GET['term']; ?>" name="term" class="search" style="width: 571.2px;">
							  <input type="submit" class="btn btn-large button" value="Search">
							  <div id="dataset-search-ext"></div>
							</form>

							<h4><?php echo $resultcount; ?> datasets found</h4>
	                    	
	                    	<?php if($resultcount){
	                    	foreach (@$results['hits']['hits'] as $result) { ?>
	                    	<ul class="datasets">
							    <li>
							        <div class="header">
								      <span class="title">
								        <a href="<?php if($result['_source']['url']){ echo $result['_source']['url']; }else{ echo $result['_source']['ckanSiteUrl'] .'/dataset/'. $result['_source']['ckanId']; } ?>">
								        	<?php echo $result['_source']['title']; ?>
								        </a>
								      </span>
								      <div class="search_meta">
								        <ul class="openness">
								        	<?php if(@$result['_source']['isopen'] == "YES"){ ?>
								            <li>
								              <a title="This dataset satisfies the Open Definition." href="http://opendefinition.org/okd/">
								                  <img alt="[Open Data]" src="http://assets.okfn.org/images/ok_buttons/od_80x15_blue.png">
								              </a>
								            </li>
								            <?php } ?>
								        
								        </ul>
								      </div>
									</div>

									<div class="source">
										<?php echo @$result['_source']['ckanSiteUrl']; ?>
										<?php
											$resources = count(@$result['_source']['resources']);
											if($resources){
												echo ' • <a href="'.@$result['_source']['ckanSiteUrl'] .'/dataset/'. $result['_source']['ckanId'].'">'.$resources .' files</a>';
											}
										?>
										 • 
										 <a href="/datasets/show/<?php echo $result['_source']['_id']; ?>">more</a> • <a href="/datasets/show/<?php echo $result['_source']['_id']; ?>#disqus_thread">comments</a>

									</div>

									<div class="lastaccessed">
										<?php if(@$result['_source']['lastCrawled']){ echo 'Last accessed '.date('D, d M Y',@$result['_source']['lastCrawled']); }else{ echo 'Added '. substr($result['_source']['created'], 0, 10);} ?>
									</div>
									<div class="extract">
							        	<?php echo $this->String->shorten($result['_source']['notes'], 200); ?>

							        	<?php
							        		if(is_array($result['_source']['tags'])){
								        		foreach ($result['_source']['tags'] as $tag) {
								        			
								        			if(!@in_array($tag, @$tags)){
								        				$tags[] = $tag;
								        			}

								        		} 
								        	}
							        	?>
										
									</div>

							    </li>
							</ul>
							<?php } ?>
								
								<br/>
								<?php echo @$pagination; ?>

						    <?php }  ?>
						</div>

                    </div>
                    <div class="span3 sidebar-outer">
                      <div id="sidebar">
                        <ul class="widget-list">
                          <primarysidebar>

                          		<hr style="width:90%;margin-top:3px" />
								<a href="/datasets/add" class="btn btn-large btn-success" style="color:white !important;margin-left:28px">Add a Dataset</a>
                          		<hr style="width:90%" />
                          	
                          		<?php 
                          			if(@is_array($tags)){
                          				echo '
                          				<h3>Tags</h3>
                          				<div id="tagcloud">';
                          				foreach ($tags as $tag) {
                          					echo '<a href="/datasets/?tag='.$tag.'">'.$tag.'</a>, ';
                          				}
                          				echo '
                          				</div>';
                          			}else{
                          				echo '<h3>Stats</h3><br /><a href="/datasets/stats">'.Cache::read('countDatasets', 'long').' Datasets</a> are searchable.';
                          			}
                          		?>
                          	


                          </primarysidebar>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

                <script type="text/javascript">
			    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			    var disqus_shortname = 'livingarchiveeu'; // required: replace example with your forum shortname

			    /* * * DON'T EDIT BELOW THIS LINE * * */
			    (function () {
			        var s = document.createElement('script'); s.async = true;
			        s.type = 'text/javascript';
			        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
			        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
			    }());
			    </script>
