<!DOCTYPE html>
<html>
  @include('partials.miaomiao.header')
  <body class="vbase2">
    @include('partials.miaomiao.nav')
    <div class="content container-fluid">
      <div class="row header">
        <div class="col-md-8 col-md-offset-2">
          VBase2 DNAPLOT tool
        </div>
      </div>
      <form class="navbar-form" method="post" action="{{ route('miaomiao.vbase2.post') }}" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-3 col-md-offset-2">
            <div class="panel panel-primary">
              <div class="panel-heading">Select multiple files to merge</div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="btn btn-default btn-file">
                    Browse <input style="display: none;" name="filesToUpload[]" class="filesToUpload" type="file"
                    multiple="" data-name="filesToUpload"/>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <span class="or">OR</span>
          </div>
          <div class="col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading">Select merged files</div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="btn btn-default btn-file">
                    Browse <input style="display: none;" name="fileToUpload[]" class="filesToUpload" type="file"
                    data-name="fileToUpload"/>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row row__space">
          <div class="col-md-4 col-md-offset-4 noshow" id="js-merge-files">
            <div class="panel panel-info">
              <div class="panel-heading">File selected</div>
              <div class="panel-body">
                <ul class="list-group" id="js-merge-files-ul"></ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row row__space">
          <div class="col-md-4 col-md-offset-4 noshow" id="js-vbase2-submit">
            <div class="panel panel-primary">
              <div class="panel-heading">Submit to VBase2.org</div>
              <div class="panel-body">
                <input type="hidden" class="activeUpload" name="activeUpload" value="">
                <button type="submit" class="btn btn-default btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    @include('partials.miaomiao.footer')
  </body>
</html>
