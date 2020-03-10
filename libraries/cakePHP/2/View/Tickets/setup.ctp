<style>
/*input {
	font-size:140%;
	padding:1%;
	width:80%;
	margin-left:120px;
	
}*/
label {
	position:absolute;
}

</style>


<div id="reset">

    <p><?= __('Please enter the KEY', true); ?></p>
    <form action="" method="post">
        
        <?php echo $this->Form->input('key', array(
            'label' => false
        )); ?>
        
        <div class="submit"><input name="submit" type="submit" name="Lookup KEY"/></div>
    </form>

</div>