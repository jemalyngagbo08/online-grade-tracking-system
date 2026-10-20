<?php
$escape = static function ($value) {
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$totalSearchResults = 0;
foreach ($searchResults as $results) {
	$totalSearchResults += count($results);
}
?>
<section class="admin-account-page admin-search-page">
	<div class="admin-account-heading">
		<p class="admin-account-eyebrow">System search</p>
		<h1>Search results</h1>
		<?php if ($query !== '') { ?>
			<p><?php echo number_format($totalSearchResults); ?> results for “<?php echo $escape($query); ?>”</p>
		<?php } else { ?>
			<p>Enter a name, ID, email, or department in the search field above.</p>
		<?php } ?>
	</div>

	<?php if ($query !== '' && $totalSearchResults === 0) { ?>
		<div class="admin-account-card">
			<p class="admin-search-empty">No matching records were found. Try a different search term.</p>
		</div>
	<?php } ?>

	<?php foreach ($searchResults as $category => $results) {
		if (count($results) === 0) {
			continue;
		}
	?>
		<section class="admin-account-card admin-search-group" aria-label="<?php echo $escape($category); ?>">
			<h2><?php echo $escape($category); ?></h2>
			<div class="admin-search-results">
				<?php foreach ($results as $result) { ?>
					<a class="admin-search-result" href="<?php echo WEB_ROOT . 'admin/' . $escape($result->url); ?>">
						<span class="admin-search-result-copy">
							<strong><?php echo $escape($result->record_name); ?></strong>
							<small><?php echo $escape($result->record_detail); ?></small>
						</span>
						<span class="admin-search-result-id">#<?php echo $escape($result->record_id); ?></span>
					</a>
				<?php } ?>
			</div>
		</section>
	<?php } ?>
</section>
