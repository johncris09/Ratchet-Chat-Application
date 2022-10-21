<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  rel="stylesheet"/> 
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
        body{
          background: #EEEEEE;
          font-family: 'Roboto', sans-serif;
        }
        .card{
          width: 600px;
          border: none;
          border-radius: 15px;
        }
        .adiv{
          background: #04CB28;
          border-radius: 15px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
          font-size: 12px;
          height: 46px;
        }
        .chat{
          border: none;
          background: #E2FFE8;
          font-size: 10px;
          border-radius: 20px;
        }
        .bg-white{
          border: 1px solid #E7E7E9;
          font-size: 10px;
          border-radius: 20px;
        }
        .myvideo img{
          border-radius: 20px
        }
        .dot{
          font-weight: bold;
        }
        .form-control{
          border-radius: 12px;
          border: 1px solid #F0F0F0;
          /* font-size: 8px; */
        }
        .form-control:focus{
          box-shadow: none;
          }
        .form-control::placeholder{
          /* font-size: 8px; */
          color: #C4C4C4;
        }

    </style>
</head>
<body>
    <div class="container">
    <div class="container d-flex justify-content-center">
    <div class="card mt-5">
      <div class="d-flex flex-row justify-content-between p-3 adiv text-white">
        <i class="fas fa-chevron-left"></i>
        <span class="pb-3">Live chat</span>
        <i class="fas fa-times"></i>
      </div>
      <div id="out" style="width: 600px; height: 600px;  overflow: scroll; ">  
      </div> 
        
        <form action="" id="chat-form"> 
          <div class="form-group px-3">
            <textarea class="form-control" id="message" rows="5" placeholder="Type your message"></textarea> 
            <button type="submit" class="btn btn-primary btn-sm">Send</button>
          </div>
        </form>
    </div>
</div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
    <script>
        $( document ).ready(function() {
            var conn = new WebSocket('ws://localhost:8080');
            conn.onopen = function(e) { 
                console.log("Connection established!");
            };

            conn.onmessage = function(e) { 
                var data = JSON.parse(e.data)
                console.info(data)
                if(data.from == "Me"){
                  $('#out').append('\
                    <div class="row justify-content-end pr-4 pt-2">\
                      <p class="alert alert-warning  " style="width: 400px; ">'+data.message+'</p>\
                    </div>\
                  ') 
                }else{ 
                  $('#out').append('\
                    <div class="row justify-content-start pl-4 pt-2">\
                      <p class="alert alert-primary  " style="width: 400px;  ">'+data.message+'</p>\
                    </div>\
                  ') 
                } 
            };

            $('#chat-form').on('submit', function(e){
                e.preventDefault();
                
                var message = $('#message').val(); 

                var data = {
                    user_id: 1,
                    message : message
                }; 

                conn.send(JSON.stringify(data));
            })
        });
    </script>
</body>
</html>