<div class="tariff-modal modal fade" id="tariffModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Тариф</h4>
            </div>
            <div class="modal-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'services' => $services,
                    'categories' => $categories,
                ]) ?>
            </div>
        </div>
    </div>
</div>