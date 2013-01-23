<?php $this->layout = Configure::read('Site.layout'); ?>

<?php $siteName = (Configure::read('Site.name')); ?>

<?php $this->set("title_for_layout","Playlist manage - $siteName"); ?>

		<div class='centered'><h1 style="margin-bottom: 20px;">Playlist manage</h1></div>

		<?php echo "<div>".$this->Html->link('Add', array('action' => 'add' ) , array('class'=> 'btn btn-mini btn-success' ) )."</div><br>"; ?>
		
		<?php if ((Configure::read('Site.search')) != 'no') {
			//echo $this->element('search'); 
		} ?>
		
		<table class="table table-striped">
		    <tr>		        
		        <th><?php echo $this->Paginator->sort('title');?></th>
		        <th style="width: 135px;"><?php echo $this->Paginator->sort('created');?></th>
		        <th style="width: 135px;"><?php echo $this->Paginator->sort('publish','Published');?></th>
		        <?php 
		        if ('admin' == $this->Session->read('Auth.User.role')) {
		        	echo ("<th style='width:40px'>Admin.</th>");
		        } elseif ($this->Session->check('Auth.User.id')) {
		        	echo ("<th style='width:40px'>Admin.</th>");
		        } ?>
		    </tr>
		
		    <?php foreach ($playlist as $play): ?>
		    <?php 
		    $editlink = $this->Html->link('Edit', array('action' => 'edit', $play['Playlist']['id'])); 
		    $deletelink = $this->Form->postLink(
							"Delete",
							array('action' => 'delete', $play['Playlist']['id']),
							array('confirm' => 'Are you sure you want to delete this publication?')
							);     
		    ?>
		    
		    <tr>
		        		        
		        <td>
		        <?php echo $this->Html->link($play['Playlist']['title'], "../posts/view/".$play['Playlist']['slug']); ?>
		        </td>
		        <td><span class="muted"><?php echo $play['Playlist']['created']; ?></span></td>
				
		        <td>
					<span class="muted">
					<?php 
					if( $play['Playlist']['publish'] == 1 ) 
						echo "On";
					else
						echo "Off";
					?>
					</span>
				</td>
		        
				<?php if ('admin' == $this->Session->read('Auth.User.role')) {
		        		echo ("<td>
								<div class='btn-group'>								  								  
								  <ul class=''>
									<li>$editlink</li>
									<li>$deletelink</li>
								  </ul>
								</div>
							</td>");
		        	} elseif ($post['Playlist']['user_id'] == $this->Session->read('Auth.User.id')) {
		        		echo("<td><div class='btn-group'>
		        		      <a class='btn btn-mini' href='#'><i class='icon-cog'></i></a>
		        		      <a class='btn btn-mini dropdown-toggle' data-toggle='dropdown' href='#'><span class='caret'></span></a>
		        		      <ul class='dropdown-menu'>
		        		        <li>$editlink</li>
		        		        <li>$deletelink</li>
		        		      </ul>
		        			</div></td>");
		        	} elseif ($this->Session->check('Auth.User.id')) {
		        		echo("<td></td>");
		        } ?>
		    </tr>
		    <?php endforeach; ?>
		
		</table>
		
		<div class='centered'>
		<?php 
		if ($this->Paginator->hasPage(2)) {
			echo $this->Paginator->prev();
			echo (" | ");
		} ?> 
		<?php echo $this->Paginator->numbers(); ?> 
		<?php 
		if ($this->Paginator->hasPage(2)) { 
			echo (" | ");
			echo $this->Paginator->next();
			echo ("<hr>");
		} ?> 
		</div>