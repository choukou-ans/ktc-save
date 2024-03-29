<?php
 /**
  * view
  *
  * @package default
  * @author  GiangNT
  */
 // debug(domain);die;
?>

<!DOCTYPE html>
<html>
<head>
    <?php echo $this -> Html -> charset(); ?>
    <title>
        <?php echo $title?>
    </title>
    <script>
     var hint_api = new Array();
      <?php
      $api_value = array_values($apis);
       foreach ($apis as $key => $api) {?>
            hint_api["<?php echo $key ?>"] = "<?php echo $api ?>";
      <?php } ?>
    </script>
    <?php

    echo $this -> Html -> meta('icon');

    echo $this -> Html -> css(array('cake.generic', 'jquery-ui'));
    echo $this -> Html -> script(array('jquery-2.0.3', 'jquery-ui', 'jquery.csv-0.71', 'jquery.storageapi.min', 'request' , 'history'));
    echo $this -> fetch('meta');
    echo $this -> fetch('css');
    echo $this -> fetch('script');
    ?>
    <style>
        .api-select input[type="radio"] {
            float: none;
        }
        .api-select label {
            display: inline;
        }
        #select-list-api{
            display: none
        }
        #detail {
            padding: 10px;
            color: #3B8230;
            font-weight: bold;
        }
        .min-submit {
            min-width: 100px;
            min-height: 45px;
        }
        #domain {
            display: none;
        }
        #respon {
            min-height: 50px;
            border: 1px solid #00AA00;
        }
        .fix-top , .fix-botton{
            position: fixed;
            opacity:0.8;
            z-index: 999;
            font-size: 10pt;
            border: none;
            -moz-box-shadow: inset -5px -5px 5px #888;
			-webkit-box-shadow: inset -5px -5px 5px #888;
			box-shadow: inset 0px -2px 4px #888;
			color: #2D6324;
            /*font-weight: bold;*/
        }
        .fix-top {
            top: 0px;
            color: #00AA00;
        }
        .fix-botton {
            bottom: 0px;
            right: 10px;
            background-color: #EE5F5B;
            color:#000000
        }
        .fix-left-clearrespon {
            left: 120px;
        }
        .fix-left-editrequest {
            left: 230px;
            display: inline-block!important;
        }
        .fix-left-history {
            left: 340px;
            display: inline-block!important;
        }
        .fix-left-savehistory {
            left: 450px;
            display: inline-block!important;
        }
        #clear-respon , #edit-request, #history-request, #save-request {
            margin-left: 10px;
        }
        #edit-request {
            display: none;
        }
        .fix-ui-dialog {
            position: fixed!important;
            top:0px;
        }
    </style>
<script>
      var list_api_tmp = "<?php echo implode(",", array_keys($apis)); ?>" ;
      var list_api = $.csv.toArray(list_api_tmp);
      $(function() {
        $ ( "#API" ).autocomplete({
          source: list_api,
          select: function( event, ui ) {
              var api_select = ui['item']['value'];
              getDetail(hint_api[api_select]);
          }
        });
      });

$(function() {
    $( "#dialog-request" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      position: { my: "left", at: "top", of: window},
      resizable: false,
      modal: true,
      width:'auto',
    });
    $( "#view-history" ).dialog({
      autoOpen: false,
      show: {
        effect: "fold",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      buttons: {
        Use: function() {
            var request = $('#data-date').val();
            if(request.length != 0){
                $('#Request').val(request);
            }
            $( "#view-history" ).dialog( "close" );
        },
        Delete: function() {
            var time = $('#time-history').val();
            $('#time-history').find('option:selected').remove();
            deleteHistoryByTime(time);
            getHistory();
        },
      },
      position: ['center',80],
      resizable: false,
      modal: true,
      width:'auto',
    });
    
    $( "#save-comment-request" ).dialog({
      autoOpen: false,
      show: {
        effect: "explode",
        duration: 1000
      },
      hide: {
        effect: "fade",
        duration: 1000
      },
      position: { my: "left", at: "top", of: window},
      resizable: false,
      modal: true,
      width:'auto',
      buttons: {
        "Save": function() {
        var comment_history = $('#comment-content').val();
        var dialog_request = $('#dialog-request').parent().css('display');
        if(dialog_request == 'block'){
            var request = $('#Request-dialog').val();
            $('#Request').val(request);
        }else{
            var request = $('#Request').val();
        }
        var api = $('.get-api').find(".api-option:not(:hidden)").val();
        if (api != '') {
            try {
                saveHistory(api, request, comment_history);
            } catch(e) {
                console.log(e);
                alert("Sai data nhap vao!");
            }
        } else {
            alert("Nhap API");
        }
          
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    


   $("html").click(function() {
       var dialog_request = $('#dialog-request').parent().css('display');
       var save_request = $('#save-comment-request').parent().css('display');
       var history = $('#view-history').parent().css('display');
       if(dialog_request == 'block'){
           $( "#dialog-request" ).dialog( "close" );
        }
       if(save_request == 'block'){
           $( "#save-comment-request" ).dialog( "close" );
        }
       if(history == 'block'){
           $( "#view-history" ).dialog( "close" );
        }
        
    });
    
    $(".ui-dialog, #edit-request, .submit, #edit-request, #save-request, #history-request").click(function(e){
        e.stopPropagation();
    });
    $( "#edit-request" ).click(function() {
      var request_cp = $.trim($('#Request').val());
      $('#Request-dialog').val(request_cp);
      // $( "#dialog-request" ).dialog( "open" );
       $('#dialog-request').parent().css({position:"fixed"}).end().dialog('open');
    });
    $( "#save-request" ).click(function() {
       $('#save-comment-request').parent().css({position:"fixed"}).end().dialog('open');
    });
    $( "#history-request" ).click(function() {
        $('#time-history, #comment-date, #data-date').empty();
        var api = $('.get-api').find(".api-option:not(:hidden)").val();
        if (api != '') {
            getListTimeForSave(api);
            getHistory();
            $('#view-history').parent().css({position:"fixed"}).end().dialog('open');
        } else {
            alert("Nhap API");
        }
    });

  });
  
   $(document).on( "change", '#time-history', function() {
       getHistory();
    });
    
   $( window ).scroll(function() {
       var p_top = getpositiontop();
       if(p_top == 0) {
        $( "#dialog-request" ).dialog( "close" );
       }
   });

</script>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>Tests</h1>
        </div>
        <div id="content">
            <?php echo $this -> Session -> flash(); ?>
            <div class="input api-select">
                <input name="select" type="radio" value="1" id="select-1"  checked="checked"/>
                <label for="select-1">Input API</label>
                <input name="select" type="radio" value="2" id="select-2" />
                <label for="select-2">Combox</label>
           </div>

            <div class="input get-api">
                <label for="api-select"><h2>API</h2></label>
                <input name="API" id="API" class="api-option" type="text">
                <select name="API" id="select-list-api" class="api-option">
                    <?php  foreach ($apis as $api => $detail) {?>
                        <option name="<?php echo $detail; ?>" value="<?php echo $api; ?>"><?php echo $api; ?></option>
                    <?php  } ?>
                </select>
            </div>
            <div class="input">
                <label for="respon"><h3>Detail</h3></label>
                <div id = 'detail'></div>
            </div>
            <button class="submit min-submit" id="submit-one">Test</button>
            <button class="min-submit" id ="clear-respon">Clear Respon</button>
            <button class="min-submit" id ="edit-request">Edit Request</button>
            <button class="min-submit" id ="history-request">History</button>
            <button class="min-submit" id ="save-request">Save</button>
            <button class="min-submit" id ="clear-all-history">Clear All History</button>
            <div class="input textarea">
                <label for="Request"><h3>Request</h3></label>
                <textarea name="data[Request]" cols="30" rows="8" id="Request"></textarea>
            </div>
            <div class="input textarea" id = "dialog-request" title="Request Dialog">
                <textarea name="data[Request]" cols="60" rows="8" id="Request-dialog"></textarea>
            </div>
            <div class="input">
                <label for="respon"><span style="font-size: 18pt;color: rgb(44, 104, 119)">Respon</span></label>
                <div id = 'respon'></div>
            </div>
        </div>
        <div id="footer">
        <input value="<?php echo $domain ?>"  id ="domain"/>
        <button class="min-submit fix-botton" id = "btt">Back to Top</button>
        </div>
        <div class="input textarea" id = "save-comment-request" title="Comment Save">
                <textarea  cols="60" rows="6" id="comment-content"></textarea>
         </div>
        <div class="input textarea" id = "view-history" title="History">
             <input id= "history-api" value="" style="display: none" />
              <label>Time</label>
              <select id ='time-history' style="width: 98%">
                  <!-- <option></option> -->
              </select>
              <label>Commment</label>
              <textarea readonly="readonly"  cols="60" rows="2" id="comment-date"></textarea>
              <label>Data Request</label>
              <textarea readonly="readonly"  cols="60" rows="6" id="data-date"></textarea>
         </div>
    </div>
    <?php echo $this -> element('sql_dump'); ?>
</body>
</html>
