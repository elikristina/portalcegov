<?php 

$baseurl = Yii::app()->request->baseUrl;
$notfurl = $this->createUrl('/notificacao/render', array('id'=>Yii::app()->user->getId()));
Yii::app()->clientScript->registerScript('notif',"
        var template = '{$baseurl}';
        var notf = new EJS({url: '{$baseurl}/js/templates/_notificacoes.ejs'});
        
        setInterval(function(){
            $.get('{$notfurl}',{json: true} ,function(data){ 
              $('#notificacoes').html(notf.render(data));
            }, 'json');
        }, 15000); 
"); 


if(!isset($notificacoes)){
  $notificacoes = Notificacao::getNotifications(Yii::app()->user->getId());
}

?>

<li class="dropdown" id="notificacoes">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notificações
    <?php if($notificacoes['count_new'] > 0): ?>
    <span class="badge badge-warning"><?php echo $notificacoes['count_new'] ?></span><b class="caret"></b>
    <?php endif; ?>
  </a>
  <ul class="dropdown-menu">
  <?php foreach($notificacoes['items'] as $ntf): ?>

  	<li class="ntf <?php echo ($ntf['read'] == true) ? '' : 'notif-new'; ?>">
      <a href="<?php echo $ntf['notf_url'] ?>">
      <div class="notif-content">
         <?php echo $ntf['message']; ?>
      </div>
      </a>
    </li>
  <?php endforeach; ?>
    <li class="divider"></li>
    <li>
      <?php echo CHtml::link('<b>Mais notificações...</b>', array('/notificacao'), array('align'=>'center')); ?>
    </li>
  </ul>
</li>
