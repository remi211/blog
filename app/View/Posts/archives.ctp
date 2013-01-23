<?php $this->layout = Configure::read('Site.layout'); ?>

<?php $siteName = (Configure::read('Site.name')); ?>

<?php $this->set("title_for_layout","Publication archives - $siteName"); ?>

		<div class='centered'><h1 style="margin-bottom: 20px;">Publication archives</h1></div>

		<?php echo "<div>".$this->Html->link('Add', array('action' => 'add' ) )."</div>"; ?>
		
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
		
		    <?php foreach ($posts as $post): ?>
		    <?php 
		    $editlink = $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); 
		    $deletelink = $this->Form->postLink(
							"Delete",
							array('action' => 'delete', $post['Post']['id']),
							array('confirm' => 'Are you sure you want to delete this publication?')
							);     
		    ?>
		    
		    <tr>
		        		        
		        <td>
		        <?php echo $this->Html->link($post['Post']['title'], "../posts/view/".$post['Post']['slug']); ?>
		        </td>
		        <td><span class="muted"><?php echo $post['Post']['created']; ?></span></td>
				
		        <td>
					<span class="muted">
					<?php 
					if( $post['Post']['publish'] == 1 ) 
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
		        	} elseif ($post['Post']['user_id'] == $this->Session->read('Auth.User.id')) {
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