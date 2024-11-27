
<!-- boutons d'action -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		
		<div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle=	"dropdown" aria-haspopup="true" aria-expanded="false">
			Attestation <i class="ion-android-arrow-dropdown"></i>
			</button>
			<ul class="dropdown-menu">			
			<li><a href="<?=base_url()?>gestionsalarie/attestation_travail/<?=$view_data['salarie']['id'];?>/show" >de travail</a></li>
			<li><a href="<?=base_url()?>invoices/attestation_salaire/<?=$view_data['salarie']['id'];?>/show" target="_blank">de salaire</a></li>
			<li><a href="<?=base_url()?>invoices/attestation_retenu/<?=$view_data['salarie']['id'];?>/show" target="_blank">de retenu d'impôt</a></li>
			</ul>
		</div>
		
		<!-- liste des salariés -->
		<a href="<?=base_url()?>gestionsalarie" class="btn btn-warning right">Liste des salariés</a>	
	</div>
</div>

<div class="row">
	<!-- détail du salarié -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<!-- stylet de modification -->	
		<div class="table-head">Détail du salarié
			<span class=" pull-right option-icon"> 
				<a href="<?=base_url()?>gestionsalarie/updatedetail/<?=$view_data['salarie']['id'];?>" data-toggle="mainmodal" data-target="#mainModal">
					<i class="fa fa-edit" title="Modifier"></i>
				</a>
			</span>
		</div>
		<div class="subcont">
			<ul class="details col-xs-12 col-sm-12">
					<li><span><?=lang('application.application_matricule');?></span><?=$view_data['salarie']['code'];?></li>
					<li><span>Prénom & Nom</span><?=$view_data['salarie']['prenom'].' '.$view_data['salarie']['nom'];?></li>
					<li><span>Genre</span><?=GetType_txt($view_data['salarie']['genre']);?></li>
					<li><span>Situation familiale</span><?=GetType_txt($view_data['salarie']['situationfamiliale']);?></li>
					<li><span>Date de naissance</span><?=dateFR($view_data['salarie']['datedenaissance']);?></li>
					<li><span>Lieu de naissance</span><?=$view_data['salarie']['lieudenaissance'];?></li>
					<li><span>Numéro CIN</span><?=$view_data['salarie']['numerocin'];?></li>
					<li><span>Date de délivrance</span><?=dateFR($view_data['salarie']['datedelivrance']);?></li>
					<li><span>Numéro CNSS</span><?=$view_data['salarie']['numerocnss'];?></li>
					<li><span>Service d'affectation</span><?=$view_data['salarie']['seraffectation'];?></li>
			</ul>
			<br clear="both">
		</div>
	</div>
	
	<!-- détail 2 contact -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<div class="table-head">Contact
			<span class=" pull-right option-icon"> 
				<a href="<?=base_url()?>gestionsalarie/updatecontact/<?=$view_data['salarie']['id'];?>" data-toggle="mainmodal" data-target="#mainModal">
					<i class="fa fa-edit" title="Modifier"></i>
				</a>
			</span>
		</div>
		<div class="subcont">
			<ul class="details col-xs-12 col-sm-12">
					<li><span>Adresse</span><?=$view_data['salarie']['adresse1'];?></li>
					<li><span>Adresse 2</span><?=$view_data['salarie']['adresse2'];?></li>
					<li><span>Code Postal</span><?=$view_data['salarie']['codepostal'];?></li>
					<li><span>Ville</span><?=$view_data['salarie']['ville'];?></li>
					<li><span>Pays</span><?=$view_data['salarie']['pays'];?></li>
					<li><span>Téléphone 1</span><?=$view_data['salarie']['tel1'];?></li>
					<li><span>Téléphone 2</span><?=$view_data['salarie']['tel2'];?></li>
					<li><span>Skype</span><?=$view_data['salarie']['skype'];?></li>
					<li><span>Email</span><?=$view_data['salarie']['mail'];?></li>
			</ul>
			<br clear="both">
		</div>
	</div>
	
	<!-- détail 3 paie-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<div class="table-head">Paie
			<span class=" pull-right option-icon"> 
				<a href="<?=base_url()?>gestionsalarie/updatepaie/<?=$view_data['salarie']['id'];?>" data-toggle="mainmodal" data-target="#mainModal">
					<i class="fa fa-edit" title="Modifier"></i>
				</a>
			</span>
		</div>
		<div class="subcont">
			<ul class="details col-xs-12 col-sm-12">
					<li><span>Chef de famille</span><?=$view_data['salarie']['chef_famille'];?></li>
					<li><span>Salaire brut</span><?=$view_data['salarie']['salaire_brut'];?></li>
					<li><span>Nb. d'enfants</span><?=$view_data['salarie']['nb_enfants'];?></li>
					<li><span>Nb. d'enfants boursiers</span><?=$view_data['salarie']['nb_enfants_boursiers'];?></li>
					<li><span>Nb. d'enfants handicapé(e)s</span><?=$view_data['salarie']['nb_enfants_handicape'];?></li>
					<li><span>Parent à charges</span><?=$view_data['salarie']['parents_charges'];?></li>
					<li><span>Droit congés</span><?=$view_data['salarie']['droit_conge'];?></li>
					<li><span>Solde de congés initial</span><?=$view_data['salarie']['solde_conge_initiale'];?></li>
					<li><span>Mode de paiement</span><?=GetType_txt($view_data['salarie']['mode_paiement']);?></li>
					<li><span>Date embauche</span><?=dateFR($view_data['salarie']['date_debut_embauche']);?></li>
					<li><span>Catégorie</span><?=$view_data['salarie']['categorie'];?></li>
					<li><span>Echelon</span><?=$view_data['salarie']['echelon'];?></li>
					<li><span>Taux horaire</span><?=$view_data['salarie']['tauxhoraire'];?></li>
					<li><span>Type de paiement</span><?=GetType_txt($view_data['salarie']['type_paiement']);?></li>
					<li><span>Type de contrat</span><?=GetType_txt($view_data['salarie']['type_contrat']);?></li>
			</ul>
			<br clear="both">
		</div>
	</div>

	<!-- détail 4 règlement-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<div class="table-head">Règlement
			<span class=" pull-right option-icon"> 
				<a href="<?=base_url()?>gestionsalarie/updatereglement/<?=$view_data['salarie']['id'];?>" data-toggle="mainmodal" data-target="#mainModal">
					<i class="fa fa-edit" title="Modifier"></i>
				</a>
			</span>
		</div>
		<div class="subcont">
			<ul class="details col-xs-12 col-sm-12">
					<li><span>Nom de la banque</span><?=$view_data['salarie']['nombanque'];?></li>
					<li><span>Rib</span><?=$view_data['salarie']['rib'];?></li>
					<li><span>Iban</span><?=$view_data['salarie']['iban'];?></li>
					<li><span>Bic</span><?=$view_data['salarie']['bic'];?></li>
			</ul>
			<br clear="both">
		</div>
	</div>
	
</div>
<?= $this->endSection() ?>