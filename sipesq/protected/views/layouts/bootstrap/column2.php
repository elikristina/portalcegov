<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

      <div class="row-fluid">    

      	 <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Operações</li>
              <li class="active"><a href="#">Link</a></li>
              <?php 
				$this->widget('zii.widgets.CMenu', array(
							'items'=>$this->menu,
							'htmlOptions'=>array('class'=>'operations'),
						));
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->  
        <div class="span9">	
			<div id="content">
				<div class="row-fluid">
					<?php echo $content; ?>
				</div>
			</div><!-- content -->
		</div>
	</div>

<?php $this->endContent(); ?>