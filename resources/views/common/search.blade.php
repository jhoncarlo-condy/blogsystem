<script>
    $(document).ready(function(){
        $(".search-card").hide();
        $("#category-search").keyup(function(){
           $(".card").show();
           var query = $(this).val();
           if(query.length>=3){
               $.ajax({
                   url:"{{ url('search') }}",
                   data:{
                       title: query
                   },
                   dataType:'json',
                   beforeSend:function(){
                       $("#category-result").html('<li class="list-group-item">Loading...</li>');
                   },
                   success:function(data){
                       var _html = '';
                       $.each(data.result,function(index,result){
                           if(result.blogmax > 0)
                           {
                           _html+='<li class="list-group-item result found" id="'+result.title+'">'+result.title+'</li>';
                           }
                       });
                       if(data.result == 0)
                           {
                       _html='<li class="list-group-item">No results found</li>';
                           }
                       $("#category-result").html(_html);


                   }
               });
           }
           if(query == 0)
           {
               $(".search-card").fadeOut();
           }
       });
       $(document).on('click','.found',function(){
         $("#category-search").val($(this).text());
         $(".search-card").fadeOut();
       });

    });
   </script>
