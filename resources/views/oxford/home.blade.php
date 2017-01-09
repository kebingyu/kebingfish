<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>Oxford Dictionary</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
  </head>
  <body>
    <div class="col-md-offset-3 col-md-6">
      <div class="alert alert-info">
        <form class="form-horizontal" method="POST" action="/oxford" accept-charset="UTF-8">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="word_id" class="col-sm-3 control-label">Word</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" aria-label="word" name="word_id">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>
      </div>
      <div class="definitions">
      </div>
    </div>
    <script src="//code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/js/oxford.js"></script>
  </body>
</html>
