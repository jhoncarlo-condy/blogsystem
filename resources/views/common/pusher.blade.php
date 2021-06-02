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

        });
        channel.bind('delete-post-event', function(data)
        {
            $('#posttable').load('{{ route('realtimepost') }}').fadeIn("slow");

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
    </script>
