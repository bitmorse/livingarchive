<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div id="content__">
    <div id="content_">

        <!-- end right panel -->
      <div class="row">
        <div class="span9 content-outer">

        	<div id="content">
            <h2>Visualisations</h2>
            <ul class="visualisations">
            <?php 
              foreach ($visualisations as $visualisation) {
                echo '
                <li>
                  <a href="/visualisations/show/'.$visualisation['Visualisation']['_id'].'">
                    <img src="/i.php?src=files/visualisations/'.$visualisation['Visualisation']['image'].'&w=200&h=150" />
                    <span>'.$visualisation['Visualisation']['title'].'</span>
                  </a>
                </li>';
              }
            ?>
            </ul>
            
          </div>

        </div>
        <div class="span3 sidebar-outer">
          <div id="sidebar">
            <ul class="widget-list">
              <primarysidebar>
                <a href="/visualisations/add" class="btn btn-success btn-large" style="color:white">Add Your Own</a>
              </primarysidebar>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
