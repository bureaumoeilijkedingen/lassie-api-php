<?php

  /**-----------------------------------------------------------------------------------------------------------**/
  /**                                                INITIALIZE                                                 **/
  /**-----------------------------------------------------------------------------------------------------------**/

  // enable errors
  error_reporting(-1);
  ini_set('display_errors', 1);

  // set timezone
  date_default_timezone_set('Europe/Amsterdam');

  // include the Lassie API
  require_once 'LassieApi.php';

  /**-----------------------------------------------------------------------------------------------------------**/
  /**                                               MODEL EXAMPLE                                               **/
  /**-----------------------------------------------------------------------------------------------------------**/

  // create a new Lassie API
  $lassie_model_api = new LassieApi(array(
    'host' => 'http://experimental.lassie.cloud/',
    'api_key' => '9a215e54e7dad7b0587b98f6d49e63a8',
    'api_secret' => '8de1dd95296397174749a87defde8638',
  ));

  // get groups test
  $group_arr = $lassie_model_api->get('model', array(
    'name' => 'group_model',
    'method' => 'get_groups',
    'format' => 'json',
  ));

  // debug
  echo 'MODEL API: <br/>';
  var_dump($group_arr);
  echo '<br/><br/>';

  /**-----------------------------------------------------------------------------------------------------------**/
  /**                                            TRANSACTION EXAMPLE                                            **/
  /**-----------------------------------------------------------------------------------------------------------**/

  // create a new Lassie API
  /*$lassie_transaction_api = new LassieApi(array(
    'host' => 'http://lassie.intermate.nl/',
    'api_key' => 'f83d4c12698320231c40f1d423076c86',
    'api_secret' => '3b94635a4f2016504612ee97581e5a22',
  ));

  // create a new Lassie API
  $lassie_transaction_api = new LassieApi(array(
    'host' => 'http://188.166.115.34/dev/',
    'api_key' => '9b7360fa7aeedf2e012ec90e035e1d3a',
    'api_secret' => 'a9d42e7b742622430e8d13e162c7eff5',
  ));*/

  // create a new Lassie API
  $lassie_transaction_api = new LassieApi(array(
    'host' => 'http://experimental.lassie.cloud/',
    'api_key' => 'f0fb42a75ede3bc4384d3fffae30dd5f',
    'api_secret' => '6b292b5ccf30f27d6c6a35e7148d7b06',
  ));

  // get transaction types test
  $transaction_type_arr = $lassie_transaction_api->get('transaction_types', array());

  // upgrade account
  $request_id = md5(microtime() + rand(0, 1000000));
  $post_upgrade_account_result = $lassie_transaction_api->post('transaction_upgrade_account', array(
    'transaction_type_id' => 3,
    'transaction_account_id' => 1,
    'transaction_account_name' => 'first_balance',
    'transaction_upgrade_delta_balance' => 10,
    'transaction_request_id' => $request_id,
  ));

  // post transaction test
  $request_id = md5(microtime() + rand(0, 1000000));
  $product_arr = array(
    array(
      'quantity' => 1,
      'product_id' => 1,
      'product_table_name' => 'shop_products',
    ),
  );
  $post_transaction_result = $lassie_transaction_api->post('transaction', array(
    'transaction_type_id' => 4,
    'transaction_source_id' => '0220593602', // 04538902da3280
    'transaction_products' => json_encode($product_arr),
    'transaction_request_id' => $request_id
  ));
  $get_transaction_result = $lassie_transaction_api->get('transaction_account', array(
    'transaction_account_name' => 'first_balance',
    'transaction_account_id' => '04538902da3280',
  ));

  // debug
  echo 'TRANSACTION API: <br/>';
  var_dump($transaction_type_arr);
  echo '<br/><br/>';
  echo 'UPGRADE: <br/>';
  var_dump($post_upgrade_account_result);
  echo '<br/><br/>';
  echo 'POST TRANSACTION: <br/>';
  var_dump($post_transaction_result);
  echo '<br/><br/>';
  echo 'GET TRANSACTION: <br/>';
  var_dump($get_transaction_result);

  // exit
  echo '<br/><br/>';
  echo 'end of test';
  exit;
?>
