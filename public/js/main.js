var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 12;
var page = 1;


function getRequests(mode) {
  // alert(mode);
  $.ajax({
    type: "GET",
    url: "userConnection/get-send-reqs",
    data: {mode:mode},
    beforeSend: function(){
      $('#table').addClass('d-none');
      $('#connections_in_common_skeleton').removeClass('d-none').addClass('d-block');
    },
    success: function (response) {
      $('#table').removeClass('d-none').addClass('d-block');

      $('#connections_in_common_skeleton').removeClass('d-block').addClass('d-none');

        if(response.status && response.data.mode=="sent")
        {
          $('#table').empty();
          $('#sent_req_count').text(response.data.count);
          response.data.sendRequests.forEach(function(sentReq){
            $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+sentReq.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+sentReq.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="" class="btn btn-danger me-1 cancel_request_btn" data-withdraw_id="'+sentReq.id+'" data-user_id="'+response.data.userId+'">Withdraw Request</button></div></td></tr>');
          });
        }
        else if(response.status && response.data.mode=="received")
        {
          $('#table').empty();
          $('#rece_req_count').text(response.data.count);
          response.data.receiverRequest.forEach(function(receiverReq){
            $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+receiverReq.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+receiverReq.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="" class="btn btn-primary me-1 accept_request_btn" data-req_id="'+receiverReq.id+'" data-user_id="'+response.data.userId+'">Accept</button></div></td></tr>');
          });
        }
        else
        {
          $('#table').empty();

        }

      // }
    }
  });
}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() 
{
  $.ajax({
    type: "GET",
    url: "userConnection/connections",
    type: "get",
    datatype: "html",
    beforeSend: function(){
      $('#table').addClass('d-none');
      $('#connections_in_common_skeleton').removeClass('d-none').addClass('d-block');
    },
    success: function (response) {
      $('#table').removeClass('d-none').addClass('d-block');
      $('#connections_in_common_skeleton').removeClass('d-block').addClass('d-none');

     if(response.status)
     {
        let mutual_friends_count = response.data.my_connections.mutual_friends.length;
        $('#connection_count').text(response.data.count);
        $('#table').empty();

        response.data.my_connections.users.forEach(function(myConnection){
          console.log(myConnection);
          $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+myConnection.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+myConnection.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><div><button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">Connections in common ('+mutual_friends_count+')</button><button id="remove_request_btn" class="btn btn-danger me-1" data-connection_id="'+myConnection.id+'" data-user_id="'+response.data.userId+'">Remove Connection</button></div></div></td></tr>');
      })
     }
     else
     {
      $('#table').empty();

     }
    }
  });
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions() {
  // your code here...
  $.ajax({
    type: "GET",
    url: "userConnection/suggestions",
    // data: "data",
    dataType: "json",
    beforeSend: function(){
      $('#table').addClass('d-none');
      $('#connections_in_common_skeleton').removeClass('d-none').addClass('d-block');
    },
    success: function (response) {
      $('#table').removeClass('d-none').addClass('d-block');

      $('#connections_in_common_skeleton').removeClass('d-block').addClass('d-none');

      if(response.status)
      {
        $('#suggestion_user_count').text(response.data.count);
        $('#table').empty();

        response.data.suggestionsUsers.data.forEach(function(suggestionsUser){
          $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+suggestionsUser.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+suggestionsUser.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="create_request_btn_" class="btn btn-primary me-1 connect_user_btn" data-suggestion_id="'+suggestionsUser.id+'" data-user_id="'+response.data.userId+'">Connect</button></div></td></tr>');
        })
      }
      else
      {
        $('#suggestion_user_count').text(0);
        $('#table').empty();
      }
    }
  });
}

function getMoreSuggestions(page) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
  $.ajax({
    url: "userConnection/suggestions?page=" + page,
    type: "get",
    datatype: "html",
    beforeSend: function()
    {
      $('#table').addClass('d-none');
      $('#connections_in_common_skeleton').removeClass('d-none').addClass('d-block');
    },
    success:function(response){
      $('#table').removeClass('d-none').addClass('d-block');
      $('#connections_in_common_skeleton').removeClass('d-block').addClass('d-none');

      if(response.status)
      {
        let arrLength = response.data.suggestionsUsers.data.length;
        if(arrLength>0)
        {
          response.data.suggestionsUsers.data.forEach(function(suggestionsUser){
            $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+suggestionsUser.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+suggestionsUser.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="create_request_btn_" class="btn btn-primary me-1 connect_user_btn" data-suggestion_id="'+suggestionsUser.id+'" data-user_id="'+response.data.userId+'">Connect</button></div></td></tr>');
          })
        }
        else
        {
          $('#load_more_btn_parent').addClass('d-none');
        }
      }
      else
      {
        $('#table').empty();
      }
    }
  })
  .done(function(response)
  {          
    if(response.data.suggestionsUsers.data.length == 0){
    $('#load_more_btn_parent').addClass('d-none');

    return;
  }
    // $('.ajax-loading').hide();
    // $("#table").append(data);

  })
  .fail(function(jqXHR, ajaxOptions, thrownError)
  {
    alert('No response from server');
  });
}

function sendRequest(userId, suggestionId) {
  $.ajax({
    type: "GET",
    url: "userConnection/send-request/"+userId+"/"+suggestionId,
    // data: {userId: userId, suggestionId:suggestionId},
    // dataType: "dataType",
    success: function (response) {
      $('#table').empty();
      getSuggestions();
    }
  });
}

function deleteRequest(userId, requestId) {
  $.ajax({
    type: "GET",
    url: "userConnection/delete-request/"+userId+"/"+requestId,
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      if(response.status)
      {
        console.log(response);
        // $('#table').empty();
        // $("#table").ajax.reload();
        // getRequests();
        // $('#sent_req_count').text(response.data.count);
        // $('#sent_req_count').text(response.data.count);
        // response.data.sendRequests.forEach(function(sentReq){
        //   $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+sentReq.user_send_requests.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+sentReq.user_send_requests.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="" class="btn btn-danger me-1 cancel_request_btn" data-withdraw_id="'+sentReq.id+'" data-user_id="'+response.data.userId+'">Withdraw Request</button></div></td></tr>');
        // });
        $('#table').empty();
          $('#sent_req_count').text(response.data.count);
          response.data.sendRequests.forEach(function(sentReq){
            $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+sentReq.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+sentReq.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="" class="btn btn-danger me-1 cancel_request_btn" data-withdraw_id="'+sentReq.id+'" data-user_id="'+response.data.userId+'">Withdraw Request</button></div></td></tr>');
          });
      }
      else
      {
        $('#sent_req_count').text(0);
        $('#table').empty();
      }
    }
  });
}

function acceptRequest(userId, requestId) {
  $.ajax({
    type: "GET",
    url: "userConnection/accept-request/"+userId+"/"+requestId,
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      if(response.status)
      {
        $('#table').empty();
          $('#rece_req_count').text(response.data.count);
          response.data.receiverRequest.forEach(function(receiverReq){
            $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+receiverReq.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+receiverReq.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><button id="" class="btn btn-primary me-1 accept_request_btn" data-req_id="'+receiverReq.id+'" data-user_id="'+response.data.userId+'">Accept</button></div></td></tr>');
          });
      }
      else
      {
        $('#rece_req_count').text(0);

        $('#table').empty();

      }
    }
  });
}

function removeConnection(userId, connectionId) {
  $.ajax({
    type: "GET",
    url: "userConnection/remove-connection/"+userId+"/"+connectionId,
    // data: "data",
    // dataType: "dataType",
    success: function (response) {
      if(response.status)
      {
        $('#connection_count').text(response.data.count);
        $('#table').empty();

        response.data.my_connections.forEach(function(myConnection){
          // console.log(suggestionsUser);
          $('#table').append('<tr><td class="align-middle" style="width:10%" id="suggestion_name">'+myConnection.name+'</td><td class="align-middle"> - </td><td class="align-middle" style="width:40%" id="suggestion_email">'+myConnection.email+'</td><td class="align-middle" style="width:50%"><div class="d-flex justify-content-end w-100"><div><button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">Connections in common ()</button><button id="remove_request_btn" class="btn btn-danger me-1" data-connection_id="'+myConnection.id+'" data-user_id="'+response.data.userId+'">Remove Connection</button></div></div></td></tr>');
      })
      }
      else
      {
        $('#connection_count').text(0);
        $('#table').empty();
      }
    }
  });
}

$(function () {
  // getSuggestions();
});

$(document).on('click','#get_suggestions_btn',function(){
  $('#load_more_btn').removeClass('d-none').addClass('d-block');
  getSuggestions();
})

$(document).on('click','#get_sent_requests_btn',function(){
  let mode = $(this).data('mode');
  $('#load_more_btn').addClass('d-none');
  getRequests(mode);
})

$(document).on('click','.connect_user_btn',function(){
  let userId = $(this).data('user_id'); 
  let suggestionId = $(this).data('suggestion_id'); 
  sendRequest(userId, suggestionId)
})

$(document).on('click','.cancel_request_btn',function(){
  let userId = $(this).data('user_id');
  let withdrawId = $(this).data('withdraw_id');
  deleteRequest(userId, withdrawId);
})

$(document).on('click','#get_received_requests_btn',function(){
  let mode = $(this).data('mode');
  $('#load_more_btn').addClass('d-none');

  getRequests(mode);
})

$(document).on('click','.accept_request_btn',function(){
  let userId = $(this).data('user_id');
  let requestId = $(this).data('req_id');
  acceptRequest(userId, requestId);
})

$(document).on('click','#get_connections_btn',function(){
  $('#load_more_btn').addClass('d-none');
  getConnections();
})

$(document).on('click','#remove_request_btn',function(){
  let userId = $(this).data('user_id');
  let connectionId = $(this).data('connection_id');
  removeConnection(userId, connectionId);
})

$(document).on('click','#load_more_btn',function(){
  page++;
  getMoreSuggestions(page);
})

