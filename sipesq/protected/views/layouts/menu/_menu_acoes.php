<ul class="nav pull-right">
	<li class="dropdown " id="op-menu-top"><a class="dropdown-toggle"
		data-toggle="dropdown" href="#"><i class="icon-reorder icon-white"></i>
			Menu<b class="caret"></b>
	</a> <?php
$this->widget('zii.widgets.CMenu', array(
		'items'=>$this->menu,
		'encodeLabel'=>false,
		'activeCssClass'=>'active',
		'htmlOptions'=>array('class'=>'dropdown-menu'),
));
?></li>
</ul>
