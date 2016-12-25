<!DOCTYPE html>
<html>
  @include('partials.miaomiao.header')
  <body class="merge">
    @include('partials.miaomiao.nav')
    <div class="content container-fluid">
      <div class="row header">
        <div class="col-md-8 col-md-offset-2">
          This is a tool to merge multiple text files into one.
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form class="navbar-form" method="post" action="{{ route('miaomiao.merge.post') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="panel panel-primary">
              <div class="panel-heading">Step 1: Select your files</div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="btn btn-default btn-file">
                    Browse <input style="display: none;" name="filesToUpload[]" class="filesToUpload" type="file" multiple="" />
                  </label>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Step 2: Click "Merge" button and save</div>
              <div class="panel-body">
                <button type="submit" class="btn btn-default btn-success">Merge</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-3 noshow" id="js-merge-files">
            <div class="panel panel-info">
              <div class="panel-heading">File selected</div>
              <div class="panel-body">
                <ul class="list-group" id="js-merge-files-ul"></ul>
              </div>
            </div>
        </div>
      </div>
    </div>
    @include('partials.miaomiao.footer')
  </body>
</html>
