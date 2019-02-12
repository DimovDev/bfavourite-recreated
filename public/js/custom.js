

$(document).ready(function() {

    feather.replace()

    $('#destroy-btn').on('click', function(){
       
        $('.admin-table').closest('form').submit();

    });

    $('#select-all').on('click', function(){
            

       $('.admin-table .destroy').prop('checked', this.checked);

    });

     new MediaLibField($, 'photo');
     new MediaLibField($, 'icon');
     
     new PillField($, {field: 'categories',
                       source: '/admin/categories/auto'});
  
    $('textarea.tinymce').tinymce({theme: 'silver',
                                   plugins: 'code hr link image imagetools media spellchecker table template wordcount pagebreak anchor advlist lists spellchecker emoticons',
                                   toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link image emoticons | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                                   emoticons_database_url: '/js/tinymce/emojis.js',
                                   image_advtab: true,
                                   file_picker_types: 'image',
                                   file_picker_callback: function(callback, value, meta) {
                

                                   },

                                  });

});

class PillField {

    constructor(jQuery, options) {
      
      this.items = [];
      this.$ = jQuery;
      this.field = options.field;
      this.source = options.source;

      this.hiddenField = this.$(`<input type="hidden" name="${this.field}" value="" />`);
      this.fieldDom = this.$('#'+this.field);

      this.fieldDom.after(this.hiddenField);

      this.load();


      this.fieldDom.autocomplete({
        source: this.source,
        minLength: 3,

        select: (event, ui) => {

            let pill = this.push(ui.item);
            event.target.value = '';

          if(pill) {  
           this.hiddenField.val(JSON.stringify(this.items));
           this.fieldDom.after(pill);
     
          }

          return false;

        }

      });

    }

    load() {
       
      let items = this.fieldDom.attr('data-pillfield');
      
      try {
        
        items = JSON.parse(items);
        
        if(items && items.length > 0) {
          
            items.map(item => {
              
             let pill = this.push(item)

             this.hiddenField.val(JSON.stringify(this.items));
             this.fieldDom.after(pill);
              
            });

        }

      } catch (er) {


      }

    }

    push (item) {
     
      if(item.id && item.value) {
      
       if(!this.items.find(archived => archived.id == item.id)) {
    
        this.items.push(item);

        return this.prepare(item);

       }


      }

    }
     
    prepare(item) {

      let pill = this.$(`<div class="badge badge-pill badge-primary p-2 m-1">
                          ${item.value} <span> X</span>
                         </div>`);


       pill.on('click', ev => {

           pill.remove();
           this.items = this.items.filter(archived => archived.id != item.id);
           this.hiddenField.val(JSON.stringify(this.items));

       });       
       
       return pill;

    }

}