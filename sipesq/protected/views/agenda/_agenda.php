<?php $salas = Horario::model()->findAll(array('select'=>'local', 'condition'=>"local != '' ",  'group'=>'local', 'order'=>'local'));?>

<table class="table agenda">
	<thead>
		<tr>
			<th>Turnos/Dias</th>
			<th>Segunda</th>
			<th>Terça</th>
			<th>Quarta</th>
			<th>Quinta</th>
			<th>Sexta</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><p class="turno">Manhã</p></td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'manha' AND dia_semana = 'segunda' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'manha' AND dia_semana = 'terca' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'manha' AND dia_semana = 'quarta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'manha' AND dia_semana = 'quinta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'manha' AND dia_semana = 'sexta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
		</tr>
		<tr>
			<td><p class="turno">Tarde</p></td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'tarde' AND dia_semana = 'segunda' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'tarde' AND dia_semana = 'terca' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'tarde' AND dia_semana = 'quarta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'tarde' AND dia_semana = 'quinta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
			<td>
				<?php foreach($salas as $s):?>
					<?php echo "<p class='sala'>" . $s->local . "</p>";?>
					<?php $pessoas = Horario::model()->with('pessoa')->findAll(array('condition'=>"turno = 'tarde' AND dia_semana = 'sexta' AND local='$s->local' ", 'order'=> 'local, pessoa.nome'))?>
					<?php if (empty($pessoas)):?>
						<?php echo "<p class='sala-pessoa'>-</p>";?>
					<?php else:?>
					<?php foreach($pessoas as $p):?>
						<?php if(!$p->pessoa->isInVacation($p->cod_pessoa)):?>
							<?php echo "<p class='sala-pessoa'>" . $p->pessoa->nome . "</p>"; ?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endforeach;?>
			</td>
		</tr>
	</tbody>
</table>

		
