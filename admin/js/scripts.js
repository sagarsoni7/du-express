$(document).ready(function(){
     
    // EDITOR CKEDITOR
        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
 
     
      // REST OF THE CODE
 
 
 
    $('#selectAllBoxes').click(function(event){
 
        if(this.checked) {
 
            $('.checkboxes').each(function(){
 
                this.checked = true;
 
            });
 
        } else {
 
 
            $('.checkboxes').each(function(){
 
                this.checked = false;
 
            });
 
 
        }
 
    });
    
    
    var div_box="<div id='load-screen'><div id='loading'></div></div>";
    
    $('body').prepend(div_box);
    $('#load-screen').delay(300).fadeOut(600, function(){
        $(this).remove();
    })
 
});