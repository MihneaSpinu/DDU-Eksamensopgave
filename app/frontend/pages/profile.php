<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo escape($name); ?></h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-9 col-lg-9 ">
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>Name:</td>
                    <td><?php echo escape($name); ?></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><?php echo escape($user->data()->email); ?></td>
                  </tr>
                  <tr>
                    <td>Dine fag:</td>
                    <td><?php foreach ($subject_names as $sname) {
                          echo "$sname <br>";
                        } ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="/update-account" class="btn btn-primary">Opdater password</a>
              <a href="/" class="btn btn-primary">Tilbage til forside</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>