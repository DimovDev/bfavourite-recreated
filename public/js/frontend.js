$(document).ready(function(){let e={placement:"top-start",positionFixed:!0,modifiers:{offset:{enabled:!0,offset:40},flip:{enabled:!1}}};$("#interests-link").on("mouseover mouseout",e=>{let i=$("#popper-interests");i.css("visibility","hidden"==i.css("visibility")?"visible":"hidden")}),$("#projects-link").on("mouseover mouseout",e=>{let i=$("#popper-projects");i.css("visibility","hidden"==i.css("visibility")?"visible":"hidden")}),$("#techs-link").on("mouseover mouseout",e=>{let i=$("#popper-techs");i.css("visibility","hidden"==i.css("visibility")?"visible":"hidden")}),$("#notes-link").on("mouseover mouseout",e=>{let i=$("#popper-notes");i.css("visibility","hidden"==i.css("visibility")?"visible":"hidden")}),$(".header-bar-avatar").on("mouseover mouseout",e=>{let i=$("#popper-avatar");i.css("visibility","hidden"==i.css("visibility")?"visible":"hidden")});new popper($("#interests-link")[0],$("#popper-interests")[0],e);new popper($("#projects-link")[0],$("#popper-projects")[0],e),new popper($("#techs-link")[0],$("#popper-techs")[0],e),new popper($("#notes-link")[0],$("#popper-notes")[0],e),e.modifiers.offset.offset=100,new popper($(".header-bar-avatar")[0],$("#popper-avatar")[0],e),$("#destroy-btn").on("click",function(){$(".admin-table").closest("form").submit()}),$("#select-all").on("click",function(){$(".admin-table .destroy").prop("checked",this.checked)}),$('.admin-table [type="checkbox"]').on("click",e=>{let i=$("#destroy-btn");i.hide(),e.target.checked?i.show():$('.admin-table [type="checkbox"]').each((e,t)=>{t.checked&&i.show()})});let i=window.location.href;if(-1==i.indexOf("edit")&&-1==i.indexOf("create"))return;var t=new MediaLibField($,"photo_id");new MediaLibField($,"icon_id"),new PillField($,{field:"tags",source:"/admin/tags/auto"}),new PillField($,{field:"asset_id",source:"/admin/assets/auto"}).makeSingle(),$("#published_at").datepicker({changeMonth:!0,changeYear:!0,dateFormat:"yy-mm-dd",constrainInput:!1}),$("textarea.tinymce-light").tinymce({theme:"silver",plugins:"code link spellchecker table wordcount advlist lists emoticons codesample",toolbar:"bold italic strikethrough | link emoticons codesample blockquote | numlist bullist outdent indent  | code removeformat",emoticons_database_url:"/js/tinymce/emojis.js",image_advtab:!0,height:240,convert_urls:!1,menubar:!1}),$("textarea.tinymce").tinymce({theme:"silver",plugins:"code hr link image imagetools media spellchecker table template wordcount pagebreak anchor advlist lists spellchecker emoticons codesample",toolbar:"formatselect | bold italic strikethrough forecolor backcolor | link image emoticons | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat",emoticons_database_url:"/js/tinymce/emojis.js",image_advtab:!0,height:480,convert_urls:!1,file_picker_types:"image",file_picker_callback:function(e,i,t){let s=new MediaLib($);s.showSizes(),s.open(),s.onFinish(i=>{e(i.url),s.close()})}}),$('[name="meta[link_url]"]').autocomplete({source:"/admin/assets/auto?types=project,post",minLength:3,select:(e,i)=>($('[name="meta[link_url]"]').val(i.item.url),!1)});let s=$(".link_url_fetch"),l=$('[name="meta[link_url]"]');s.on("click",e=>{l.removeClass(["is-valid","is-invalid"]),s.find(".spinner-border").css("display","inline-block"),s.prop("disabled",!0);let i=new FormData;i.set("link_url",l.val()),i.set("_method","POST"),$.ajax({url:"/admin/links/opengraph",type:"POST",data:i,contentType:!1,cache:!1,processData:!1,headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}).done(e=>{s.prop("disabled",!1),s.find(".spinner-border").hide(),l.addClass("is-valid"),e.photo&&(t.destroy(),t.load([e.photo])),e.message&&l.closest(".form-group").find(".valid-feedback").html(e.message),e.title&&$('[name="meta[link_title]"]').val(e.title),e.publisher&&$('[name="meta[publisher]"]').val(e.publisher),e.link_desc&&$('[name="meta[link_desc]"]').val(e.link_desc)}).fail(e=>{console.log(e.responseJSON.message);let i=e.responseJSON.message||!1;s.prop("disabled",!1),s.find(".spinner-border").hide(),i&&s.closest(".form-group").find(".invalid-feedback").html(i),l.addClass("is-invalid")})})});class PillField{constructor(e,i){this.items=[],this.$=e,this.field=i.field,this.source=i.source,this.multiple=!0,this.hiddenField=this.$(`<input type="hidden" name="${this.field}" value="" />`),this.fieldDom=this.$("form #"+this.field),this.fieldDom.after(this.hiddenField),this.load(),this.fieldDom.autocomplete({source:this.source,minLength:3,select:(e,i)=>{let t=this.push(i.item);return e.target.value="",t&&(this.hiddenField.val(JSON.stringify(this.items)),this.fieldDom.after(t),this.multiple||this.fieldDom.prop("disabled",!0)),!1}})}makeSingle(){return this.multiple=!1,this.items.length>0&&this.fieldDom.prop("disabled",!0),this}load(){let e=this.fieldDom.attr("data-pillfield");try{(e=JSON.parse(e))&&e.length>0&&e.map(e=>{let i=this.push(e);this.hiddenField.val(JSON.stringify(this.items)),this.fieldDom.after(i),this.multiple||this.fieldDom.prop("disabled",!0)})}catch(e){}}push(e){if(e.id&&e.value&&!this.items.find(i=>i.id==e.id))return this.items.push(e),this.prepare(e)}prepare(e){let i=this.$(`<div class="badge badge-pill badge-primary p-2 m-1">\n                           ${e.value} <span> X</span>\n                          </div>`);return i.on("click",t=>{i.remove(),this.items=this.items.filter(i=>i.id!=e.id),this.hiddenField.val(JSON.stringify(this.items)),this.multiple||this.fieldDom.prop("disabled",!1)}),i}}
