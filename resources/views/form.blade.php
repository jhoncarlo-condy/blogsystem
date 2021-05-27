<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/submit" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="">Any text</label>
            <input type="text" name="text" id="" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Help text</small>
          </div>
          <input type="submit" value="Submit">
    </form>
</body>
</html>
