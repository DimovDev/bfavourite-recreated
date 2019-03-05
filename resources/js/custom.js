
$(document).ready(function() {

    let popper_config = {placement: 'top-start',
                         positionFixed: true,
                         modifiers: 
                           {offset: 
                             {enabled: true,
                              offset: 40 },
                            flip:
                              {enabled: false}}};
     
     
     $('#interests-link').on('mouseover mouseout',  ev => {
        
       let container = $('#popper-interests') 
       container.css('visibility', container.css('visibility') == 'hidden' ? 'visible' : 'hidden');
 
     });
 
 
     $('#projects-link').on('mouseover mouseout',  ev => {
       let container = $('#popper-projects') 
       container.css('visibility', container.css('visibility') == 'hidden' ? 'visible' : 'hidden');
 
     });
 
     $('#techs-link').on('mouseover mouseout',  ev => {
           
       let container = $('#popper-techs') 
       container.css('visibility', container.css('visibility') == 'hidden' ? 'visible' : 'hidden');
 
     });
 
     $('#notes-link').on('mouseover mouseout',  ev => {
           
       let container = $('#popper-notes') 
       container.css('visibility', container.css('visibility') == 'hidden' ? 'visible' : 'hidden');
 
     });
 
 
     $('.header-bar-avatar').on('mouseover mouseout',  ev => {
           
       let container = $('#popper-avatar') 
       container.css('visibility', container.css('visibility') == 'hidden' ? 'visible' : 'hidden');
 
     });
 
    
    let p = new popper($('#interests-link')[0], $('#popper-interests')[0], popper_config);
 
 
     new popper($('#projects-link')[0], $('#popper-projects')[0], popper_config);
     new popper($('#techs-link')[0], $('#popper-techs')[0], popper_config);
     new popper($('#notes-link')[0], $('#popper-notes')[0], popper_config);
     
     popper_config.modifiers.offset.offset = 100;
     new popper($('.header-bar-avatar')[0], $('#popper-avatar')[0], popper_config);
  
 
     $('#destroy-btn').on('click', function(){
        
         $('.admin-table').closest('form').submit();
 
     });
 
     $('#select-all').on('click', function(){
             
 
        $('.admin-table .destroy').prop('checked', this.checked);
 
     });
 
     $('.admin-table [type="checkbox"]').on('click', ev => {
         let btn = $('#destroy-btn');
         btn.hide();
        
         if(ev.target.checked) {
         
           btn.show();
 
         }else {
           
           $('.admin-table [type="checkbox"]').each((index, item) => {
             
              if(item.checked) btn.show();
              return;
           });
 
         }  
 
       
 
     });
       
      let url = window.location.href;

      if(url.indexOf('edit') == -1 && url.indexOf('create') == -1) return;
 
      var photo = new MediaLibField($, 'photo_id');
      new MediaLibField($, 'icon_id');
      
      new PillField($, {field: 'tags',
                        source: '/admin/tags/auto'});
 
      new PillField($, {field: 'asset_id',
                        source: '/admin/assets/auto'}).makeSingle();                  
 
     $( "#published_at" ).datepicker({
       changeMonth: true,
       changeYear: true,
       dateFormat: 'yy-mm-dd'
      });                   
   
     $('textarea.tinymce-light').tinymce({theme: 'silver',
                                    plugins: 'code link spellchecker table wordcount advlist lists emoticons codesample',
                                    toolbar: 'bold italic strikethrough | link emoticons codesample blockquote | numlist bullist outdent indent  | code removeformat',
                                    emoticons_database_url: '/js/tinymce/emojis.js',
                                    image_advtab: true,
                                    height: 240,
                                    convert_urls: false,
                                    menubar:false, 
 
                                   });
 
     $('textarea.tinymce').tinymce({theme: 'silver',
     plugins: 'code hr link image imagetools media spellchecker table template wordcount pagebreak anchor advlist lists spellchecker emoticons codesample',
     toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link image emoticons | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
     emoticons_database_url: '/js/tinymce/emojis.js',
     image_advtab: true,
     height: 480,
     convert_urls: false,
     file_picker_types: 'image',
     file_picker_callback: function(callback, value, meta) {
 
           let mediaLib = new MediaLib($);
           mediaLib.showSizes();
           mediaLib.open();
           mediaLib.onFinish(item => { callback(item.url);
                                       mediaLib.close();
                                       });
     },
 
     });   
   
     $('[name="meta[link_url]"]').autocomplete({
       source: '/admin/assets/auto?types=project,post',
       minLength: 3,
 
       select: (event, ui) => {
 
         $('[name="meta[link_url]"]').val(ui.item.url);
         return false;
 
       }
 
     });
 
     
     let fetch = $('.link_url_fetch');
     let link = $('[name="meta[link_url]"]')
 
     fetch.on('click', ev => {
 
         
         link.removeClass(['is-valid', 'is-invalid']);
         fetch.find('.spinner-border').css('display', 'inline-block');
         fetch.prop('disabled', true);
 
     
         let fd = new FormData();
         fd.set('link_url',link.val());
         fd.set('_method', 'POST');
         
         $.ajax({url: '/admin/links/opengraph',
                      type: 'POST',
                      data: fd,
                      contentType: false,
                      cache: false,
                      processData: false,
                      headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }}).done(response => {
                        
                         fetch.prop('disabled', false);
                         fetch.find('.spinner-border').hide();
                         link.addClass('is-valid');
                       
                         if(response.photo) {
                           photo.destroy();
                           photo.load([response.photo]);
                         }
                       
                         if(response.message) link.closest('.form-group').find('.valid-feedback').html(response.message);
                         if(response.title) $('[name="meta[link_title]"]').val(response.title);
                         if(response.publisher) $('[name="meta[publisher]"]').val(response.publisher);
                         if(response.link_desc) $('[name="meta[link_desc]"]').val(response.link_desc);
       
 
                      }).fail(response => {
                       console.log(response.responseJSON.message);
                       let msg = response.responseJSON.message || false;
 
                       fetch.prop('disabled', false);
                       fetch.find('.spinner-border').hide();
 
                       if(msg) fetch.closest('.form-group').find('.invalid-feedback').html(msg)
 
                       link.addClass('is-invalid');
                       
 
 
                      });       
        
 
     });
 
 });
 
 class PillField {
 
     constructor(jQuery, options) {
       
       this.items = [];
       this.$ = jQuery;
       this.field = options.field;
       this.source = options.source;
 
       this.multiple = true;
      
 
       this.hiddenField = this.$(`<input type="hidden" name="${this.field}" value="" />`);
       this.fieldDom = this.$('form #'+this.field);
        
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
            if(!this.multiple) this.fieldDom.prop('disabled', true);
      
           }
 
           return false;
 
         }
 
       });
 
     }
 
     makeSingle() {
 
       this.multiple = false;
       if(this.items.length > 0) this.fieldDom.prop('disabled', true);
       
       return this;
 
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
              if(!this.multiple) this.fieldDom.prop('disabled', true);
               
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
            if(!this.multiple) this.fieldDom.prop('disabled', false);
 
        });       
        
        return pill;
 
     }
 
 }