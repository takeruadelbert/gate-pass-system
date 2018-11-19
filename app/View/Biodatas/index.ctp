<!-- File: /app/View/Biodatas/index.ctp (edit links added) -->
<h1><?php echo _("Biodata")?></h1>
<p>
	<?php echo $this->Html->link("Add Post", array("action" => "add")); ?>
</p>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Username</th>
		<th>Action</th>
		<th>Created</th>
	</tr>
	<!-- Here"s where we loop through our $posts array, printing out post info -->
	<?php foreach ($data as $item): ?>
	<tr>
		<td><?php echo $item["Biodata"]["id"]; ?></td>
		<td><?php echo $this->Html->link($item["Biodata"]["nama"],array("action" => "view", $item["Biodata"]["id"]));?></td>
		<td><?php echo $this->Html->link($item["Account"]["username"],array("action" => "view", $item["Account"]["id"]))?></td>
		<td>
			<?php echo $this->Form->postLink("Delete",array("action" => "delete", $item["Biodata"]["id"]),array("confirm" => "Are you sure?"));?>
			<?php echo $this->Html->link("Edit",array("action" => "edit", $item["Biodata"]["id"]));?>
		</td>
		<td><?php echo $item["Biodata"]["created"]; ?></td>
	</tr>
	<?php endforeach; ?>
</table>