<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
 <HEAD>
  <TITLE> ZTREE DEMO </TITLE>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="../css/ztree/zTreeStyle/zTreeStyle.css" type="text/css">
  <style>
	body {
	background-color: white;
	margin:0; padding:0;
	text-align: center;
	}
	div, p, table, th, td {
		list-style:none;
		margin:0; padding:0;
		color:#333; font-size:12px;
		font-family:dotum, Verdana, Arial, Helvetica, AppleGothic, sans-serif;
	}
	#testIframe {margin-left: 10px;}
	.top{height:100px;}
	.li{float:left;width:120px;list-style:none;}
	.line{border:1px solid #ccc;clear:both;}
  </style>
<script type="text/javascript" src="../js/ztree/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/ztree/jquery.ztree.core.js"></script>
  <SCRIPT type="text/javascript" >
  //<!--
	var zTree;
	var demoIframe;

	var setting = {
		view: {
			dblClickExpand: false,
			showLine: true,
			selectedMulti: false
		},
		data: {
			simpleData: {
				enable:true,
				idKey: "id",
				pIdKey: "pId",
				rootPId: ""
			}
		},
		callback: {
			beforeClick: function(treeId, treeNode) {
				var zTree = $.fn.zTree.getZTreeObj("tree");
				if (treeNode.isParent) {
					zTree.expandNode(treeNode);
					return false;
				} else {
					demoIframe.attr("src","content.html?id="+treeNode.file);
					return true;
				}
			}
		}
	};

	$(document).ready(function(){
		$.ajax({
            url: "http://info.judy.com:8080/web/index.php/classify-rests",
     	    dataType: 'json',
      	    success: function(data){
          	    var t = $("#tree");
      			t = $.fn.zTree.init(t, setting, data);  
      	    }
        })
		//var t = $("#tree");
		//t = $.fn.zTree.init(t, setting, zNodes);
		demoIframe = $("#testIframe");
		demoIframe.bind("load", loadReady);
		//var zTree = $.fn.zTree.getZTreeObj("tree");
		//zTree.selectNode(zTree.getNodeByParam("id", 101));

	});

	function loadReady() {
		var bodyH = demoIframe.contents().find("body").get(0).scrollHeight,
		htmlH = demoIframe.contents().find("html").get(0).scrollHeight,
		maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
		h = demoIframe.height() >= maxH ? minH:maxH ;
		if (h < 530) h = 530;
		demoIframe.height(h);
	}

  //-->
  </SCRIPT>
 </HEAD>

<BODY>
<div class="top">
    <ul>
        <li class="li"><a href="#">home</a></li>
        <li class="li"><a href="/web/index/classify/list.html" target="_blank">CLASSIFY</a></li>
        <li class="li"><a href="/web/index/content/list.html" target="_blank">CONTENT</a></li>
    </ul>
</div>
<div class="line"></div>
<TABLE border=0 height=600px align=left>
	<TR>
		<TD width=260px align=left valign=top style="BORDER-RIGHT: #999999 1px dashed">
			<ul id="tree" class="ztree" style="width:260px; overflow:auto;"></ul>
		</TD>
		<TD width=900px height=100% align=left valign=top><IFRAME ID="testIframe" Name="testIframe" FRAMEBORDER=0 SCROLLING=AUTO width=100%  height=600px SRC="content.html"></IFRAME></TD>
	</TR>
</TABLE>

</BODY>
</HTML>
