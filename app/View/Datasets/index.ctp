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

							<h4><?php echo count(@$results); ?> datasets found</h4>
	                    	
	                    	<?php if(count(@$results)){
	                    	foreach (@$results as $result) { ?>
	                    	<ul class="datasets">
							    <li>
							        <div class="header">
								      <span class="title">
								        <a href="<?php if($result['Dataset']['url']){ echo $result['Dataset']['url']; }else{ echo $result['Dataset']['ckanSiteUrl'] .'/dataset/'. $result['Dataset']['ckanId']; } ?>">
								        	<?php echo $result['Dataset']['title']; ?>
								        </a>
								      </span>
								      <div class="search_meta">
								        <ul class="openness">
								        	<?php if(@$result['Dataset']['isopen'] == "YES"){ ?>
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
										<?php echo $result['Dataset']['ckanSiteUrl']; ?>
										<?php
											$resources = count($result['Dataset']['resources']);
											if($resources){
												echo ' &raquo; <a href="'.$result['Dataset']['ckanSiteUrl'] .'/dataset/'. $result['Dataset']['ckanId'].'">'.$resources .' files</a>';
											}
										?>
									</div>
									<div class="extract">
							        	<?php echo $this->String->shorten($result['Dataset']['notes'], 200); ?>

							        	<?php
							        		foreach ($result['Dataset']['tags'] as $tag) {
							        			
							        			if(!@in_array($tag, @$tags)){
							        				$tags[] = $tag;
							        			}

							        		} 
							        	?>
										
									</div>

							    </li>
							</ul>
							<?php }}  ?>
						</div>

                    </div>
                    <div class="span3 sidebar-outer">
                      <div id="sidebar">
                        <ul class="widget-list">
                          <primarysidebar>

                          	
                          		<?php 
                          			if(@is_array($tags)){
                          				echo '
                          				<h3>Tags</h3>
                          				<div id="tagcloud">';
                          				foreach ($tags as $tag) {
                          					echo '<a href="./?term='.$tag.'">'.$tag.'</a>, ';
                          				}
                          				echo '
                          				</div>';
                          			}
                          		?>
                          	


                          </primarysidebar>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
