# Verify Item Purchases with the Envato API
Verify Item Purchases with the Envato API
````
/**
 * To this file, I have shown you that, How our function will work.
 * Remember, You have to configure your user name and API inside of get_purchasecode_output(), which is available
 * in functions.php file. Please check this file first.
 */
include_once str_replace('\\', '/',__DIR__) . '/functions.php';
$customer_purchase_code = '83f123as-1234-40b5-88aa-aaaaaa6f042d'; // It's just a sample and fake purchase code.
$output = get_purchasecode_output($customer_purchase_code);
var_dump($output);
````
## Outpur Sample
```
Array
(
    [item_name] => Woo Products Table Pro
    [item_id] => 20676867
    [created_at] => Tue Jul 03 00:36:24 +1000 2018
    [buyer] => buyer_username
    [licence] => Regular License
    [supported_until] => Tue Jan 01 16:36:24 +1100 2019
)
```
