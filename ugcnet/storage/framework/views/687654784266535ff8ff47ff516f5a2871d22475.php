<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 20px; font-family:Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; width: 100%; background-color: #fff; border:1px solid #ccc;">
    <tr>
       
		<td  align="left" style="padding-left: 70px; padding-right: 20px;padding-top: 20px;">
            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo asset('public/frontend/images/logo.png'); ?>" style="width:100%; max-width:200px; border-radius: 5px" alt=""></a>        
        </td>
		
    </tr>
    <tr>
        <td colspan="3" style=" vertical-align: top; padding: 20px; height: 400px">
            <table align="center" style="width: 90%; background-color: #FFF; ">                
                <tr>
                    <td style="padding:10px;">
				    <?php echo $__env->yieldContent('content'); ?>                    
                    </td>
                </tr>
            </table>        
        </td>
    </tr>
	
    </table>
<?php /**PATH /home/teachinns/public_html/resources/views/frontend/emails/template.blade.php ENDPATH**/ ?>