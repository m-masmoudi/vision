<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="col-sm-12 col-md-12 main"> 
    <div class="mb-3">
        <a href="<?= base_url('gestionpret/create') ?>" class="btn btn-success" data-toggle="mainmodal"><?= lang('application.application-add') ?></a>
        <a type="button" class="btn btn-success" href="<?= base_url('exporter/prets_as_excel') ?>"><?= lang('application.application_export') ?></a>
    </div>
</div>
<div class="col-sm-12 col-md-12 main"> 
    <div class="row"> 
        <div class="table-head" style="background-color: #DE2821; color: white;">
            <img src="https://image.flaticon.com/icons/svg/180/180012.svg" width="25px">
            <?= lang('application.application_liste_des_prets_salarie') ?>
        </div>

        <div class="table-div">
            <table class="dataSorting table" rel="<?= base_url() ?>" cellspacing="0" cellpadding="0">
                <thead>
                    <th><?= lang('application.application_salarie') ?></th>
                    <th><?= lang('application.application_typepret') ?></th>
                    <th><?= lang('application.application_remboursement') ?></th>
                    <th><?= lang('application.application_date_pret') ?></th>
                    <th><?= lang('application.application_duree') ?></th>
                    <th><?= lang('application.application_montant') ?></th>
                    <th><?= lang('application.application_montant_remb') ?></th>
                    <th><?= lang('application.application_date_debut_remb') ?></th>
                    <th><?= lang('application.application_action') ?></th>
                </thead>
                <tbody>
                    <?php if (!empty($view_data['prets'])): ?>
                        <?php foreach ($view_data['prets'] as $value): ?>
                            <tr id="<?= $value['id'] ?>">
                                <td class="hidden-xs">
                                    <?php 
                                        foreach ($view_data['salaries'] as $salarie) {
                                            if ($salarie['id'] == $value['id_salarie']) {
                                                echo $salarie['nom'] . ' ' . $salarie['prenom'];
                                                break;
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="hidden-xs"><?= $value['type_pret'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['remboursement'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['date_pret'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['duree'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['montant'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['montant_remb'] ?? '-' ?></td>
                                <td class="hidden-xs"><?= $value['date_debut_remboursement'] ?? '-' ?></td>
                                <td class="option action">
                                    <a href="<?= base_url('gestionpret/update/' . $value['id']) ?>" class="btn-option" data-toggle="mainmodal">
                                        <i class="fa fa-edit" title="Modifier"></i>
                                    </a>
                                    <button type="button" class="btn-option delete po" data-bs-toggle="popover" data-placement="left"
                                        data-content="<a class='btn btn-danger po-delete ajax-silent' href='<?= base_url('gestionpret/delete/' . $value['id']) ?>'><?= lang('application.application_yes_im_sure') ?></a>
                                                      <button class='btn po-close'><?= lang('application.application_no') ?></button>
                                                      <input type='hidden' name='td-id' class='id' value='<?= $value['id'] ?>'>"
                                        data-original-title="<b><?= lang('application.application_really_delete') ?></b>">
                                        <i class="fa fa-trash" title="Supprimer"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center"><?= lang('application.application_no_data_found') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br clear="all">        
        </div>
    </div>
</div>

	
	<?= $this->endSection() ?>


