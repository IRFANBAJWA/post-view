<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user input for visit
 *
 * @author irfan.manzoor
 */
class user_visit_form_short_code {
         
	public function __construct(){
            
            add_shortcode( 'uservisit', array( $this, 'user_visit' ) );            
	}
        
        public function user_visit($atts, $content) {
            ob_start();    
            ?>
            <style>
            .name-block,.email-blcok,.term-block{
                width:100%;
                margin-bottom:20px;
            }
               .name-block input,.email-blcok input{
                    font-size:14px;
                    padding:10px ;
                }
            .term-block input{
                margin-right: 10px;
            }
            .hide { display:none !important; }
            .message-top{
                text-align:center;
                display:block;
                margin-bottom:10px;
            }
            </style>
        <div class="col-sm-12 main__header">
        <form class="ajax-auth"  id="visitform"  method="post" enctype="multipart/form-data">
         <div class="message-top">
         <p class="status"></p>
         </div>
         <br>           
        <div class="name-block">
        <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required/>
        </div>
        <div class="email-blcok">
            <span class="error emailexist"></span>
            <input type="text" class="form-control uemail" id="useremail" autocomplete="off"  name="useremail" placeholder="User Email" required/>
        </div>
        <div class="term-block">
        <input class="termc" type="checkbox" name="term" value="1" required><a href="#">Term & condition</a><br>
        </div>
         <div class="submite-block">
        <input type="submit" class="btn btn-primary" value="SUBMIT" />
        </div>
        </form>
        <div class="clearfix"></div>
       </div>
     
     
        <?php
        $html = ob_get_clean();
    
        return apply_filters('signup', $html . do_shortcode($content));
    }

  
    
}
new user_visit_form_short_code;
?>
