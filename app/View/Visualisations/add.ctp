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
            <h2>Present your visualisation</h2>

            <p><br /></p>

            <?php echo $this->Form->create('Visualisation', array('type' => 'file')); ?>
            <?php echo $this->Form->input('title');  ?>
            <?php echo $this->Form->input('description', array('type'=>'textarea'));  ?>
            <?php echo $this->Form->input('link');  ?>
            <?php echo $this->Form->input('image', array('type'=>'file', 'label'=>'Image (only JPG, GIF or PNG)'));  ?>
          	<?php echo $this->Form->end('Add'); ?>
          </div>

        </div>
        <div class="span3 sidebar-outer">
          <div id="sidebar">
            <ul class="widget-list">
              <primarysidebar>



              </primarysidebar>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
