/*! For license information please see backend-custom.js.LICENSE.txt */
(()=>{function t(){"use strict";t=function(){return r};var e,r={},o=Object.prototype,a=o.hasOwnProperty,i=Object.defineProperty||function(t,e,n){t[e]=n.value},c="function"==typeof Symbol?Symbol:{},l=c.iterator||"@@iterator",u=c.asyncIterator||"@@asyncIterator",d=c.toStringTag||"@@toStringTag";function s(t,e,n){return Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{s({},"")}catch(e){s=function(t,e,n){return t[e]=n}}function f(t,e,n,r){var o=e&&e.prototype instanceof b?e:b,a=Object.create(o.prototype),c=new I(r||[]);return i(a,"_invoke",{value:T(t,n,c)}),a}function m(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}r.wrap=f;var y="suspendedStart",p="suspendedYield",h="executing",v="completed",g={};function b(){}function w(){}function S(){}var L={};s(L,l,(function(){return this}));var k=Object.getPrototypeOf,q=k&&k(k(O([])));q&&q!==o&&a.call(q,l)&&(L=q);var A=S.prototype=b.prototype=Object.create(L);function E(t){["next","throw","return"].forEach((function(e){s(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){function r(o,i,c,l){var u=m(t[o],t,i);if("throw"!==u.type){var d=u.arg,s=d.value;return s&&"object"==n(s)&&a.call(s,"__await")?e.resolve(s.__await).then((function(t){r("next",t,c,l)}),(function(t){r("throw",t,c,l)})):e.resolve(s).then((function(t){d.value=t,c(d)}),(function(t){return r("throw",t,c,l)}))}l(u.arg)}var o;i(this,"_invoke",{value:function(t,n){function a(){return new e((function(e,o){r(t,n,e,o)}))}return o=o?o.then(a,a):a()}})}function T(t,n,r){var o=y;return function(a,i){if(o===h)throw new Error("Generator is already running");if(o===v){if("throw"===a)throw i;return{value:e,done:!0}}for(r.method=a,r.arg=i;;){var c=r.delegate;if(c){var l=_(c,r);if(l){if(l===g)continue;return l}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(o===y)throw o=v,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);o=h;var u=m(t,n,r);if("normal"===u.type){if(o=r.done?v:p,u.arg===g)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(o=v,r.method="throw",r.arg=u.arg)}}}function _(t,n){var r=n.method,o=t.iterator[r];if(o===e)return n.delegate=null,"throw"===r&&t.iterator.return&&(n.method="return",n.arg=e,_(t,n),"throw"===n.method)||"return"!==r&&(n.method="throw",n.arg=new TypeError("The iterator does not provide a '"+r+"' method")),g;var a=m(o,t.iterator,n.arg);if("throw"===a.type)return n.method="throw",n.arg=a.arg,n.delegate=null,g;var i=a.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,g):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,g)}function $(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function C(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function I(t){this.tryEntries=[{tryLoc:"root"}],t.forEach($,this),this.reset(!0)}function O(t){if(t||""===t){var r=t[l];if(r)return r.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function n(){for(;++o<t.length;)if(a.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return i.next=i}}throw new TypeError(n(t)+" is not iterable")}return w.prototype=S,i(A,"constructor",{value:S,configurable:!0}),i(S,"constructor",{value:w,configurable:!0}),w.displayName=s(S,d,"GeneratorFunction"),r.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===w||"GeneratorFunction"===(e.displayName||e.name))},r.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,S):(t.__proto__=S,s(t,d,"GeneratorFunction")),t.prototype=Object.create(A),t},r.awrap=function(t){return{__await:t}},E(x.prototype),s(x.prototype,u,(function(){return this})),r.AsyncIterator=x,r.async=function(t,e,n,o,a){void 0===a&&(a=Promise);var i=new x(f(t,e,n,o),a);return r.isGeneratorFunction(e)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},E(A),s(A,d,"Generator"),s(A,l,(function(){return this})),s(A,"toString",(function(){return"[object Generator]"})),r.keys=function(t){var e=Object(t),n=[];for(var r in e)n.push(r);return n.reverse(),function t(){for(;n.length;){var r=n.pop();if(r in e)return t.value=r,t.done=!1,t}return t.done=!0,t}},r.values=O,I.prototype={constructor:I,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(C),!t)for(var n in this)"t"===n.charAt(0)&&a.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function r(r,o){return c.type="throw",c.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],c=i.completion;if("root"===i.tryLoc)return r("end");if(i.tryLoc<=this.prev){var l=a.call(i,"catchLoc"),u=a.call(i,"finallyLoc");if(l&&u){if(this.prev<i.catchLoc)return r(i.catchLoc,!0);if(this.prev<i.finallyLoc)return r(i.finallyLoc)}else if(l){if(this.prev<i.catchLoc)return r(i.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return r(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var r=this.tryEntries[n];if(r.tryLoc<=this.prev&&a.call(r,"finallyLoc")&&this.prev<r.finallyLoc){var o=r;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,g):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),g},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),C(n),g}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;C(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:O(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),g}},r}function e(t,e,n,r,o,a,i){try{var c=t[a](i),l=c.value}catch(t){return void n(t)}c.done?e(l):Promise.resolve(l).then(r,o)}function n(t){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},n(t)}!function(){"use strict";"undefined"!==n($.fn.select2)&&($(".select2").select2(),$(".select2-tag").select2({tags:!0})),window.addEventListener("scroll",(function(){var t=document.documentElement.scrollTop,e=document.querySelector(".navs-sticky");null!==e&&(t>=100?e.classList.add("menu-sticky"):e.classList.remove("menu-sticky"))}));var r=[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));("undefined"!==("undefined"==typeof bootstrap?"undefined":n(bootstrap))&&r.map((function(t){return new bootstrap.Popover(t)})),"undefined"!==("undefined"==typeof bootstrap?"undefined":n(bootstrap)))&&(window.tooltipInit=function(){[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((function(t){return new bootstrap.Tooltip(t)}))},tooltipInit(),[].slice.call(document.querySelectorAll('[data-sidebar-toggle="tooltip"]')).map((function(t){return new bootstrap.Tooltip(t)})));var o=document.querySelectorAll('[data-toggle="progress-bar"]');function a(t){return noUiSlider.create(t,{start:[50,2e3],connect:!0,range:{min:0,"10%":[50,50],max:2e3}})}Array.from(o,(function(t){!function(t){var e=t.getAttribute("aria-valuenow");t.style.width="0%",t.style.transition="width 2s","undefined"!==("undefined"==typeof Waypoint?"undefined":n(Waypoint))&&new Waypoint({element:t,handler:function(){setTimeout((function(){t.style.width=e+"%"}),100)},offset:"bottom-in-view"})}(t)}));var i=document.querySelectorAll(".range-slider");Array.from(i,(function(t){"undefined"!==("undefined"==typeof noUiSlider?"undefined":n(noUiSlider))&&(""!==t.getAttribute("id")&&null!==t.getAttribute("id")?window[t.getAttribute("id")]=a(t):a(t))}));var c=document.querySelectorAll(".slider");Array.from(c,(function(t){"undefined"!==("undefined"==typeof noUiSlider?"undefined":n(noUiSlider))&&noUiSlider.create(t,{start:50,connect:[!0,!1],range:{min:0,max:100}})}));var l=document.querySelectorAll('[data-toggle="copy"]');"undefined"!==n(l)&&Array.from(l,(function(t){t.addEventListener("click",(function(e){var n=t.getAttribute("data-copy-target"),r=t.getAttribute("data-copy-value"),o=document.querySelector(n);if(null!=o&&(r=void 0!==o.value&&null!==o.value?o.value:o.innerHTML),null!==r){var a=document.createElement("textarea");document.querySelector("body").appendChild(a),a.value=r,a.select(),document.execCommand("copy"),a.remove()}t.setAttribute("data-bs-original-title","Copied!");var i=bootstrap.Tooltip.getInstance(t);i.show(),t.setAttribute("data-bs-original-title","Copy"),setTimeout((function(){i.hide()}),500)}))}));var u=document.querySelectorAll(".iq-quantity-plus"),d=document.querySelectorAll(".iq-quantity-minus"),s=function(t,e){var n=t.closest('[data-qty="btn"]').querySelector('[data-qty="input"]').value,r=Number(n)+Number(e);r>=1&&(t.closest('[data-qty="btn"]').querySelector('[data-qty="input"]').value=r)};Array.from(u,(function(t){t.addEventListener("click",(function(e){s(t,1)}))})),Array.from(d,(function(t){t.addEventListener("click",(function(e){s(t,-1)}))}));var f=document.querySelectorAll(".date_flatpicker");Array.from(f,(function(t){"undefined"!==("undefined"==typeof flatpickr?"undefined":n(flatpickr))&&flatpickr(t,{minDate:"today",dateFormat:"Y-m-d"})}));var m=document.querySelectorAll(".range_flatpicker");Array.from(m,(function(t){"undefined"!==("undefined"==typeof flatpickr?"undefined":n(flatpickr))&&flatpickr(t,{mode:"range",minDate:"today",dateFormat:"Y-m-d"})}));var y=document.querySelectorAll(".wrap_flatpicker");Array.from(y,(function(t){"undefined"!==("undefined"==typeof flatpickr?"undefined":n(flatpickr))&&flatpickr(t,{wrap:!0,minDate:"today",dateFormat:"Y-m-d"})}));var p=document.querySelectorAll(".time_flatpicker");Array.from(p,(function(t){"undefined"!==("undefined"==typeof flatpickr?"undefined":n(flatpickr))&&flatpickr(t,{enableTime:!0,noCalendar:!0,dateFormat:"H:i"})}));var h,v=document.querySelectorAll(".inline_flatpickr");if(Array.from(v,(function(t){"undefined"!==("undefined"==typeof flatpickr?"undefined":n(flatpickr))&&flatpickr(t,{inline:!0,minDate:"today",dateFormat:"Y-m-d"})})),void 0!==window.counterUp){var g=window.counterUp.default,b=document.querySelectorAll(".counter");Array.from(b,(function(t){if("undefined"!==("undefined"==typeof Waypoint?"undefined":n(Waypoint)))new Waypoint({element:t,handler:function(){g(t,{duration:1e3,delay:10}),this.destroy()},offset:"bottom-in-view"})}))}if(Array.from(document.querySelectorAll('[data-toggle="slider-tab"]'),(function(t){"undefined"!==("undefined"==typeof SliderTab?"undefined":n(SliderTab))&&new SliderTab(t)})),n(h)!==n(null)&&document.querySelectorAll(".data-scrollbar").length&&(h=window.Scrollbar).init(document.querySelector(".data-scrollbar"),{continuousScrolling:!1,alwaysShowTracks:!1}),$.fn.DataTable){if($('[data-toggle="data-table"]').length&&$('[data-toggle="data-table"]').DataTable({autoWidth:!1,dom:'<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">'}),$('[data-toggle="data-table-column-hidden"]').length){var w=$('[data-toggle="data-table-column-hidden"]').DataTable({});$("a.toggle-vis").on("click",(function(t){t.preventDefault();var e=w.column($(this).attr("data-column"));e.visible(!e.visible())}))}if($('[data-toggle="data-table-column-filter"]').length&&($('[data-toggle="data-table-column-filter"] tfoot th').each((function(){var t=$(this).attr("title");$(this).html('<td><input type="text" class="form-control form-control-sm" placeholder="'.concat(t,'" /></td>'))})),$('[data-toggle="data-table-column-filter"]').DataTable({initComplete:function(){this.api().columns().every((function(){var t=this;$("input",this.footer()).on("keyup change clear",(function(){t.search()!==this.value&&t.search(this.value).draw()}))}))}})),$('[data-toggle="data-table-multi-language"]').length){var S=function(){$('[data-toggle="data-table-multi-language"]').DataTable({language:{url:Array.from(document.querySelector("#langSelector").options).filter((function(t){return t.selected})).map((function(t){return t.getAttribute("data-path")}))}})};S(),document.querySelector("#langSelector").addEventListener("change",(function(t){$('[data-toggle="data-table-multi-language"]').dataTable().fnDestroy(),S()}))}}var L=document.querySelectorAll("#my-table tr th"),k=document.querySelectorAll("#my-table td");null!==L&&Array.from(L,(function(t){t.addEventListener("click",(function(e){Array.from(L,(function(t){t.children.length&&t.children[0].classList.remove("active")})),t.children[0].classList.add("active"),Array.from(k,(function(t){return t.classList.remove("active")}));var n=Array.prototype.indexOf.call(document.querySelector("#my-table tr").children,t),r=document.querySelectorAll("#my-table tr td:nth-child("+parseInt(n+1)+")");Array.from(r,(function(t){return t.classList.add("active")}))}))}));var q=function(){var t=document.querySelectorAll(".nav"),e=document.querySelector('[data-sidebar="responsive"]');window.innerWidth<1025?(Array.from(t,(function(t){!t.classList.contains("flex-column")&&t.classList.contains("nav-tabs")&&t.classList.contains("nav-pills")&&t.classList.add("flex-column","on-resize")})),null!==e&&(e.classList.contains("sidebar-mini")||e.classList.add("sidebar-mini","on-resize"))):(Array.from(t,(function(t){t.classList.contains("on-resize")&&t.classList.remove("flex-column","on-resize")})),null!==e&&e.classList.contains("sidebar-mini")&&e.classList.contains("on-resize")&&e.classList.remove("sidebar-mini","on-resize"))};function A(){if("undefined"!==("undefined"==typeof IQSetting?"undefined":n(IQSetting))){var t=IQSetting.options.setting.sidebar_type.value,e=t;if(t.includes("sidebar-mini")){var r=e.findIndex((function(t){return"sidebar-mini"==t}));e.splice(r,1)}else e.push("sidebar-mini");IQSetting.sidebar_type(e)}}var E=document.querySelectorAll('[data-toggle="sidebar"]');Array.from(E,(function(t){t.addEventListener("click",(function(t){var e=document.querySelector(".sidebar");e.classList.contains("sidebar-mini")?(e.classList.remove("sidebar-mini"),A()):(e.classList.add("sidebar-mini"),A())}))}));var x=document.getElementById("back-to-top");function T(t){1==t?null!==document.querySelector(".screen-darken")&&document.querySelector(".screen-darken").classList.add("active"):0==t&&null!==document.querySelector(".screen-darken")&&document.querySelector(".screen-darken").classList.remove("active")}function _(){T(!1),null!==document.querySelector(".mobile-offcanvas.show")&&(document.querySelector(".mobile-offcanvas.show").classList.remove("show"),document.body.classList.remove("offcanvas-active"))}null!=x&&(document.getElementById("back-to-top").classList.add("animate__animated","animate__fadeOut"),window.addEventListener("scroll",(function(t){document.documentElement.scrollTop>250?(document.getElementById("back-to-top").classList.remove("animate__fadeOut"),document.getElementById("back-to-top").classList.add("animate__fadeIn")):(document.getElementById("back-to-top").classList.remove("animate__fadeIn"),document.getElementById("back-to-top").classList.add("animate__fadeOut"))})),document.querySelector("#top").addEventListener("click",(function(t){t.preventDefault(),window.scrollTo({top:0,behavior:"smooth"})}))),document.addEventListener("DOMContentLoaded",(function(t){var e;q(),null!==(e=document.querySelector(".loader"))&&(e.classList.add("animate__animated","animate__fadeOut"),setTimeout((function(){e.classList.add("d-none")}),200))})),window.addEventListener("resize",(function(t){q()})),document.addEventListener("DOMContentLoaded",(function(){document.querySelectorAll("[data-trigger]").forEach((function(t){var e=t.getAttribute("data-trigger");t.addEventListener("click",(function(t){t.preventDefault(),function(t){T(!0),null!==document.getElementById(t)&&(document.getElementById(t).classList.add("show"),document.body.classList.add("offcanvas-active"))}(e)}))})),document.querySelectorAll(".btn-close")&&document.querySelectorAll(".btn-close").forEach((function(t){t.addEventListener("click",(function(t){_()}))})),document.querySelector(".screen-darken")&&document.querySelector(".screen-darken").addEventListener("click",(function(t){_()}))})),document.querySelector("#navbarSideCollapse")&&document.querySelector("#navbarSideCollapse").addEventListener("click",(function(){document.querySelector(".offcanvas-collapse").classList.toggle("open")})),window.addEventListener("load",(function(){var t=document.getElementsByClassName("needs-validation");Array.prototype.filter.call(t,(function(t){t.addEventListener("submit",(function(e){!1===t.checkValidity()&&(e.preventDefault(),e.stopPropagation()),t.classList.add("was-validated")}),!1)}))}),!1),$(document).on("click",".btn",(function(t){$(this).trigger("blur")}));var C,I;!function(){var t=window.getComputedStyle(document.querySelector("html")).getPropertyValue("--bs-success").trim(),e=window.getComputedStyle(document.querySelector("html")).getPropertyValue("--bs-danger").trim();window.successSnackbar=function(e){Snackbar.show({text:e,pos:"bottom-left",actionTextColor:t,duration:2500})};window.errorSnackbar=function(t){Snackbar.show({text:t,pos:"bottom-left",actionTextColor:"#FFFFFF",backgroundColor:e,duration:2500})}}(),window.laravel={initialize:function(){this.methodLinks=$("[data-method]"),this.token=$("[data-token]"),this.registerEvents(),window.tooltipInit(),""==$("#quick-action-type").val()&&$("#quick-action-apply").attr("disabled",!0)},registerEvents:function(){this.methodLinks.on("click",this.handleMethod)},ajaxSubmitForm:function(t){var e=$(this).attr("action"),n=$(this).serialize(),r=$(this);t.preventDefault(),$.ajax({type:"POST",url:e,data:n,dataType:"json",success:function(t){t.status?(Swal.fire({title:"Deleted",text:t.message,icon:"success"}),renderedDataTable.ajax.reload(null,!1),r.remove()):t.message&&(Swal.fire({title:"Error",text:t.message,icon:"error"}),r.remove())},error:function(t){var e=document.createElement("div");e.innerHTML=t.responseText,Swal.fire({title:t.statusText,text:e.innerHTML,icon:"error"}),r.remove()}})},handleMethod:function(t){t.preventDefault();var e,n=$(this),r=n.data("method").toUpperCase();-1!==$.inArray(r,["PUT","DELETE","PATCH"])&&n.data("confirm")&&laravel.verifyConfirm(n).then((function(t){if(!t.isConfirmed)return!1;var r="form-"+n.attr("id");e=laravel.createForm(n,r),"ajax"==n.data("type")&&$("#"+r).on("submit",laravel.ajaxSubmitForm),e.submit()}))},verifyConfirm:(C=t().mark((function e(n){return t().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Swal.fire({title:n.data("confirm"),icon:"question",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#858482",confirmButtonText:"Yes, delete it!"}).then((function(t){return t}));case 2:return t.abrupt("return",t.sent);case 3:case"end":return t.stop()}}),e)})),I=function(){var t=this,n=arguments;return new Promise((function(r,o){var a=C.apply(t,n);function i(t){e(a,r,o,i,c,"next",t)}function c(t){e(a,r,o,i,c,"throw",t)}i(void 0)}))},function(t){return I.apply(this,arguments)}),createForm:function(t,e){var n=$("<form>",{method:"POST",id:e,action:t.attr("href")}),r=$("<input>",{type:"hidden",name:"_token",value:t.data("token")}),o=$("<input>",{name:"_method",type:"hidden",value:t.data("method")});return n.append(r,o).appendTo("body")}}}()})();
//# sourceMappingURL=backend-custom.js.map