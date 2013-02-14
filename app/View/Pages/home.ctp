        	
            <div>
    <!-- slider -->
    <div id="fm_slider" class="slider fl">
       

                <img src="/img/slide1.jpg" title="" alt="asdasd" />
                  <div class="slider-search">
                      <span class="searchbg">
                        <form action="/datasets/" method="GET">
                          <input type="text" name="term" class="searchinput" id="search" value="" />
                        </form>
                      </span>
                      <p>
                        Living Archive <br />A search engine for Open Data
                      </p>
              		</div>

      </div>
  <!-- end slider -->
  </div>
            <!-- content -->
            <div class="front-page" style="width: 100%;">
    <!-- left panel -->
    <div id="left_panel">
      <h2><strong>Recent</strong> Datasets</h2>
        <ul class="recent-list">

        </ul>
        <a href="/datasets/stats" class="readm" title="Read More">More</a>
    </div>
    <!-- end left panel -->
    <!-- right panel -->
    <div id="right_panel">
          <div class="helpbg">
            <p>
              <a href="/datasets/stats"><span id="datasetcount"><?php echo Cache::read('countDatasets', 'long'); ?> and counting</span></a>
            </p>
          </div>

          <div class="news-ltrmain">
            <div class="news-ins" style="padding-top:5px">
              <a href="/datasets/?tag=qlectives">
                <img src="/img/qlogo.png" alt="QLectives Datasets" />
                Featured Datasets from QLectives
              </a>
              <br />

            </div>
          </div>

          <div style="margin-top: 15px" class="news-ltrmain">
            <div class="news-ins">
               <iframe src="http://player.vimeo.com/video/29480781?title=0&amp;byline=0&amp;portrait=0&amp;color=c9ff23" width="207" height="120" frameborder="0"></iframe>
            </div>
          </div>


    </div>
    <!-- end right panel -->
    <!-- three tab -->
    <ul class="three-tab" style="margin-top:30px">
      <li class="marl0">
          <div>
            <h2><strong>LIVING</strong> ARCHIVE</h2>
            <div class="tabinfo">
                <img src="img/db.png" alt="" />
                <h3><strong>LIVING</strong> ARCHIVE</h3>
                <p>What was the average price of a house in the UK in 1935? When will India's projected population overtake that of China? Where can you see publicly-funded art in Seattle? Data to answer many, many questions like these is out there on the Internet somewhere - but it is not always easy to find. Living Archive is a community-run catalogue of sets of data on the Internet...</p>
                <a href="/pages/about" class="readm" title="Read More">More</a>
            </div>
            </div>
        </li>
        <li>
          <div>
<!-- Snippet disqus-recent.html start -->
<div class="ckan-recent-comments">
  <div id="recentcomments" class="dsq-widget" style="width: 360px">
	<h2 class="dsq-widget-title">Recent	Comments</h2>
  <br />
	<script type="text/javascript" src="http://livingarchiveeu.disqus.com/recent_comments_widget.js?num_items=5&amp;hide_avatars=1&amp;avatar_size=32&amp;excerpt_length=150"></script>
  </div>
</div>
<!-- Snippet disqus-recent.html end -->
            </div>
        </li>
    </ul>
    <!-- end three tab -->
  </div>


<script type="text/javascript">

  $(document).ready(function(){

    $.ajax({
      url: '/ajax/recentlycrawled',
      success: function(data){

        $.map(data.hits.hits, function(item, index) {
            lastCrawled = new Date(item._source.lastCrawled*1000);
            filesCount = item._source.resources.length;

            if(item._source.ckanSiteUrl != null){
              catalogUrl = item._source.ckanSiteUrl + '/dataset/'+ item._source.ckanId;
            }else{
              catalogUrl = '/datasets/show'+ item._source._id;
            }

            if(item._source.notes != null){
              notes = item._source.notes.substring(200,0);
            }else{
              notes = '';
            }

            $('ul.recent-list').append('<li><h4><a href="/datasets/show/'+item._source._id+'">' + item._source.title + '</a></h4><p>'+notes+'...</p><span class="comment">Last accessed '+lastCrawled+' • <a href="'+catalogUrl+'">'+filesCount+' files</a></span></li>');

        });

      }

    });

  });

</script>
