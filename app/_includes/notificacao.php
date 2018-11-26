<script type="text/javascript">
	swal({
		title: "<?php echo $this->notificacao['title']; ?>",
        text: "<?php echo $this->notificacao['description']; ?>",
        type: "<?php echo $this->notificacao['type']; ?>"

	},function(){
        <?php if(!empty($this->notificacao['location'])){ ?>
        	location.href = "<?=$this->notificacao['location']?>";
        <?php } ?>
    });
</script>