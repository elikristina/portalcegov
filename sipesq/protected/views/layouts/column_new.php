<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/docs.css')?>
<?php $this->beginContent('//layouts/main'); ?>
<?php /*
<div class="row-fluid">
	<div class="span12" >
		<div class="sidebar-nav menu">
            <ul class="nav nav-list pull-right">
              <li class="dropdown" id="op-menu">
                <a class="dropdown-toggle btn btn-small" data-toggle="dropdown" href="#"><i class="icon-wrench"></i> <b>Operações</b> <b class="caret"></b></a>
					  	<?php	  
						$this->widget('zii.widgets.CMenu', array(
							'items'=>$this->menu,
							'encodeLabel'=>false,
							'activeCssClass'=>'active',
							'htmlOptions'=>array('class'=>'dropdown-menu'),
						));
						?>
              </li>
            
            </ul>       
		
          </div>        
	</div>
</div>
*/?>
<div class="row-fluid">
	<div class="span12">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>	
</div>
<?php $this->endContent(); ?>