$(document).ready(function(){

  $('#pagination').on('click','a',function(e){
    e.preventDefault();
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
  });

  $('#submit').on('click', function(e){
    e.preventDefault();
    createComment();
  });

  loadPagination(0);

  function loadPagination(pagno){
    $.ajax({
      url: '/comments/show/'+pagno,
      type: 'get',
      dataType: 'json',
      success: function(response){
        $('#pagination').html(response.pagination);
        showComment(response.comments);
      }
    });
  }

  function createComment(){
    $.ajax({
      url: '/comments/create',
      data: {
        comment_body: $("#body_text").val(),
        comment_email: $("#email").val(),
        comment_nickname: $("#name").val(),
      },
      type: 'post',
      dataType: 'json',
      success: function(response){
        document.getElementById('body_text').value = "";
        document.getElementById('email').value = "";
        document.getElementById('name').value = "";
        $('#status').html(response.status);
        loadPagination(0);
      }
    });
  }

  function showComment(result){
    $('#commentsList').empty();
    var block = "";
    if (result) {
      for(comment in result){
        var nickname = getName(result[comment].comment_email, result[comment].comment_nickname);
        var body = result[comment].comment_body;
        var date_create = result[comment].comment_date_create;
        block += "<div class='comment mt-4 text-justify float-left'>";
        block += '<img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle comment-img" width="40" height="40">';
        block += "<h4>" + nickname + "</h4>";
        block += "<span> - " + date_create + "</span><br>";
        block += "<p>" + body + "</p>";
        block += "</div>";

      }
      $('#commentsList').append(block);
    }else{
      block += "<div>Coments(s) not found.</div>";
      $('#commentsList').append(block);
    }
  }

  function getName(email, nick_name){
    return !nick_name ? email.split('@', 1) : nick_name;
  }

});
