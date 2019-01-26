feather.replace()

$(document).ready(function() {

/*     var adminNavLinks =  $('.nav-link-collapse');

    adminNavLinks.on('click', function() {
    
        $('.collapse').collapse('hide');
    
    }) */


    $('.admin-table .link').on('click', function() {
        
        window.location.href = $(this).find('a').attr('href');

    });





    $('.sidebar .collapse-item').each(function() {
      
       if(window.location.href.indexOf(this.href) > -1) $(this).closest('.collapse').prev().trigger('click');

    });

    $('#select-all').on('click', function() {

        var chck = this.checked ? true : false;
     
       
        $('.destroy').prop('checked', chck);

    });

    $('#destroy-btn').on('click', function() {
         
        $('.admin-table').closest('form').submit();
 
    });
 
    


});



/* Get url parameters */

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

/*Get a random integer between two values*/

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
}
