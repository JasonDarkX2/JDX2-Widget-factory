/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){ 
    jQuery('input[type="range"]').on("input", function(){jQuery(this).next().html(this.value)}) ;
    
    //alert('here');
    })
