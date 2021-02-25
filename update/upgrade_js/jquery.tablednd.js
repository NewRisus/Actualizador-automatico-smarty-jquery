/* TableDnD plug-in for JQuery */
!function(t,e,a,n){var i="touchstart mousedown",r="touchmove mousemove",l="touchend mouseup";t(a).ready(function(){function e(t){for(var e={},a=t.match(/([^;:]+)/g)||[];a.length;)e[a.shift()]=a.shift().trim();return e}t("table").each(function(){"dnd"===t(this).data("table")&&t(this).tableDnD({onDragStyle:t(this).data("ondragstyle")&&e(t(this).data("ondragstyle"))||null,onDropStyle:t(this).data("ondropstyle")&&e(t(this).data("ondropstyle"))||null,onDragClass:void 0===t(this).data("ondragclass")?"tDnD_whileDrag":t(this).data("ondragclass"),onDrop:t(this).data("ondrop")&&new Function("table","row",t(this).data("ondrop")),onDragStart:t(this).data("ondragstart")&&new Function("table","row",t(this).data("ondragstart")),onDragStop:t(this).data("ondragstop")&&new Function("table","row",t(this).data("ondragstop")),scrollAmount:t(this).data("scrollamount")||5,sensitivity:t(this).data("sensitivity")||10,hierarchyLevel:t(this).data("hierarchylevel")||0,indentArtifact:t(this).data("indentartifact")||'<div class="indent">&nbsp;</div>',autoWidthAdjust:t(this).data("autowidthadjust")||!0,autoCleanRelations:t(this).data("autocleanrelations")||!0,jsonPretifySeparator:t(this).data("jsonpretifyseparator")||"\t",serializeRegexp:t(this).data("serializeregexp")&&new RegExp(t(this).data("serializeregexp"))||/[^\-]*$/,serializeParamName:t(this).data("serializeparamname")||!1,dragHandle:t(this).data("draghandle")||null})})}),jQuery.tableDnD={currentTable:null,dragObject:null,mouseOffset:null,oldX:0,oldY:0,build:function(e){return this.each(function(){this.tableDnDConfig=t.extend({onDragStyle:null,onDropStyle:null,onDragClass:"tDnD_whileDrag",onDrop:null,onDragStart:null,onDragStop:null,scrollAmount:5,sensitivity:10,hierarchyLevel:0,indentArtifact:'<div class="indent">&nbsp;</div>',autoWidthAdjust:!0,autoCleanRelations:!0,jsonPretifySeparator:"\t",serializeRegexp:/[^\-]*$/,serializeParamName:!1,dragHandle:null},e||{}),t.tableDnD.makeDraggable(this),this.tableDnDConfig.hierarchyLevel&&t.tableDnD.makeIndented(this)}),this},makeIndented:function(e){var a,n,i=e.tableDnDConfig,r=e.rows,l=t(r).first().find("td:first")[0],s=0,o=0;if(t(e).hasClass("indtd"))return null;n=t(e).addClass("indtd").attr("style"),t(e).css({whiteSpace:"nowrap"});for(var d=0;d<r.length;d++)o<t(r[d]).find("td:first").text().length&&(o=t(r[d]).find("td:first").text().length,a=d);for(t(l).css({width:"auto"}),d=0;d<i.hierarchyLevel;d++)t(r[a]).find("td:first").prepend(i.indentArtifact);for(l&&t(l).css({width:l.offsetWidth}),n&&t(e).css(n),d=0;d<i.hierarchyLevel;d++)t(r[a]).find("td:first").children(":first").remove();return i.hierarchyLevel&&t(r).each(function(){(s=t(this).data("level")||0)<=i.hierarchyLevel&&t(this).data("level",s)||t(this).data("level",0);for(var e=0;e<t(this).data("level");e++)t(this).find("td:first").prepend(i.indentArtifact)}),this},makeDraggable:function(e){var a=e.tableDnDConfig;a.dragHandle&&t(a.dragHandle,e).each(function(){t(this).bind(i,function(n){return t.tableDnD.initialiseDrag(t(this).parents("tr")[0],e,this,n,a),!1})})||t(e.rows).each(function(){t(this).hasClass("nodrag")?t(this).css("cursor",""):t(this).bind(i,function(n){if("TD"===n.target.tagName)return t.tableDnD.initialiseDrag(this,e,this,n,a),!1}).css("cursor","move")})},currentOrder:function(){var e=this.currentTable.rows;return t.map(e,function(e){return(t(e).data("level")+e.id).replace(/\s/g,"")}).join("")},initialiseDrag:function(e,n,i,s,o){this.dragObject=e,this.currentTable=n,this.mouseOffset=this.getMouseOffset(i,s),this.originalOrder=this.currentOrder(),t(a).bind(r,this.mousemove).bind(l,this.mouseup),o.onDragStart&&o.onDragStart(n,i)},updateTables:function(){this.each(function(){this.tableDnDConfig&&t.tableDnD.makeDraggable(this)})},mouseCoords:function(t){return t.originalEvent.changedTouches?{x:t.originalEvent.changedTouches[0].clientX,y:t.originalEvent.changedTouches[0].clientY}:t.pageX||t.pageY?{x:t.pageX,y:t.pageY}:{x:t.clientX+a.body.scrollLeft-a.body.clientLeft,y:t.clientY+a.body.scrollTop-a.body.clientTop}},getMouseOffset:function(t,a){var n,i;return a=a||e.event,i=this.getPosition(t),{x:(n=this.mouseCoords(a)).x-i.x,y:n.y-i.y}},getPosition:function(t){var e=0,a=0;for(0===t.offsetHeight&&(t=t.firstChild);t.offsetParent;)e+=t.offsetLeft,a+=t.offsetTop,t=t.offsetParent;return{x:e+=t.offsetLeft,y:a+=t.offsetTop}},autoScroll:function(t){var n=this.currentTable.tableDnDConfig,i=e.pageYOffset,r=e.innerHeight?e.innerHeight:a.documentElement.clientHeight?a.documentElement.clientHeight:a.body.clientHeight;a.all&&(void 0!==a.compatMode&&"BackCompat"!==a.compatMode?i=a.documentElement.scrollTop:void 0!==a.body&&(i=a.body.scrollTop)),t.y-i<n.scrollAmount&&e.scrollBy(0,-n.scrollAmount)||r-(t.y-i)<n.scrollAmount&&e.scrollBy(0,n.scrollAmount)},moveVerticle:function(t,e){0!==t.vertical&&e&&this.dragObject!==e&&this.dragObject.parentNode===e.parentNode&&(0>t.vertical&&this.dragObject.parentNode.insertBefore(this.dragObject,e.nextSibling)||0<t.vertical&&this.dragObject.parentNode.insertBefore(this.dragObject,e))},moveHorizontal:function(e,a){var n,i=this.currentTable.tableDnDConfig;if(!i.hierarchyLevel||0===e.horizontal||!a||this.dragObject!==a)return null;n=t(a).data("level"),0<e.horizontal&&n>0&&t(a).find("td:first").children(":first").remove()&&t(a).data("level",--n),0>e.horizontal&&n<i.hierarchyLevel&&t(a).prev().data("level")>=n&&t(a).children(":first").prepend(i.indentArtifact)&&t(a).data("level",++n)},mousemove:function(e){var a,n,i,r,l,s=t(t.tableDnD.dragObject),o=t.tableDnD.currentTable.tableDnDConfig;return e&&e.preventDefault(),!!t.tableDnD.dragObject&&("touchmove"===e.type&&event.preventDefault(),o.onDragClass&&s.addClass(o.onDragClass)||s.css(o.onDragStyle),r=(n=t.tableDnD.mouseCoords(e)).x-t.tableDnD.mouseOffset.x,l=n.y-t.tableDnD.mouseOffset.y,t.tableDnD.autoScroll(n),a=t.tableDnD.findDropTargetRow(s,l),i=t.tableDnD.findDragDirection(r,l),t.tableDnD.moveVerticle(i,a),t.tableDnD.moveHorizontal(i,a),!1)},findDragDirection:function(t,e){var a=this.currentTable.tableDnDConfig.sensitivity,n=this.oldX,i=this.oldY,r={horizontal:t>=n-a&&t<=n+a?0:t>n?-1:1,vertical:e>=i-a&&e<=i+a?0:e>i?-1:1};return 0!==r.horizontal&&(this.oldX=t),0!==r.vertical&&(this.oldY=e),r},findDropTargetRow:function(e,a){for(var n=0,i=this.currentTable.rows,r=this.currentTable.tableDnDConfig,l=0,s=null,o=0;o<i.length;o++)if(s=i[o],l=this.getPosition(s).y,n=parseInt(s.offsetHeight)/2,0===s.offsetHeight&&(l=this.getPosition(s.firstChild).y,n=parseInt(s.firstChild.offsetHeight)/2),a>l-n&&a<l+n)return e.is(s)||r.onAllowDrop&&!r.onAllowDrop(e,s)||t(s).hasClass("nodrop")?null:s;return null},processMouseup:function(){if(!this.currentTable||!this.dragObject)return null;var e=this.currentTable.tableDnDConfig,n=this.dragObject,i=0,s=0;t(a).unbind(r,this.mousemove).unbind(l,this.mouseup),e.hierarchyLevel&&e.autoCleanRelations&&t(this.currentTable.rows).first().find("td:first").children().each(function(){(s=t(this).parents("tr:first").data("level"))&&t(this).parents("tr:first").data("level",--s)&&t(this).remove()})&&e.hierarchyLevel>1&&t(this.currentTable.rows).each(function(){if((s=t(this).data("level"))>1)for(i=t(this).prev().data("level");s>i+1;)t(this).find("td:first").children(":first").remove(),t(this).data("level",--s)}),e.onDragClass&&t(n).removeClass(e.onDragClass)||t(n).css(e.onDropStyle),this.dragObject=null,e.onDrop&&this.originalOrder!==this.currentOrder()&&t(n).hide().fadeIn("fast")&&e.onDrop(this.currentTable,n),e.onDragStop&&e.onDragStop(this.currentTable,n),this.currentTable=null},mouseup:function(e){return e&&e.preventDefault(),t.tableDnD.processMouseup(),!1},jsonize:function(t){var e=this.currentTable;return t?JSON.stringify(this.tableData(e),null,e.tableDnDConfig.jsonPretifySeparator):JSON.stringify(this.tableData(e))},serialize:function(){return t.param(this.tableData(this.currentTable))},serializeTable:function(t){for(var e="",a=t.tableDnDConfig.serializeParamName||t.id,n=t.rows,i=0;i<n.length;i++){e.length>0&&(e+="&");var r=n[i].id;r&&t.tableDnDConfig&&t.tableDnDConfig.serializeRegexp&&(e+=a+"[]="+(r=r.match(t.tableDnDConfig.serializeRegexp)[0]))}return e},serializeTables:function(){var e=[];return t("table").each(function(){this.id&&e.push(t.param(t.tableDnD.tableData(this)))}),e.join("&")},tableData:function(e){var a,n,i,r,l=e.tableDnDConfig,s=[],o=0,d=0,h=null,u={};if(e||(e=this.currentTable),!e||!e.rows||!e.rows.length)return{error:{code:500,message:"Not a valid table."}};if(!e.id&&!l.serializeParamName)return{error:{code:500,message:"No serializable unique id provided."}};r=l.autoCleanRelations&&e.rows||t.makeArray(e.rows),a=function(t){return t&&l&&l.serializeRegexp?t.match(l.serializeRegexp)[0]:t},u[i=n=l.serializeParamName||e.id]=[],!l.autoCleanRelations&&t(r[0]).data("level")&&r.unshift({id:"undefined"});for(var c=0;c<r.length;c++)if(l.hierarchyLevel){if(0===(d=t(r[c]).data("level")||0))i=n,s=[];else if(d>o)s.push([i,o]),i=a(r[c-1].id);else if(d<o)for(var f=0;f<s.length;f++)s[f][1]===d&&(i=s[f][0]),s[f][1]>=o&&(s[f][1]=0);o=d,t.isArray(u[i])||(u[i]=[]),(h=a(r[c].id))&&u[i].push(h)}else(h=a(r[c].id))&&u[i].push(h);return u}},jQuery.fn.extend({tableDnD:t.tableDnD.build,tableDnDUpdate:t.tableDnD.updateTables,tableDnDSerialize:t.proxy(t.tableDnD.serialize,t.tableDnD),tableDnDSerializeAll:t.tableDnD.serializeTables,tableDnDData:t.proxy(t.tableDnD.tableData,t.tableDnD)})}(jQuery,window,window.document);