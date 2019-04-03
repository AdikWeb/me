<div class="accord">
	<div class="head" data-accordionid="ac_<?= $this->id ?>" >
		<div class="title"><?= $this->title ?></div>
		<div class="icon">
			<!-- <img src="img/"> -->
		</div>
	</div>
	<div class="content" id="ac_<?= $this->id ?>">
		
		<?php if (is_array($this->content)): ?>
			
			<ul>
				<?php foreach ($this->content as $text): ?>
					<li><?= $text ?></li>
				<?php endforeach; ?>
			</ul>

		<?php else: ?>
			<p>
				<?= $this->content ?>
			</p>

		<?php endif ?>

	</div>
</div>

