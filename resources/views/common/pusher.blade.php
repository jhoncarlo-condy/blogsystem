<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('deedc206526db9726e72', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');

        channel.bind('post-event', function(data)
        {
            $('#posttable').load('{{ route('realtimepost') }}').fadeIn("slow");
            $('#userposttable').load('{{ route('realtimeuserpost') }}').fadeIn("slow");
            $('#latestpost').load('{{ route('realtimelatestpost') }}').fadeIn("slow");


        });
        channel.bind('delete-post-event', function(data)
        {
            $('#posttable').load('{{ route('realtimepost') }}').fadeIn("slow");
            $('#userposttable').load('{{ route('realtimeuserpost') }}').fadeIn("slow");
            $('#latestpost').load('{{ route('realtimelatestpost') }}').fadeIn("slow")

        });
        channel.bind('category-event', function(data)
        {
            $('#categorytable').load('{{ route('realtimecategory') }}').fadeIn("slow");

        });
        channel.bind('delete-category-event', function(data)
        {
            $('#categorytable').load('{{ route('realtimecategory') }}').fadeIn("slow");

        });
        channel.bind('user-event', function(data)
        {
            $('#usertable').load('{{ route('realtimeuser') }}').fadeIn("slow");

        });
        channel.bind('delete-user-event', function(data)
        {
            $('#usertable').load('{{ route('realtimeuser') }}').fadeIn("slow");

        });

        // dashboard
        channel.bind('category-event', function(data)
        {
            var total  = data.categorycount + parseInt($("#categorycount").text());
            $("#categorycount").text(total);
        });
        channel.bind('delete-category-event', function(data)
        {
            var total  = parseInt($("#categorycount").text() - data.deletecategory);
            $("#categorycount").text(total);
        });

        // post event
        channel.bind('post-event', function(data)
        {
            var total  = data.postcount + parseInt($("#postcount").text());
            $("#postcount").text(total);
        });
        channel.bind('delete-post-event', function(data)
        {
            var total  =  parseInt($("#postcount").text()) - data.deletepost;
            $("#postcount").text(total);
        });

        // user event
        channel.bind('user-event', function(data)
        {
            var total  = data.usercount + parseInt($("#usercount").text());
            $("#usercount").text(total);
        });
        channel.bind('delete-user-event', function(data)
        {
            var total  =  parseInt($("#usercount").text())-data.deleteuser;
            $("#usercount").text(total);
        });

        // comment event
        channel.bind('comment-event', function(data)
        {
            var total  = data.commentcount + parseInt($("#commentcount").text());
            $("#commentcount").text(total);
        });
    </script>
