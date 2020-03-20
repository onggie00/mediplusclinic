<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
background: #fff none repeat scroll 0 0;
float: left;
overflow: hidden;
width: 38%;
border:1px solid #c4c4c4;
}
.inbox_msg {
clear: both;
overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
display: inline-block;
text-align: right;
width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
color: #05728f;
font-size: 21px;
margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
padding: 0;
color: #707070;
font-size: 18px;


}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#2870B9; margin:0 0 0px 0;}
.chat_ib h5 span{ font-size:13px; float:right;color:#F661A1;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto;}
.chat_img {
float: left;
width: 14%;
}
.chat_ib {
float: left;
padding: 0 0 0 15px;
width: 84%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
margin: 0;
padding: 18px 14px 16px 10px;
border: 1px solid #D4D4D4;
margin-top:20px;
margin-bottom:20px;
margin-left:20px;
margin-right:20px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#F6F6F6;border:1px solid #2870B9;}

.incoming_msg_img {
display: inline-block;
width: 6%;
}
.received_msg {
display: inline-block;
padding: 0 0 0 10px;
vertical-align: top;
margin-left:30px !important;
width: 92%;
}
.received_withd_msg p {
background:#F2F2F2 none repeat scroll 0 0;
border-radius: 7px;
color: #646464;
font-size: 14px;
margin: 0;
padding: 10px 10px 10px 12px;
width: 100%;
}
.time_date {
color: #747474;
display: block;
font-size: 12px;
margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
float: right;
padding: 10px 0px 0 0px;
width: 58%;
background:#fff;
border:1px solid #D2D2D2;
}

.sent_msg p {
background: #066DBA none repeat scroll 0 0;
border-radius:7px;
font-size: 14px;
margin: 0; color:#fff;
padding: 10px 10px 10px 12px;
width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
float: right;
margin-right:30px !important;
width: 46%;
}
.input_msg_write input {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
color: #4c4c4c;
font-size: 15px;
min-height: 48px;
width: 100%;
background:#F7F7F7;

}

.type_msg {
padding:15px;
position: relative;}
.msg_send_btn {
background: #F7F7F7 none repeat scroll 0 0;
border:0px;
color: #fff;
cursor: pointer;
position: absolute;
right: 16px;
top: 14px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
height: 516px;
overflow-y: auto;
margin-top:30px;
}
</style>
<script src="https://www.gstatic.com/firebasejs/5.9.2/firebase.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<!-- <script src="https://www.gstatic.com/firebasejs/6.6.2/firebase-app.js"></script> -->
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD1nSotuJbp_JAJyhgrmNfYUO1YOl8lee8",
    authDomain: "mediplus-15263.firebaseapp.com",
    databaseURL: "https://mediplus-15263.firebaseio.com",
    projectId: "mediplus-15263",
    storageBucket: "",
    messagingSenderId: "89861022477",
    appId: "1:89861022477:web:528ab5170834c4d38d4644"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
<main>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
          <div class="card-body">
              <div class="box direct-chat">
                <div class="messaging">
                  <div class="inbox_msg">
                      <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                              <h4><?php echo $title_page; ?></h4>
                            </div>
                        </div>
                        <div class="inbox_chat" id="chat_room">

                        </div>
                        <script>
                          var token = '<?php //echo $mydata->token ?>';
                            var refku = firebase.database().ref('/');
                              var cek = 0;
                           refku.on("value", function(data) {
                               <?php if (isset($_REQUEST['id'])): ?>
                                 $.post( "<?php echo site_url('admin/dokter/chat/chat_list_side?id='.$_REQUEST['id']) ?>",{})
                                 .done(function( data ) {
                                 //  console.log(list);
                                     $('#chat_room').html(data);
                                 });
                               <?php else: ?>
                                 $.post( "<?php echo site_url('admin/dokter/chat/chat_list_side') ?>",{})
                                 .done(function( data ) {
                                    //console.log(list);
                                     $('#chat_room').html(data);
                                 });
                               <?php endif; ?>

                             }, function (error) {
                                console.log("Error1: " + error.code);
                           });


                          </script>
                      </div>
                      <div class="mesgs">

                        <div class="msg_history" id="chat_detail">
                        </div>
                        <div class="type_msg">
                          <div class="input_msg_write">
                            <input type="text" class="write_msg" id="msg" placeholder="Tulis Pesan" />
                            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                          </div>
                            <!--
                          <br>

                          <form method="POST" enctype="multipart/form-data" id="fileUploadForm">
                              <input type="file" name="galery_chat" id="galery_chat" class="form-control" accept="image/jpeg, image/jpg, image/x-png, image/png, video/mp4,video/x-m4v,video/*"/>
                              <br>
                              <input type="submit" value="Send File" id="btnSubmit" class="btn btn-success"/>
                          </form>
                           -->
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

          </div>

         </div>
     </div>
  </div>
</div>
</main>

</div>
<!-- main-panel ends -->
        <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components\jquery\js\jquery.min.js"></script>
  <!-- Custom js for this page-->
  <script type="text/javascript">
  <?php if (isset($_REQUEST['id'])): ?>
        $.post( "<?php echo site_url('admin/dokter/chat/reloadchat?id='.$_REQUEST['id']) ?>",{
        })
        .done(function( data ) {
          $('#chat_detail').html(data);
        });
  <?php endif; ?>
  </script>
  <script >
  $(document).ready(function(){

    $("#btnSubmit").click(function(event) {
        //stop submit the form, we will post it manually.
        event.preventDefault();
        // Get form
        var form = $('#fileUploadForm')[0];
		// Create an FormData object
        var data = new FormData(form);
		// If you want to add an extra field for the FormData
        data.append("CustomField", "This is some extra data, testing");
		// disabled the submit button
        $("#btnSubmit").prop("disabled", true);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "http://mediplusclinic.co.id/api/galery_chat",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 6000000,
            success: function (data) {
                if (data.status == 1){
                  console.log("SUCCESS : ", data.status, data.message, data.data["url_galery"], data.data["galery_type"]);

                  $.post( "<?php echo site_url('admin/dokter/chat/insertchat') ?>",{
                    pasien_id: <?php echo $_REQUEST['id'] ?>,
                    pesan:$('#msg').val(),
                    url_galery: data.data["url_galery"],
                    galery_type: data.data["galery_type"]
                  })
                  .done(function( data1 ) {
                        console.log("SUCCESS", data1);
                  });
                }
                $('#galery_chat').val("");
                $("#btnSubmit").prop("disabled", false);
            },
            error: function (e) {
                console.log("ERROR : ", e);
                $("#btnSubmit").prop("disabled", false);

            }
        });

    });

       var dataTable = $('#data').DataTable({
         "dom": 'Bfrtip',
         "buttons": {
             dom: {
               button: {
                 tag: 'button',
                 className: ''
               }
             },
             buttons: [{
               extend: 'excel',
               className: 'btn btn-sm btn-info',
               titleAttr: 'Excel export.',
               text: 'Download Excel',
               exportOptions: {
                    columns: 'th:not(:last-child)'
              }
             },{
               extend: 'print',
               className: 'btn btn-sm btn-info',
               titleAttr: 'PDF export.',
               text: 'Print Table',
               exportOptions: {
                    columns: 'th:not(:last-child)'
              }
             }]
           },
            "scrollX":true,
            "processing":true,
            "serverSide":true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/dokter/jadwal_dokter/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0],
                      "orderable":false,
                 },
            ],
            "initComplete": function(settings, json) {
                $(".current").addClass("btn btn-primary");
              $(".current").removeClass("paginate_button");
            },
            "fnDrawCallback": function( oSettings ) {

                  $(".current").addClass("btn btn-primary");
                $(".current").removeClass("paginate_button");
            }
       });
       $(document).on("click", ".delete", function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#btndeletedata').click();
            $('#data_id').val(id);
        });

        $(document).on('click', '.update', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/dokter/jadwal_dokter/getdataedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#editform').html(data);
                $('#btneditdata').click();
              }
            });
       });
       <?php $msg = $this->session->flashdata('msg');
       if (isset($msg)): ?>
         <?php if ($msg == 1): ?>
           $('#done').click();
         <?php endif; ?>
         <?php if ($msg== 2): ?>
           $('#done1').click();
         <?php endif; ?>
         <?php if ($msg== 3): ?>
           $('#done2').click();
         <?php endif; ?>
         <?php else: ?>
       <?php endif; ?>

  });
  </script>
  <?php if (isset($_REQUEST['id'])): ?>
      <script type="text/javascript">
        var refku = firebase.database().ref('/C<?php echo $mydata->dokter_id ?>');
         refku.on("value", function(data) {
           $.post( "<?php echo site_url('admin/dokter/chat/reloadchat?id='.$_REQUEST['id']) ?>",{
           })
           .done(function( data ) {
             $('#chat_detail').html(data);
           });
           <?php if (isset($_REQUEST['id'])): ?>
             $.post( "<?php echo site_url('admin/dokter/chat/chat_list_side?id='.$_REQUEST['id']) ?>",{})
             .done(function( data ) {
             //  console.log(list);
                 $('#chat_room').html(data);
             });
           <?php else: ?>
             $.post( "<?php echo site_url('admin/dokter/chat/chat_list_side') ?>",{})
             .done(function( data ) {
                //console.log(list);
                 $('#chat_room').html(data);
             });
           <?php endif; ?>

          }, function (error) {
            console.log("Error1: " + error.code);
          });
          $('#msg').on('keypress', function (e) {
                   if(e.which === 13){
                      //Disable textbox to prevent multiple submit
                      var msgtext = $('#msg').val();
                      $(this).attr("disabled", "disabled");

                      //Do Stuff, submit, etc..
                      $.post( "<?php echo site_url('admin/dokter/chat/insertchat') ?>",{
                        pasien_id: <?php echo $_REQUEST['id'] ?>,
                        pesan:$('#msg').val(),
                        url_galery: "",
                        galery_type: "0"
                      })
                      .done(function( data ) {
                        console.log(data);
                        // firebase.database().ref('C<?php echo $mydata->dokter_id."/".$_REQUEST['id']."/".date("YmdHis") ?>/').set({
                        //     customer_is_sender: "0",
                        //     chat:msgtext
                        //   });
                      });

                      $('#msg').val("");
                      //Enable the textbox again if needed.
                      $(this).removeAttr("disabled");
                   }
             });
      </script>
  <?php endif; ?>
