<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/06/14
 * Time: 12:13
 */
if(current_user_can('create_users')){
	migration();
}
