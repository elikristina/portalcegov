<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('/pessoa'),
	$model->nome=>array('/pessoa/view', 'id'=>$model->cod_pessoa),
	'Notificações'

);
?>


<?php 
$baseurl = Yii::app()->request->baseUrl;
$notfurl = $this->createUrl('/notificacao/render', array('id'=>Yii::app()->user->getId()));
Yii::app()->clientScript->registerScript('_getnotif',"
        var template = '{$baseurl}';
        var view = new EJS({url: '{$baseurl}/js/templates/_notif_view.ejs'});
        var curr_offset = 10;
        $('#load-notif').click(function(){
        	console.log('click');

            $.get('{$notfurl}'
            	,	{json: true, offset: curr_offset, limit: 10}
            	,	function(data){      
            		    if(data.items.length > 0){
            		    	$('#notif-list').append(view.render(data));
            		    }else{
            		    	$('#load-notif').remove();
            		    }    
              			
              			curr_offset += 10;
            		}
            	, 'json'
            );

		});

"); 
?>
<div class="view">
	<div class="row-fluid">
		<div class="span12">
			<h3>Notificações 
			 	<?php if($notificacoes['count_new'] > 0):?>
			 	<span class="badge badge-warning"><?php echo $notificacoes['count_new'] ?></span>
			 <?php endif;?>
			</h3>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
				<ul class="unstyled"id="notif-list">
				<?php foreach($notificacoes['items'] as $ntf): ?>
					<li class="ntf <?php echo ($ntf['read'] == true) ? '' : 'notif-new'; ?>" style="margin: 5px;">
				      <a href="<?php echo $ntf['notf_url'] ?>">
				      <div class="notif-content">
				         <?php echo $ntf['message']; ?>
				      </div>
				      </a>
				    </li>
				<?php endforeach; ?>
				</ul>
			<?php echo CHtml::button('Mais Notificações', array('class'=>"btn btn-inverse btn-block", 'id'=>'load-notif')); ?>
		</div>
	</div>
</div>