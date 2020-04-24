<?php if ($lastPage > 1) :?>
	<nav class="col-md-12 wrap-pagination">
		<ul class="pagination">
			
			<?php if ($currentPage != $firstPage) : ?>
				<li class="page-item">
					<a class="page-link" href="?p=<?php echo $firstPage ?>" tabindex="-1">
						<span aria-hidden="true">First</span>
					</a>
				</li>
			<?php endif; ?>
			
			<?php if ($currentPage >= 2) : ?>
				<li class="page-item"><a class="page-link" href="?p=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
			<?php endif; ?>
			
			<li class="page-item active"><a class="page-link" href="?p=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
			
			<?php if ($currentPage != $lastPage) : ?>
				<li class="page-item"><a class="page-link" href="?p=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
				<li class="page-item">
					<a class="page-link" href="?p=<?php echo $lastPage ?>">
						<span aria-hidden="true">Last</span>
					</a>
				</li>
			<?php endif; ?>
			
		</ul>
	</nav>
<?php endif;?>