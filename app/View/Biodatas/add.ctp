<!-- File: /app/View/Biodatas/add.ctp -->
<h1><?php echo _("Add Biodata")?></h1>
<?php
	echo $this->Form->create("Biodata");
	echo $this->Form->input("Account.username", array("label" => "Username"));
	echo $this->Form->input("Account.password", array("label" => "Password"));
	echo $this->Form->input("nama", array("label" => "Nama"));
	echo $this->Form->input("alamat", array("rows" => "5"));
	echo $this->Form->end(_("Add Post"));
?>