<div id="content__">
                <div id="content_">

                    <!-- end right panel -->
                  <div class="row">
                    <div class="span9 content-outer">

                    	<div id="content">

                        <h2>Tags</h2>
	                    	
                            <div id="tagcloud" style="width: 100%; height: 450px;"></div>

                            <script type="text/javascript">
                            /*!
                             * Create an array of word objects, each representing a word in the cloud
                             */
                            var word_array = <?php echo $crawledDatasetsTagsJSON; ?>;
                            
                            $(function() {
                              // When DOM is ready, select the container element and call the jQCloud method, passing the array of words as the first argument.
                              $("#tagcloud").jQCloud(word_array);
                            });
                          </script>



	                    	
						          </div>

                    </div>
                    <div class="span3 sidebar-outer">
                      <div id="sidebar">
                        <ul class="widget-list">
                          <primarysidebar>

                            <b>Search</b><br />
                            <?php echo $amountOfCrawledDatasets; ?> Datasets





                          </primarysidebar>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
