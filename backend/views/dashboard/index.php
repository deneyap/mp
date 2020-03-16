<?php 
use components\Helper;
use backend\services\FirmServices;
use backend\services\ManagerServices;

switch (YII_ENV) {
  case 'prod':
    $envLabel = 'PRODUCTION';
    $envColor = 'success';
    break;

  case 'test':
    $envLabel = 'TEST';
    $envColor = 'warning';
    break;

  default:
    $envLabel = 'DEVELOPER';
    $envColor = 'danger';
    break;
}
$publishStatus = $this->context->setting->get('system.publish.status');
$lastServerUpdate = intval($this->context->setting->get('system.last.update.server')) > 0 ? $this->context->setting->get('system.last.update.server') : time();
$lastSettingUpdate = intval($this->context->setting->get('system.last.update.settings')) > 0 ? $this->context->setting->get('system.last.update.settings') : time();
$lastMaintenance = intval($this->context->setting->get('system.last.maintenance')) > 0 ? $this->context->setting->get('system.last.maintenance') : time();
?>
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="bg-white container-p-x pt-4 pb-1 container-m--x container-m--y mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h2 class="font-weight-light mb-3">Proje Genel Durumu</h2>
        <div class="text-light font-weight-bold mr-3 float-left"><span class="font-weight-bolder mr-3">YAYIN DURUMU :</span><?php echo true === $publishStatus ? '<span class="badge badge-success">AKTİF</span>' : '<span class="badge badge-warning">YAYIN KAPALI</span>'; ?></span></div>
        <div class="text-light font-weight-bold mr-3 float-left"><span class="font-weight-bolder mr-3">YAYIN TİPİ :</span><span class="badge badge-<?php echo $envColor; ?>"><?php echo $envLabel; ?></span></div>
        <div class="small pt-4 mt-4">
          Son server güncellemesi : 
          <?php echo '<strong>'. Helper::timeElapsedString('@'. $lastServerUpdate) . '</strong> ('. date('d/m/Y H:i:s', $lastServerUpdate). ')'; ?>
          <br>
          Son ayarlar güncellemesi : 
          <?php echo '<strong>'. Helper::timeElapsedString('@'. $lastSettingUpdate) . '</strong> ('. date('d/m/Y H:i:s', $lastSettingUpdate). ')'; ?> 
        </div>
      </div>
      <div class="float-right text-right">
        <a href="/manage/publish" class="mb-2 btn btn-lg btn-<?php echo true === $publishStatus ? 'danger' : 'success'; ?>">
          <i class="ion ion-md-power"></i>&nbsp; <?php echo $publishStatus ? 'YAYINI DURDUR' : 'YAYINI BAŞLAT'; ?>
        </a>
        <br>
        <small>
          Son yayın durdurma : 
          <?php echo '<strong>'. Helper::timeElapsedString('@'. $lastMaintenance) . '</strong> ('. date('d/m/Y H:i:s', $lastMaintenance). ')'; ?>
        </small> 
      </div>
    </div>
  </div>
  <?php if (ManagerServices::checkRule($this->context->admin->role->id, 145)): ?>
  <!-- Counters -->
  <div class="row">
    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="ion ion-md-person display-4 text-success"></div>
            <div class="ml-3 text-center mx-auto">
              <div class="text-muted">KULLANICI</div>
              <div class="text-muted small">Aktif / Onaylanmamış</div>
              <div class="text-large"><?php echo $counter->userActive; ?> / <?php echo $counter->userPending; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="ion ion-ios-quote display-4 text-info"></div>
            <div class="ml-3 text-center">
              <div class="text-muted">FİRMA</div>
              <div class="text-muted small">Aktif / Onay Bekleyen</div>
              <div class="text-large"><?php echo $counter->firmActive; ?> / <?php echo $counter->firmPending; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="ion ion-ios-school display-4 text-danger"></div>
            <div class="ml-3 text-center">
              <div class="text-muted">PROGRAM</div>
              <div class="text-muted small">Toplam / Yayında</div>
              <div class="text-large"><?php echo $counter->bountyTotal; ?> / <?php echo $counter->bountyActive; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="ion ion-ios-albums display-4 text-warning"></div>
            <div class="ml-3 text-center">
              <div class="text-muted">RAPOR</div>
              <div class="text-muted small">Toplam / İşlem Bekleyen</div>
              <div class="text-large"><?php echo $counter->reportTotal; ?> / <?php echo $counter->reportPending; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <!-- / Counters -->
  <!-- Pending -->
  <div class="row">
    <div class="col-12">
      <!-- Sales -->
      <div class="nav-tabs-top mb-4">
        <ul class="nav nav-tabs">
          <?php 
          $nextPane = false;
          if (ManagerServices::checkRule($this->context->admin->role->id, 146)): ?>
            <li class="nav-item">
              <a class="nav-link active show" data-toggle="tab" href="#pending-reports">Onay Bekleyen Raporlar (<?php echo count($reports); ?>)</a>
            </li>
          <?php 
            else:
              $nextPane = true;
            endif;
          ?>
          <?php if (ManagerServices::checkRule($this->context->admin->role->id, 147)): ?>
            <li class="nav-item">
              <a class="nav-link<?php echo true === $nextPane ? ' active show' : ''; ?>" data-toggle="tab" href="#pending-bounties">Onay Bekleyen Programlar (<?php echo count($bounties); ?>)</a>
            </li>
          <?php
            else:
              $nextPane = true;
            endif;
            if (true === $nextPane) {
              $nextPane = false;
            }
          ?>
          <?php if (ManagerServices::checkRule($this->context->admin->role->id, 148)): ?>
            <li class="nav-item">
              <a class="nav-link<?php echo true === $nextPane ? ' active show' : ''; ?>" data-toggle="tab" href="#pending-firm">Onay Bekleyen Firmalar (<?php echo count($firms); ?>)</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class="tab-content">
          <?php 
          $nextTab = false;
          if (ManagerServices::checkRule($this->context->admin->role->id, 146)): ?>
            <div class="tab-pane fade active show" id="pending-reports">
              <?php if (count($reports) > 0): ?>
                <div class="card-body p-0">
                  <div class="text-muted p-4">Not : Yönetici ön onayı ve onay bekleyen raporlara ait son kayıtlar aşağıdaki gibidir. Yönetici ön onayına ait kayıtlar, işlem sonrası raporun kayıtlı olduğu firma ekranında ve onay bekleyen raporlar listesinde görüntülenecektir. Onay bekleyen raporlar için, işlem yapılan kayıt "Genel Bakış" ekranında görüntülenmeyecektir.</div>
                    <?php echo $this->render('../partials/list-reports', ['reports' => $reports, 'firm' => true]); ?>
                </div>
                <a href="/report/pending" class="card-footer d-block text-center text-dark small font-weight-semibold">TÜMÜNÜ GÖSTER</a>
              <?php else: ?>
                <center class="p-4 text-muted text-large">Onay bekleyen rapor bulunmuyor.</center>
              <?php endif; ?>
            </div>
          <?php 
            else:
              $nextTab = true;
            endif;
          ?>
          <?php if (ManagerServices::checkRule($this->context->admin->role->id, 147)): ?>
            <div class="tab-pane fade<?php echo true === $nextTab ? ' active show' : ''; ?>" id="pending-bounties">
              <?php if (count($bounties) > 0): ?>
                <div class="card-body p-0">
                  <div class="text-muted p-4">Not : Bu bölümde sadece yönetici ön onayı gerektiren programlar yer alır. Listede yer alan programlar onay sonrası yayına alınır ve listeden kaldırılır.</div>
                  <?php echo $this->render('../partials/list-bounties', ['bounties' => $bounties, 'firm' => true]); ?>
                </div>
                <a href="/bounty/pending" class="card-footer d-block text-center text-dark small font-weight-semibold">TÜMÜNÜ GÖSTER</a>
              <?php else: ?>
                <center class="p-4 text-muted text-large">Onay bekleyen program bulunmuyor.</center>
              <?php endif; ?>
            </div>
          <?php 
            else:
              $nextTab = true;
            endif;
            if (true === $nextTab) {
              $nextTab = false;
            }
          ?>
          <?php if (ManagerServices::checkRule($this->context->admin->role->id, 148)): ?>
            <div class="tab-pane fade<?php echo true === $nextTab ? ' active show' : ''; ?>" id="pending-firm">
              <?php if (count($firms) > 0): ?>
                <div class="card-body p-0">
                  <div class="text-muted p-4">Not : Bu bölümde sadece kurumsal firma kimliğini doğrulamak için onay bekleyen firmalar yer alır. Firma onay işlemi sonrası listeden kaldırılır.</div>
                    <table class="table card-table">
                      <thead class="thead-light">
                        <tr>
                          <th width="40">#</th>
                          <th width="230">Firma Adı</th>
                          <th>E-posta</th>
                          <th width="140">Hesap Durumu</th>
                          <th class="text-center" width="120">Firma Onayı</th>
                          <th class="text-center" width="120">Kayıt Tarihi</th>
                          <th width="110"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($firms as $model): ?>
                          <tr<?php echo $model->status == FirmServices::STATUS_DELETED ? ' class="text-muted"' : ''; ?>>
                            <td scope="row"><?php echo $model->id; ?></td>
                            <td><?php echo $model->detail->name; ?></td>
                            <td><?php echo $model->email; ?></td>
                            <td><span class="badge badge-outline-<?php echo $model->statusColor; ?>"><?php echo $model->statusLabel; ?></span></td>
                            <td align="center"><span class="badge badge-outline-<?php echo $model->firmStatusColor; ?> d-block"><?php echo $model->firmStatusLabel; ?></span></td>
                            <td align="center"><?php echo date('d.m.Y', $model->createdAt); ?></td>
                            <td class="text-right">
                              <?php if ($model->status != FirmServices::STATUS_DELETED): ?>
                                <?php if ($model->detail->firmStatus != FirmServices::FIRM_STATUS_PENDING): ?>
                                  <a href="/firm/edit?id=<?php echo $model->id; ?>" class="btn btn-sm btn-outline-primary font-weight-bolder"><i class="fas fa-pencil-alt"></i></a>
                                  <a href="/firm/delete?id=<?php echo $model->id; ?>" class="btn btn-sm btn-outline-danger font-weight-bolder"><i class="fas fa-times"></i></a>
                                <?php else: ?>
                                  <a href="/firm/confirm/<?php echo $model->id; ?>" class="btn btn-sm btn-outline-warning d-block font-weight-bolder"><i class="ion ion-md-alarm"></i></a>
                                <?php endif; ?>
                              <?php else: ?>
                                <a href="/firm/recovery?id=<?php echo $model->id; ?>" class="btn btn-sm btn-outline-default font-weight-bolder btn-block">GERİ AL</a>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
                <a href="/firm/pending" class="card-footer d-block text-center text-dark small font-weight-semibold">TÜMÜNÜ GÖSTER</a>
              <?php else: ?>
                <center class="p-4 text-muted text-large">Onay bekleyen firma bulunmuyor.</center>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <!-- / Sales -->
    </div>
  </div>
</div>
<!-- / Pending -->