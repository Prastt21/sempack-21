<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Chatbox - SIMAP</title>
        <script src="jquery-1.7.2-min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function(){
                $("body").on("submit", "form#chat-form", function (e){
                    e.preventDefault();
                    var message = $("#chatmessage").val();
					var safemessage = escapeHtml(message);
					var pattern = /{[A-Z_]+[0-9]*}|:\)|:\(|:P|:D|:S|:O|:=\)|\[:info\]|\[:tank\]|\[:gajah\]|\[:tembak\]|\[:arab\]|\[:penting\]|\[:sun\]|\[:goyang\]|\[:bingung\]|\[:alert\]|\[:thanks\]|:\|H|:X|:\-\*/ig;
					var patt1=new RegExp(pattern);
					var n="";
					var mapObj = {
						":)":'<img src="./chatex/0.gif" width="18" height="18" alt=":)" />',
						":(":'<img src="./chatex/1.gif" width="18" height="18" alt=":(" />',
						":P":'<img src="./chatex/2.gif" width="18" height="18" alt=":P" />',
						":D":'<img src="./chatex/3.gif" width="18" height="18" alt=":D" />',
						":S":'<img src="./chatex/4.gif" width="18" height="18" alt=":S" />',
						":O":'<img src="./chatex/5.gif" width="18" height="18" alt=":O" />',						
						":=)":'<img src="./chatex/6.gif" width="18" height="18" alt=":=)" />',
						":|H":'<img src="./chatex/7.gif" width="42" height="18" alt=":|H" />',
						":X":'<img src="./chatex/8.gif" width="18" height="18" alt=":X" />',		
						":-*":'<img src="./chatex/9.gif" width="18" height="18" alt=":-*" />',
						"[:sun]":'<img src="./chatex/10.gif" width="24" height="24" alt="[:sun]" />',
						"[:goyang]":'<img src="./chatex/11.gif" width="33" height="23" alt="[:goyang]" />',
						"[:thanks]":'<img src="./chatex/12.gif" width="50" height="37" alt="[:thanks]" />',
						"[:bingung]":'<img src="./chatex/13.gif" width="16" height="16" alt="[:bingung]" />',
						"[:alert]":'<img src="./chatex/14.gif" width="16" height="16" alt="[:alert]" />',
						"[:penting]":'<img src="./chatex/15.gif" width="74" height="16" alt="[:penting]" />',
						"[:info]":'<img src="./chatex/16.gif" width="45" height="16" alt="[:info]" />',
						"[:tank]":'<img src="./chatex/17.gif" width="66" height="49" alt="[:tank]" />',
						"[:tembak]":'<img src="./chatex/18.gif" width="156" height="112" alt="[:tembak]" />',
						"[:gajah]":'<img src="./chatex/19.gif" width="113" height="69" alt="[:gajah]" />',
						"[:arab]":'<img src="./chatex/20.gif" width="62" height="39" alt="[:arab]" />'
					};
					if(patt1.test(safemessage) == true ) {
						var n = safemessage.replace(pattern, function(matched){
						  return mapObj[matched];
						});
					} 	else {
						var n = safemessage;
					}			
					if(safemessage== ""){
						alert("Silahkan isikan chat anda");
						$("#chatmessage").focus().select();
						return false;
					}  else {
						
						$.post("writechat.php", {text: n});
						$("#chatmessage").val('');
						n = "";
						return false;
					}
                });

                function loadContent (){
                    var oldHeight = $("#chatwindow").prop("scrollHeight")-20;
                    $.ajax({
                        url: "messages.html",
                        cache: false,
                        success: function(content){
                            $("#chatwindow").html(content); //Insert chat log into the #chatwindow				
                            var newHeight = $("#chatwindow").prop("scrollHeight") - 20;
                            if(newHeight > oldHeight){
                                $("#chatwindow").animate({ scrollTop: newHeight }, 'slow'); //Autoscroll to bottom of div
                            }				
                        }
                    });

                }
                setInterval(loadContent, 1000);
            });
			function addSmile(smile, idadd) {
				  var tarea_com = document.getElementById(idadd);
				  tarea_com.value += smile;
				  tarea_com.focus();
			}
			function escapeHtml(unsafe) {
				return unsafe
					 .replace(/&/g, "&amp;")
					 .replace(/</g, "&lt;")
					 .replace(/>/g, "&gt;")
					 .replace(/"/g, "&quot;")
					 .replace(/'/g, "&#039;");
			 }
			 

        </script>
        <style>
           <!--
            body {
                height: 100%;
                background: #CCCCCC;
				font: 10pt Verdana, Tahoma, arial, sans-serif;
            }

            .right {
                float: right;
               text-align:right;
				font:10px Verdana;
				padding-right:20px;
            }

            .name {
                font-weight: bold;
				float: left;
            }
			.message {
				float: left;
				clear:both;
				padding:4px;
				background:#E5E5E6;
				width:352px;
				border: solid 1px #CACACA;
			}
			.info_wrap {
				width:360px;
				height:auto;
			}
			.message_text {
				padding: 2px 0px 2px;
				clear:both;
				float:left;
			}
            #chatwrapper {
                top: 10px;
                width: 370px;
                position: relative;
                margin: 0 auto;
                height: 100%;
            }
            #chatwindow {
                top: 20px; 
                width: 362px;
                position: relative;
                background: #FFF;
                color: #000;
                height: 380px;
                overflow: auto;
				 border: solid 2px #64717C;
				 overflow-y: scroll;
				 overflow-x: hidden;
            }
            #chatform {
                position: relative;
                top: 5px;
                height: 100px;
                width: 100%;
            } 
            #chat-form {
                position: relative;
                top: 25px;
            }
            #chatmessage {
                width: 354px;
				border: solid 2px #64717C;
				height:20px;
				background:#F4F4F4;	
				font: 10pt Verdana, Tahoma, arial, sans-serif;
				padding:4px;
				margin-bottom:4px;
							background:#FFE79D;
            }
            #send {
                width: 120px;
				height:40px;
				margin-top:10px;
				float:right;
				margin-right:10px;
	
            }
            #nameform {
                margin: 0 auto;
                width: 300px;
                display: block;
            }
            .welcome {
                float: left;
                position: relative;
                width: auto;
            }
            -->
        </style>
    </head>

    <body>
        <div id="chatwrapper">
            <?php
            if (!isset($_SESSION['nama_operator'])) {
            ?>
                Silahkan login terlebih dahulu.
            <?php } else { ?>
               
                        Anda chat sebagai <b><?php echo $_SESSION['nama_operator']; ?></b><br/>
                    
               
                <div id="chatwindow">
                </div> 
                <div id="chatform">
                    <form id="chat-form" action="#">
                        <input type="text" id="chatmessage" name ="message" />
						 <div id="chatex">
						  <img src="chatex/0.gif" alt=":)" title=":)" onclick="addSmile(':)', 'chatmessage');" />
						  <img src="chatex/1.gif" alt=":(" title=":(" onclick="addSmile(':(', 'chatmessage');" />
						  <img src="chatex/2.gif" alt=":P" title=":P" onclick="addSmile(':P', 'chatmessage');" />
						  <img src="chatex/3.gif" alt=":D" title=":D" onclick="addSmile(':D', 'chatmessage');" />
						  <img src="chatex/4.gif" alt=":S" title=":S" onclick="addSmile(':S', 'chatmessage');" />
						  <img src="chatex/5.gif" alt=":O" title=":O" onclick="addSmile(':O', 'chatmessage');" />
						  <img src="chatex/6.gif" alt=":=)" title=":=)" onclick="addSmile(':=)', 'chatmessage');" />
						  <img src="chatex/7.gif" alt=":|H" title=":|H" onclick="addSmile(':|H', 'chatmessage');" />
						  <img src="chatex/8.gif" alt=":X" title=":X" onclick="addSmile(':X', 'chatmessage');" />
						  <img src="chatex/9.gif" alt=":-*" title=":-*" onclick="addSmile(':-*', 'chatmessage');" /><br/>
						  <img src="chatex/15.gif" alt=":[:penting]" title="[:penting]" onclick="addSmile('[:penting]', 'chatmessage');" />
						  <img src="chatex/14.gif" alt="[:alert]" title="[:alert]" onclick="addSmile('[:alert]', 'chatmessage');" />
						  <img src="chatex/16.gif" alt="[:info]" title="[:info]" onclick="addSmile('[:info]', 'chatmessage');" />
						  </div>
                        <input type="submit" id="send" value="Kirim"/>
                    </form>
                </div>
            <?php } ?>
        </div>
    </body>
</html>