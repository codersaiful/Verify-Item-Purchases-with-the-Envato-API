<?php

/**
 * Set your username and API to functions.php file. To get API key: https://codecanyon.net/user/[your_username]/api_keys/edit 
 * If you Themeforest user, than replace codecanyon to themeforest
 * 
 * This is final file, You can first check with test.php file. And follow Instruction
 * Remember, You have to configure your user name and API inside of get_purchasecode_output(), which is available
 * in functions.php file. Please check this file first.
 */

$output = $inserted_purchase_code = $submission = $message = false; //all Default output will be false.
$border_color = false;
if(isset($_POST['purchase_code']) && isset($_POST['verify'])){
    $submission = true;
    if(!empty($_POST['purchase_code'])){    
        $inserted_purchase_code = $_POST['purchase_code'];
        //Including function, u can use only 'functions.php' too.
        include_once str_replace('\\', '/',__DIR__) . '/functions.php';
        $customer_purchase_code = $inserted_purchase_code;//$_POST['purchase_code'];
        $output = get_purchasecode_output($customer_purchase_code);
        $message = ( !$output ? "Invalid Purchase Code" : false);
        $border_color = ( !$output ? "#d00" : '#00c800');
    }else{
        $border_color = 'red';
        $message = "Empty Submission";
    }
    
}

?>
<html>
    <head>
        <title>Verify Item Purchases with the Envato API</title>
        <style>h1,h2,h3,h4,h5,h6{padding: 0;margin:0;}button{border: 1px solid #ddd;background: #e7e7e729;padding: 5px 10px;font-size: 20px;margin: 4px 0;font-weight: bold;}</style>
    </head>
    <body style="font-size: 130%;">
        <h1>Verify Item Purchases with the Envato API</h1>
        <form action="" method="POST">
            <input value="<?php echo $inserted_purchase_code; ?>" type="text" name="purchase_code" placeholder="Insert Purchase Code Here" style="font-size: 120%;width: 100%;border: 1px solid <?php echo ($border_color ? $border_color : '#aaa'); ?>;padding: 1px 3px;"><br>
            <button type="reset">Reset</button>
            <button type="submit" name="verify">Verify</button>
        </form>
        
        <?php if($submission): ?>
        <div style="border: 1px solid #ddd;padding: 10px;">
           <?php
           if($output){
               echo '<h3 style="color: #00c800;">Purchase Code verified</h3>';
               echo '<h4>Details:</h4>';
               foreach($output as $key=>$value){
                   echo "<b>{$key}:</b> {$value}<br>";
               }
               
               /**
                * Displaying Support Limit
                */
               $supported_until = strtotime($output['supported_until']);
               $support_time_limit = $supported_until - time();
               if($support_time_limit > 0){
                   echo '<h2 style="color: #00c800;">Available Support till: ' . secondsToTime($support_time_limit) . '</h2>';
               }else{
                   echo '<h3 style="color: #a00;">No Support Available for this User.</h3>';
                   echo '<h2> Last Support Date was: ';
                   echo date('D d/m/Y');
                   echo ' <small>d/m/y</small></h2>';
               }
               
           }else{
               echo "<h1 style='color: #d00;'>{$message}</h1>";
           }
           ?> 
        </div>
        <?php endif; ?>
    </body>
</html>






